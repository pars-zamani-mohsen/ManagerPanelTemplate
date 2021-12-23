<?php

namespace App\Http\Controllers;

use App\Cases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CasesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Cases();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
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
        try {
            $validate_data = array(
                'title' => 'required|string',
                'percent' => 'required|integer',
            );
            $this->validate($request, $validate_data);

            $this->instance->title = $request->title;
            $this->instance->percent = $request->percent;
            $this->instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
            $this->instance->created_by = (Auth::user()) ? Auth::id() : 1;
            $result = $this->instance->save();

            if ($result) {
                return $this->function_response(201);
            }

            return $this->function_response(204);

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
        try {
            $validate_data = array(
                'title' => ['required', 'string'],
                'percent' => ['required', 'integer']
            );
            $this->validate($request, $validate_data);

            $instance = $this->instance->_find($id);
            if ($instance) {
                /* Edit instance */
                $instance->title = $request['title'];
                $instance->percent = $request['percent'];
                $instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
                $result = $instance->save();

                if ($result) {
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
     * Active or deactive the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activation($id)
    {
        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                $instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
                $instance->save();

                return $this->function_response(205);
            }

            return $this->function_response(404);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
