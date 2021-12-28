<?php

namespace App\Http\Controllers;

use App\Recyclebin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RecyclebinController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Recyclebin();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: onlylist, is_related_list, import to add or remove buttons *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => $this->modulename['fa'],
                'modulenamelist' => $this->instance->fetchAllModuleName(),
                'all' => array(),
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: onlylist, is_related_list, import to add or remove buttons *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function list($id)
    {
        try {
            $model = '\\App\\' . $id;
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => $this->modulename['fa'],
                'modulenamelist' => $this->instance->fetchAllModuleName(),
                's_modulename' => $id,
                'all' => $model::fetch_allTrush_limited_columns(20)
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param $model
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function restore($model, $id)
    {
        try {
            $c_model = '\\App\\' . $model;
            $instance = $c_model::withTrashed()->find($id);
            if ($instance) {
                $instance->restore();
                return $this->function_response(202);
            }

            return $this->function_response(404);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $model
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function delete($model, $id)
    {
        try {
            $c_model = '\\App\\' . $model;
            $instance = $c_model::withTrashed()->find($id);
            if ($instance) {
                $instance->forceDelete();
                return $this->function_response(202);
            }

            return $this->function_response(404);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
