<?php

namespace App;

use App\Http\Controllers\DashboardController;
use Illuminate\Database\Eloquent\Model;

class Recyclebin extends Model
{
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    public static $modulename = array('en' => 'recyclebin', 'fa' => 'سطل بازیابی', 'model' => 'Recyclebin');

    /**
     * fetch All records(paginate)
     *
     * @param $limit
     * @return mixed
     */
    public function fetchAll_paginate($limit)
    {
            return ActivityLog::onlyTrashed()->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * fetch All Module Name
     * @return array
     */
    public function fetchAllModuleName()
    {
        return DashboardController::fetchAllModuleName();
    }
}
