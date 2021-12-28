<?php

namespace App\Http\Controllers;

use App\TagCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class TagCategoryController extends BaseController
{
    /**
     * TagCategoryController constructor.
     */
    public function __construct()
    {
        $this->instance = new TagCategory();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }
}
