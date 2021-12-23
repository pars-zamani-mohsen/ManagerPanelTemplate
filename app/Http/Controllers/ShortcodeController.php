<?php

namespace App\Http\Controllers;

use App\Shortcode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShortcodeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Shortcode();
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
                'modulenamelist' => DashboardController::fetchAllModuleName(),
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
            'title' => ['required', 'string'],
            'modulename' => ['required', 'string'],
        );
        $this->validate($request, $validate_data);

        try {
            $this->instance->title = $request->title;
            $this->instance->modulename = $request->modulename;
            $this->instance->content = $this->SeoTagOptimization($request['content']);
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
                    'modulenamelist' => DashboardController::fetchAllModuleName(),
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
            'modulename' => ['required', 'string'],
        );
        $this->validate($request, $validate_data);

        try {
            $instance = $this->instance->_find($id);
            if ($instance) {
                /* Edit instance */
                $instance->title = $request->title;
                $instance->modulename = $request->modulename;
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
     * Short code constructor
     *
     * @param string $text
     * @return array|string|string[]
     */
    public static function shortCodeConstructor(string $text)
    {
        try {
            if (preg_match_all('~\(([^{()}]*)\)~', $text, $matches)) {
                $shortcode_instance = new Shortcode();
                foreach ($matches[1] as $item) {
                    $shortcode = explode('#', $item);
                    $shortcode_instance = $shortcode_instance->_find($shortcode['1']);

                    $search = "{($item)}";
                    $text = str_replace($search, $shortcode_instance->content, $text);
                }
            }

            return $text;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Get shortcode id by relation id
     *
     * @param $id
     * @return mixed
     */
    public function related_record($id)
    {
        try {
            $instance = Shortcode::fetch_active_by_relation("Video", $id);
            if (!$instance) {
                $instance = new Shortcode();
                $instance->title = $_REQUEST['title'];
                $instance->modulename = "Video";
                $instance->record_id = $id;
                $instance->content = '';
                $instance->active = true;
                $instance->created_by = (Auth::user()) ? Auth::id() : true;
                $instance->save();
            }
            return $instance;

        } catch (\Exception $ex) {
            die($ex);
        }
    }
}
