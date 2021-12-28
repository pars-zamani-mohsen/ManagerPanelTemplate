<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class VideoController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Video();
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
        $validate_data = array(
            'title' => ['required', 'string'],
        );
        if ($request->picture) $validate_data['picture'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
        $this->validate($request, $validate_data);

        /* module options */
        $options = array(
            'class' => $request->class,
            'preload' => $request->preload,
            'autoplay' => (isset($request->autoplay) && $request->autoplay == 'on') ? 1 : 0,
            'controls' => (isset($request->controls) && $request->controls == 'on') ? 1 : 0,
            'height' => $request->height,
            'width' => $request->width,
        );

        try {
            $this->instance->title = $request->title;
            $this->instance->description = $request->description;
            $this->instance->options = $options;
            $this->instance->picture = $this->uploadfile($request, $this->modulename['en'], 'picture');
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
                    'all' => VideoFile::fetchAll_static_paginate($id, 10),
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
            'title' => ['required', 'string'],
        );
        if ($request->picture) $validate_data['picture'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
        $this->validate($request, $validate_data);

        /* module options */
        $options = array(
            'class' => $request->class,
            'preload' => $request->preload,
            'autoplay' => (isset($request->autoplay) && $request->autoplay == 'on') ? 1 : 0,
            'controls' => (isset($request->controls) && $request->controls == 'on') ? 1 : 0,
            'height' => $request->height,
            'width' => $request->width,
        );

        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                /* Edit instance */
                $instance->title = $request->title;
                $instance->description = $request->description;
                $instance->options = $options;
                if ($request->hasFile('picture')) $instance->picture = $this->uploadfile($request, $this->modulename['en'], 'picture');
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
     * Upload video
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function video_upload(Request $request)
    {
        $validate_data = array(
            'file' => ['required', 'file', 'mimes:mp4,mov,ogg,mkv,mpeg,avi'],
            'video_id' => ['required', 'integer'],
            'quality' => ['required', 'string'],
            'country' => ['required', 'string'],
        );
        $this->validate($request, $validate_data);

        try {
            $instance = new VideoFile();
            $instance->file = $this->uploadfile($request, $this->modulename['en']);
            $instance->duration = 0;
            $instance->video_id = $request->video_id;
            $instance->quality = $request->quality;
            $instance->country = $request->country;
            $instance->created_by = (Auth::user()) ? Auth::id() : 1;
            $result = $instance->save();

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
     * Upload video
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function video_delete($id)
    {
        try {
            $instance = VideoFile::find($id);
            if ($instance) {
                if (file_exists(config('app.host_public_path') . $instance["file"])) {
                    unlink(config('app.host_public_path') . $instance["file"]);
                }
                $instance->delete();
            }
            return $this->function_response(202);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
