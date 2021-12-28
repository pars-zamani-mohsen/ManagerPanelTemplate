<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laratrust\Models\LaratrustPermission;

class PermissionController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Permission();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
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
                'module' => DashboardController::fetchAllModuleName(),
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
            'module' => ['required', 'string'],
        );
        $this->validate($request, $validate_data);

        try {
            $result = false;
            foreach ($request->all() as $key => $item) {
                if (in_array($key, ['show', 'create', 'update', 'delete'])) {
                    $instance = $this->instance::firstOrNew([
                        'name' => $key . '-' . $request->module
                    ]);

                    if (!(isset($instance->id) && $instance->id)) {
                        $instance->name = $key . '-' . $request->module;
                        $instance->display_name = __('fields.' . $key) . ' ' . DashboardController::fetchAllModuleName($request->module);
                        $instance->description = $request->description;
                        $result = $instance->save();
                    }
                }
            }

            if ($result) {
                return $this->function_response(201);
            }

            return $this->function_response(204, 'خطا در ثبت اطلاعات! (رکورد تکراری)');

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
        return $this->function_response(404);
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
        return $this->function_response(404);
    }
}
