<?php

namespace App\Http\Controllers;

use App\News;
use App\Country;
use App\Service;
use App\Tag_rel;
use App\TagCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class NewsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance     = new News();
        $this->modulename   = $this->instance::$modulename;
        $this->parent       = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: onlylist, is_related_list, import to add or remove buttons
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => ' فهرست ' . $this->modulename['fa'],
                'all' => $this->instance->fetchAll_paginate_limited_columns(20),
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.edit', array(
                'modulename' => $this->modulename,
                'title' => 'ایجاد '. $this->modulename['fa'],
                'country' => Country::fetchAll_active(),
                'service' => Service::fetchAll_active(),
                'tagCategory' => TagCategory::fetchAll_active_with_chield(),
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
                'slug' => 'required|string',
                'title' => 'required|string',
            );
            if ($request->file) $validate_data['file'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
            $this->validate($request, $validate_data);

            /* module options */
            $options = array(
                'comment' => (isset($request->comment) && $request->comment == 'on') ? true : false,
                'publisher' => (isset($request->publisher) && $request->publisher == 'on') ? true : false,
            );

            $this->instance->country_id = $request->country;
            $this->instance->service_id = $request->service;
            $this->instance->title = $request->title;
            $this->instance->slug = $request->slug;
            $this->instance->h1 = $request->h1;
            $this->instance->meta_title = $request->meta_title;
            $this->instance->meta_desc = $request->meta_desc;
            $this->instance->meta_canonical = $request->meta_canonical;
            $this->instance->meta_keyword = $request->meta_keyword;
            $this->instance->meta_redirect = $request->meta_redirect;
            $this->instance->meta_robot = $request->meta_robot;
            $this->instance->meta_follow = $request->meta_follow;
            $this->instance->description = $this->SeoTagOptimization($request->description);
            $this->instance->options = $options;
            $this->instance->picture = $this->uploadfile($request, $this->modulename['en']);
            $this->instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
            $this->instance->created_by = (Auth::user()) ? Auth::id() : 1;
            $result = $this->instance->save();

            if ($result) {
                /* tag */
                if ($request->tag) {
                    $this->add_tag_relation($request->tag, $this->instance->id, $this->modulename['model']);
                }
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
                    'country' => Country::fetchAll_active(),
                    'service' => Service::fetchAll_active(),
                    'tagCategory' => TagCategory::fetchAll_active_with_chield(),
                    'tag_rel' => Tag_rel::fetch_array_tags_id_by_record_id($id, $this->modulename['model'])->toArray(),
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
        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                $validate_data = array(
                    'slug' => 'required|string',
                    'title' => 'required|string',
                );
                if ($request->file) $validate_data['file'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
                $this->validate($request, $validate_data);

                /* module options */
                $options = array(
                    'comment' => (isset($request->comment) && $request->comment == 'on') ? true : false,
                    'publisher' => (isset($request->publisher) && $request->publisher == 'on') ? true : false,
                );

                /* Edit user */
                $instance->country_id = $request->country;
                $instance->service_id = $request->service;
                $instance->title = $request->title;
                $instance->slug = $request->slug;
                $instance->h1 = $request->h1;
                $instance->meta_title = $request->meta_title;
                $instance->meta_desc = $request->meta_desc;
                $instance->meta_canonical = $request->meta_canonical;
                $instance->meta_keyword = $request->meta_keyword;
                $instance->meta_redirect = $request->meta_redirect;
                $instance->meta_robot = $request->meta_robot;
                $instance->meta_follow = $request->meta_follow;
                $instance->description = $this->SeoTagOptimization($request->description);
                $instance->options = $options;
                if ($request->hasFile('file')) $instance->picture = $this->uploadfile($request, $this->modulename['en']);
                $instance->active = (isset($request->active) && $request->active == 'on') ? 1 : 0;
                $result = $instance->save();
                if ($result) {
                    /* tag */
                    if ($request->tag) {
                        $this->add_tag_relation($request->tag, $instance->id, $this->modulename['model']);
                    }
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
