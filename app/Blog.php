<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\ActivityLogController;

class Blog extends Model
{
    use SoftDeletes;
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * The model information
     * @var string[]
     */
    public static $modulename = array('en' => 'blog', 'fa' => 'بلاگ', 'model' => 'Blog');

    /**
     * module fields for select and search
     * @var string[]
     */
    public static $modulefields = array('id', 'title', 'active', 'created_at', 'updated_at', 'created_by');

    /**
     * Get the format for database stored dates.
     *
     * @return string
     */
    public function getDateFormat()
    {
        return 'U';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'collection',
    ];

    /**
     * The attribute for commentable record.
     *
     * @var bool false|true
     */
    public static $commentable = true;

    /**
     * The attribute for showing publisher details.
     *
     * @var bool false|true
     */
    public static $publisher = true;

    /**
     * Save model event log
     *
     * @return bool
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model']); });
        static::created(function ($item) { ActivityLogController::savelog('create', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        static::updating(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'update'); });
        static::updated(function ($item) { ActivityLogController::savelog('update', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        static::deleting(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'delete'); });
        static::deleted(function ($item) { ActivityLogController::savelog('delete', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        return false;
    }

    /**
     * Check active item
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    # Popular functions
    /**
     * fetch selected record
     *
     * @param $id
     * @return mixed
     */
    public function _find($id)
    {
        return Blog::find($id);
    }

    /**
     * fetch All records
     * @return mixed
     */
    public function fetchAll()
    {
        return Blog::orderBy('id', 'DESC')->get();
    }

    /**
     * fetch All records(paginate)
     *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate($limit)
    {
        return Blog::with(['publisher'])->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active()
    {
        return Blog::active()->orderBy('id', 'DESC')->get();
    }

    /**
     * fetch All records(paginate)
     *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate_limited_columns($limit)
    {
        return Blog::select(self::$modulefields)->with(['publisher'])->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active_limited_columns()
    {
        return Blog::select(self::$modulefields)->active()->get();
    }

    /**
     * fetch All deleted records
     *
     * @param int $limit
     * @return mixed
     */
    public static function fetch_allTrush_limited_columns(int $limit)
    {
        return Blog::select('id', 'title', 'created_at', 'deleted_at', 'created_by')->onlyTrashed()->orderBy('id', 'DESC')->paginate($limit);
    }


    # Relations


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

}
