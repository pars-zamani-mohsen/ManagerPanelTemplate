<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\PermissionToRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class PermissionToRoleController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new PermissionToRole();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: "onlylist", "is_related_list", "import", "export" to add or remove buttons
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => ' فهرست ' . $this->modulename['fa'],
                'all' => (new Role())->fetchAll_paginate(10),
                'onlylist' => true,
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
                'modulename' => $this->modulename,
                'title' => 'ایجاد ' . $this->modulename['fa'],
                'role' => Role::fetchAll_active(),
                'permission' => array(),
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createWithRole($id)
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
                'modulename' => $this->modulename,
                'title' => 'ایجاد ' . $this->modulename['fa'],
                'role' => Role::fetchAll_active(),
                'permission' => array_reverse(Permission::fetchAll_active()->toArray()),
                'role_id' => $id,
                'selected_permition' => $this->instance->fetchPermissionByRoleId($id)->toArray(),
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validate_data = array(
            'role' => ['required', 'integer'],
        );
        $this->validate($request, $validate_data);

        try {
            $result = false;
            PermissionToRole::where('role_id', $request->role)->delete();

            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'permission-') !== false) {
                    $instance = new PermissionToRole();
                    $instance->role_id = $request->role;
                    $instance->permission_id = str_replace('permission-', '', $key);
                    $result = $instance->save();
                }
            }

            if ($result) {
//                (new UserController())->clear();
                return $this->function_response(201);
            }

            return $this->function_response(204);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
                    'modulename' => $this->modulename,
                    'title' => $this->modulename['fa'] . ' #' . $instance->id,
                    'This' => $instance,
                    'role' => Role::fetchAll_active(),
                    'permission' => Permission::fetchAll_active(),
                ));
            }

            return $this->function_response(404);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validate_data = array(
            'role' => ['required', 'integer'],
            'permission' => ['required', 'integer'],
        );
        $this->validate($request, $validate_data);

        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                /* Edit instance */
                $instance->role_id = $request->role;
                $instance->permission_id = $request->permission;
                $result = $instance->save();

                if ($result) {
//                    (new UserController())->clear();
                    return $this->function_response(201);
                }

                return $this->function_response(204);
            }

            return $this->function_response(404);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function _destroy($role_id, $permission_id)
    {
        try {
            PermissionToRole::where('role_id', $role_id)->where('permission_id', $permission_id)->delete();
            return $this->function_response(202);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
