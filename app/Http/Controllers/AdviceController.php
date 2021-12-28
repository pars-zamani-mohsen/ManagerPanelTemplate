<?php

namespace App\Http\Controllers;

use App\Advice;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class AdviceController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Advice();
        $this->modulename   = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => ' فهرست ' . $this->modulename['fa'],
                'all' => $this->instance->fetchAll_paginate(20),
                'onlylist' => true,
                'search' => true,
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->function_response(404);
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
                'name' => ['required', 'string'],
                'phone' => ['required', 'string', new Mobile()],
            );
            $this->validate($request, $validate_data);

            $this->instance->name = $request->name;
            $this->instance->phone = $request->phone;
            $this->instance->email = $request->email;
            $this->instance->age = $request->age;
            $this->instance->education_level = ($request->education_level) ? $request->education_level : 'school';
            $this->instance->created_by = (Auth::user()) ? Auth::id() : 1;
            $result = $this->instance->save();

            if ($result) {
                return $this->function_response(0201);
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
