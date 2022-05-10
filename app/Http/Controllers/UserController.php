<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new User();
        $this->modulename   = $this->instance::$modulename;
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
                'role' => Role::getRole(),
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
                'name' => ['required', 'string'],
                'mobile' => ['required', 'string', 'max:11', 'unique:users', new Mobile()],
                'password' => ['required', 'string', 'min:6'],
                'file' => 'file|max:2048|mimes:jpeg,jpg,bmp,png',
            );
            $this->validate($request, $validate_data);

            $this->instance->name = $request->name;
            $this->instance->mobile = $request->mobile;
            $this->instance->role_id = $request->role_id;
            $this->instance->password = bcrypt($request->password);
            $this->instance->picture = $this->uploadfile($request, $this->modulename['en']);
            $this->instance->title = $request->title;
            $this->instance->side = $request->side;
            $this->instance->expertise = $request->expertise;
            $this->instance->description = $this->SeoTagOptimization($request->description);
            $this->instance->created_by = (Auth::user()) ? Auth::id() : 1;
            $result = $this->instance->save();

            if ($result) {
                $roleController = new RoleController();
                $roleController->roleToUser($this->instance->role_id, $this->instance->id);

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
                    'role' => Role::getRole(),
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
                    'name' => ['required', 'string'],
                    'mobile' => ['required', 'string', 'max:11', new Mobile()],
                    'password' => ['string', 'min:6'],
                    'file' => 'file|max:2048|mimes:jpeg,jpg,bmp,png',
                );
                $this->validate($request, $validate_data);

                /* Edit user */
                $instance->name = $request->name;
                $instance->mobile = $request->mobile;
                $instance->role_id = $request->role_id;
                if ($request->password) $instance->password = bcrypt($request->password);
                if ($request->hasFile('file')) $instance->picture = $this->uploadfile($request, $this->modulename['en']);
                $instance->title = $request->title;
                $instance->side = $request->side;
                $instance->expertise = $request->expertise;
                $instance->description = $this->SeoTagOptimization($request->description);
                $result = $instance->save();

                if ($result) {
                    $roleController = new RoleController();
                    $roleController->roleToUser($instance->role_id, $instance->id);

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
     * Clear laravel cache
     *
     * @return string
     */
    public function clear()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            return 'completed...';

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
