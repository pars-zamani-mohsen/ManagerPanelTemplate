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
        //'options' => 'collection',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = [];

    /**
     * Save model event log
     *
     * @return bool
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            if (Auth::user()) \App\Http\Controllers\DashboardController::user_access(self::$modulename['model']);
        });
        static::created(function ($item) {
            if (Auth::user()) ActivityLogController::savelog('create', self::$modulename['model'], $item['id'], Auth::id() ?? 0, $item);
        });
        static::updating(function ($item) {
            if (Auth::user()) \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'update');
        });
        static::updated(function ($item) {
            if (Auth::user()) ActivityLogController::savelog('update', self::$modulename['model'], $item['id'], Auth::id() ?? 0, $item);
        });
        static::deleting(function ($item) {
            if (Auth::user()) \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'delete');
        });
        static::deleted(function ($item) {
            if (Auth::user()) ActivityLogController::savelog('delete', self::$modulename['model'], $item['id'], Auth::id() ?? 0, $item);
        });
        return false;
    }

    # Popular functions

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

    /**
     * fetch selected record
     *
     * @param $id
     * @return mixed
     */
    public function _find($id)
    {
        return ("\App\\" . self::$modulename['model'])::find($id);
    }

    /**
     * fetch All records
     * @return mixed
     */
    public function fetchAll()
    {
        return ("\App\\" . self::$modulename['model'])::orderBy('id', 'DESC')->get();
    }

    /**
     * fetch All records(paginate)
     *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate($limit)
    {
        return ("\App\\" . self::$modulename['model'])::with(['publisher'])->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active()
    {
        return ("\App\\" . self::$modulename['model'])::active()->orderBy('id', 'DESC')->get();
    }

    /**
     * fetch All records(paginate)
     *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate_limited_columns($limit)
    {
        return ("\App\\" . self::$modulename['model'])::select(self::$modulefields)->with(['publisher'])->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active_limited_columns()
    {
        return ("\App\\" . self::$modulename['model'])::select(self::$modulefields)->active()->get();
    }

    /**
     * fetch All deleted records
     *
     * @param int $limit
     * @return mixed
     */
    public static function fetch_allTrush_limited_columns(int $limit)
    {
        return ("\App\\" . self::$modulename['model'])::select('id', 'title', 'created_at', 'deleted_at', 'created_by')->onlyTrashed()->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * Relations
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

}
