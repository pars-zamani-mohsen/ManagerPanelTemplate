<?php

namespace App\Http\Controllers;

use App\Country;
use App\Podcast;
use App\Service;
use App\Tag_rel;
use App\TagCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PodcastController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Podcast();
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
                'title' => 'required|string',
                'service' => 'required|integer',
                'country' => 'required|integer',
                'file' => 'required|file|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            );
            if ($request->picture) $validate_data['picture'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
            $this->validate($request, $validate_data);

            /* module options */
            $options = array(
                'comment' => (isset($request->comment) && $request->comment == 'on') ? true : false,
            );

            $this->instance->title = $request->title;
            $this->instance->description = $this->SeoTagOptimization($request->description);
            $this->instance->duration = 0;
            $this->instance->country_id = $request->country;
            $this->instance->service_id = $request->service;
            $this->instance->visit = ($request->visit) ? $request->visit : 0;
            $this->instance->like = ($request->like) ? $request->like : 0;
            $this->instance->file = $this->uploadfile($request, $this->modulename['en']);
            $this->instance->picture = $this->uploadfile($request, $this->modulename['en'], 'picture');
            $this->instance->options = $options;
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
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
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
            $validate_data = array(
                'title' => 'required|string',
                'service' => 'required|integer',
                'country' => 'required|integer',
            );
            if ($request->file) $validate_data['file'] = 'file|max:2048|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav';
            if ($request->picture) $validate_data['picture'] = 'file|max:2048|mimes:jpeg,jpg,bmp,png';
            $this->validate($request, $validate_data);

            /* module options */
            $options = array(
                'comment' => (isset($request->comment) && $request->comment == 'on') ? true : false,
            );

            $instance = $this->instance->_find($id);
            if ($instance) {
                /* Edit instance */
                $instance->title = $request->title;
                $instance->description = $this->SeoTagOptimization($request->description);
                $instance->duration = 0;
                $instance->country_id = $request->country;
                $instance->service_id = $request->service;
                $instance->visit = ($request->visit) ? $request->visit : 0;
                $instance->like = ($request->like) ? $request->like : 0;
                if ($request->hasFile('file')) $instance->file = $this->uploadfile($request, $this->modulename['en']);
                if ($request->hasFile('picture')) $instance->picture = $this->uploadfile($request, $this->modulename['en'], 'picture');
                $instance->options = $options;
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
