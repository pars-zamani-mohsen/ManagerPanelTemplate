<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Page;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CommentController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Comment();
        $this->modulename   = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: "onlylist", "is_related_list", "import", "export" to add or remove buttons *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => ' فهرست ' . $this->modulename['fa'],
                'all' => $this->instance->fetchAll_paginate(20),
                'onlylist' => false,
                'search' => true,
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
        try {
            $validate_data = array(
                'name' => 'required|string',
                'modulename' => 'required|string',
                'record_id' => 'required|integer',
            );
            if ($request->mobile) $validate_data['mobile'] = ['max:11', new Mobile()];
            if ($request->email) $validate_data['email'] = ['email:rfc,dns'];
            $this->validate($request, $validate_data);

            $this->instance->name = $request['name'];
            $this->instance->email = $request['email'];
            $this->instance->mobile = $request['mobile'];
            $this->instance->content = $this->SeoTagOptimization($request['content']);
            $this->instance->modulename = $request['modulename'];
            $this->instance->record_id = $request['record_id'];
            if($request['comment_id']) $this->instance->comment_id = $request['comment_id'];
            $this->instance->user_id = Auth::id();
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
                'name' => 'required|string',
            );
            if ($request->mobile) $validate_data['mobile'] = ['max:11', new Mobile()];
            if ($request->email) $validate_data['email'] = ['email:rfc,dns'];
            $this->validate($request, $validate_data);

            $instance = $this->instance->_find($id);
            if ($instance) {
                $instance->name = $request['name'];
                $instance->email = $request['email'];
                $instance->mobile = $request['mobile'];
                $instance->content = $this->SeoTagOptimization($request['content']);
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
     * get ajax Module Records
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function getModuleRecords(Request $request)
    {
        try {
            $modulename = "\App\\".$request->id;
            return $modulename::fetchAll_active_limited_columns();

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
