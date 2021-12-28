<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Menu();
        $this->modulename   = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
            'modulename' => $this->modulename,
            'title' => 'ایجاد ' . $this->modulename['fa'],
            'parent' => Menu::fetchAll_active(),
        ));
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
            'title' => 'required|string',
        );
        $this->validate($request, $validate_data);

        $this->instance->title = $request->title;
        $this->instance->parent_id = $request->parent;
        $this->instance->url = $request->url;
        $this->instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
        $this->instance->created_by = (Auth::user()) ? Auth::id() : 1;
        $result = $this->instance->save();

        if ($result) {
            return $this->function_response(201);
        }
        return $this->function_response(204);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $instance = $this->instance->_find($id);
        if ($instance) {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
                'modulename' => $this->modulename,
                'title' => $this->modulename['fa'] . ' #' . $instance->id,
                'This' => $instance,
                'parent' => Menu::fetchAll_active(),
            ));
        }

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
        $instance = $this->instance->_find($id);
        if ($instance) {
            $validate_data = array(
                'title' => ['required', 'string']
            );
            $this->validate($request, $validate_data);

            /* Edit user */
            $instance->title = $request['title'];
            $instance->parent_id = $request->parent;
            $instance->url = $request->url;
            $instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
            $result = $instance->save();
            if ($result) {
                return $this->function_response(201);
            }
            return $this->function_response(204);
        }

        return $this->function_response(404);
    }
}
