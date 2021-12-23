<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ActivityLogController;

class Role extends LaratrustRole
{
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
    public static $modulename = array('en' => 'role', 'fa' => 'نقش', 'model' => 'Role');

    /**
     * module fields for select and search
     * @var string[]
     */
    public static $modulefields = array('id', 'name', 'display_name', 'created_at', 'updated_at');

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
        static::creating(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model']); });
        static::created(function ($item) { ActivityLogController::savelog('create', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        static::updating(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'update'); });
        static::updated(function ($item) { ActivityLogController::savelog('update', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        static::deleting(function ($item) { \App\Http\Controllers\DashboardController::user_access(self::$modulename['model'], 'delete'); });
        static::deleted(function ($item) { ActivityLogController::savelog('delete', self::$modulename['model'], $item['id'], Auth::id(), $item); });
        return false;
    }

    # Popular functions

    /**
     * fetch selected record
     *  Require *
     * @param $id
     * @return mixed
     */
    public function _find($id)
    {
        return Role::find($id);
    }

    /**
     * fetch All records(paginate)
     * Require *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate($limit)
    {
        return Role::select(self::$modulefields)->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All records
     * @return mixed
     */
    public function fetchAll()
    {
        return Role::orderBy('id', 'DESC')->get();
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active()
    {
        return Role::orderBy('id', 'DESC')->get();
    }

    /**
     * get Role Name
     * @param $id
     * @return mixed
     */
    public static function getRoleName($id)
    {
        $role = Role::select('name')->find($id);
        return $role->name;
    }

    /**
     * get Role Name
     * @param $id
     * @return mixed
     */
    public static function getRoleLable($id)
    {
        $role = Role::select('display_name')->find($id);
        return $role->display_name;
    }

    /**
     * get all Role
     * @return mixed
     */
    public static function getRole()
    {
        return Role::select('id', 'name', 'display_name')->orderBy('id', 'ASC')->get();
    }

    /**
     * Relations
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissionToRole()
    {
        return $this->hasMany('App\PermissionToRole');
    }
}
