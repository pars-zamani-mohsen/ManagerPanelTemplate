<?php

namespace App\Http\Controllers;

use App\Cases;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('landing.home', array(
                'cases' => Cases::active()->get(),
                'podcast' => Podcast::fetchAll_active_limited_columns(8),
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    public static function fetch_manager_pre_url()
    {
        return '_manager';
    }

    public static function fetch_manager_pre_path()
    {
        return 'manager';
    }
}
