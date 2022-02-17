<?php

namespace App\Http\Controllers;

use App\Page;
use App\Blog;
use App\Advice;
use App\Comment;
use App\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('manager.home', array(
                'comment' => Comment::fetchAll_limited(10),
                'page' => Page::all()->count(),
                'blog' => Blog::all()->count(),
                'evaluation' => Evaluation::all()->count(),
                'advice' => Advice::all()->count(),
            ));

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * fetch All Module Name
     *
     * @param string|null $modulename
     * @return array|mixed
     */
    public static function fetchAllModuleName(string $modulename = null)
    {
        try {
            $modules = array(
                \App\ActivityLog::$modulename['model'] => \App\ActivityLog::$modulename['fa'],
                \App\Advice::$modulename['model'] => \App\Advice::$modulename['fa'],
                \App\Blog::$modulename['model'] => \App\Blog::$modulename['fa'],
                \App\Comment::$modulename['model'] => \App\Comment::$modulename['fa'],
                \App\Contact_us::$modulename['model'] => \App\Contact_us::$modulename['fa'],
                \App\Country::$modulename['model'] => \App\Country::$modulename['fa'],
                \App\CrsResult::$modulename['model'] => \App\CrsResult::$modulename['fa'],
                \App\Email::$modulename['model'] => \App\Email::$modulename['fa'],
                \App\Evaluation::$modulename['model'] => \App\Evaluation::$modulename['fa'],
                \App\Faq::$modulename['model'] => \App\Faq::$modulename['fa'],
                \App\Menu::$modulename['model'] => \App\Menu::$modulename['fa'],
                \App\News::$modulename['model'] => \App\News::$modulename['fa'],
                \App\Page::$modulename['model'] => \App\Page::$modulename['fa'],
                \App\Podcast::$modulename['model'] => \App\Podcast::$modulename['fa'],
                \App\Service::$modulename['model'] => \App\Service::$modulename['fa'],
                \App\User::$modulename['model'] => \App\User::$modulename['fa'],
                \App\Cases::$modulename['model'] => \App\Cases::$modulename['fa'],
                \App\TagCategory::$modulename['model'] => \App\TagCategory::$modulename['fa'],
                \App\Tag::$modulename['model'] => \App\Tag::$modulename['fa'],
                \App\Shortcode::$modulename['model'] => \App\Shortcode::$modulename['fa'],
                \App\Video::$modulename['model'] => \App\Video::$modulename['fa'],
            );

            if ($modulename)
                return $modules[$modulename];
            else
                return $modules;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Check user access for Actions
     *
     * @param string $model_name
     * @param string $action_type = [create, edit, delete]
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function user_access(string $model_name, string $action_type = 'create')
    {
        try {
            if ((Auth::user()->isAbleTo([$action_type . '-' . $model_name])) || Auth::user()->hasRole(self::getSystemOwnerRole())) {
                echo true;
            } else {
                die(view('manager.error', array('error_message' => __('errors.' . $action_type . '-no-access'))));
            }
            return null;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Get Owner Role for full access
     *
     * @return string
     */
    public static function getOwnerRole()
    {
        return 'admin';
    }
}
