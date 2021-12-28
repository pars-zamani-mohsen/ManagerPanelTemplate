<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class CountryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance     = new Country();
        $this->modulename   = $this->instance::$modulename;
        $this->parent       = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
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
                'file' => 'file|max:2048|mimes:jpeg,jpg,bmp,png',
            );
            $this->validate($request, $validate_data);

            $this->instance->title = $request->title;
            $this->instance->picture = $this->uploadfile($request, $this->modulename['en']);
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
            $instance = $this->instance->_find($id);
            if ($instance) {
                $validate_data = array(
                    'title' => 'required|string',
                    'file' => 'file|max:2048|mimes:jpeg,jpg,bmp,png',
                );
                $this->validate($request, $validate_data);

                /* Edit user */
                $instance->title = $request->title;
                if ($request->hasFile('file')) $instance->picture = $this->uploadfile($request, $this->modulename['en']);
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
}
