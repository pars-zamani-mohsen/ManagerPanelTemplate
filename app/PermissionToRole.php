<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ActivityLogController;

class PermissionToRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = ['permission_id', 'role_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The model information
     * @var string[]
     */
    public static $modulename = array('en' => 'permissionToRole', 'fa' => 'دسترسی نقش ها', 'model' => 'PermissionToRole');

    /**
     * module fields for select and search
     * @var string[]
     */
    public static $modulefields = array('role_id', 'permission_id');

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = [];

    # Popular functions

    /**
     * fetch selected record
     *  Require *
     * @param integer $role_id
     * @param integer $permission_id
     * @return mixed
     */
    public function _find(int $role_id, int $permission_id)
    {
        return PermissionToRole::where('role_id', $role_id)->where('permission_id', $permission_id)->first();
    }

    /**
     * fetch selected record
     *  Require *
     * @param integer $id
     * @return mixed
     */
    public function _findRoles(int $id)
    {
        return PermissionToRole::where('role_id', $id)->get();
    }

    /**
     * fetch selected record
     *  Require *
     * @param integer$id
     * @return mixed
     */
    public function _findPermissions(int $id)
    {
        return PermissionToRole::where('permission_id', $id)->get();
    }

    /**
     * fetch Permission By Role id
     *  Require *
     * @param integer $id
     * @return mixed
     */
    public function fetchPermissionByRoleId(int $id)
    {
        return PermissionToRole::where('role_id', $id)->pluck('permission_id');
    }

    /**
     * fetch All records(paginate)
     * Require *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate($limit)
    {
        return PermissionToRole::select(self::$modulefields)->with(['role', 'permission'])->orderBy('role_id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All records
     * @return mixed
     */
    public function fetchAll()
    {
        return PermissionToRole::orderBy('role_id', 'DESC')->all();
    }

    /**
     * fetch All active records
     * @return mixed
     */
    public static function fetchAll_active()
    {
        return PermissionToRole::orderBy('role_id', 'DESC')->get();
    }

    /**
     * Relations
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('App\Permission');
    }
}
