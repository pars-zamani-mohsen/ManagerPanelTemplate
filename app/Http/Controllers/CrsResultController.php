<?php

namespace App\Http\Controllers;

use App\Email;
use App\Message;
use App\CrsResult;
use App\Jobs\SendMail;
use Illuminate\Http\Request;
use App\AdditionalClasses\Date;
use App\Exports\CrsResultExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Kavenegar\Exceptions\ApiException;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use App\AdditionalClasses\CustomValidator;

class CrsResultController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new CrsResult();
        $this->modulename = $this->instance::$modulename;
        $this->parent = array('path' => HomeController::fetch_manager_pre_path(), 'url' => HomeController::fetch_manager_pre_url());
    }

    /**
     * Display a listing of the resource.
     *
     * Return params can have: "onlylist", "is_related_list", "import" to add or remove buttons *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            return view($this->parent['path'] . '.' . $this->modulename['en'] . '.list', array(
                'modulename' => $this->modulename,
                'title' => ' فهرست ' . $this->modulename['fa'],
                'all' => $this->instance->fetchAll_paginate(20),
                'onlylist' => true,
                'export' => true,
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('landing.crs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function store(Request $request)
    {
        try {
            $score = new ScoreController();
            $response = $score->calc($request);
            $_request = $request->all();
            unset($_request['_token']);

            $instance = new CrsResult();
            $instance->name = $request->name;
            $instance->family = $request->family;
            $instance->mobile = $request->mobile;
            $instance->request = $_request;
            $instance->score = $response['total'];
            $instance->result = $response;
            $instance->save();

            /* Send SMS */
            if (CustomValidator::mobile_validator($request->mobile)) {
                $name = 'کاربر';
                if ($request->name && $request->family) $name = $request->name . ' ' . $request->family;
                elseif ($request->name) $name = $request->name;
                elseif ($request->family) $name = $request->family;
                $name .= ' عزیز.';

                $message = "سلام " . $name;
                $message .= "\n شما از ارزیابی مهاجرت برای کشور کانادا " . $response['total'] . " امتیاز کسب کردید. ";
                $message .= "\n https://crs.parsicanada.com/ ";
                Message::send_simple_sms(Message::getSmsSenderNumber(), [$request->mobile], $message);
            }

            /* Send Mail */
            $emails = Email::active()->get();
            foreach ($emails as $item) {
                try {
//                Mail::to($item->email)->send(new \App\Mail\CrsResult($instance));
                    Message::send_Mail($item->email, $instance);

                } catch (\Exception $ex) {
//                $ex->message
                }
            }

            return $response;

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Export data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        try {
            if ($request->exportDataType == 'date') {
                $date = Date('Y-m-d', Date::shamsiToTimestamp($request->date));

                $crsResult = CrsResult::
                where('created_at', '>', strtotime($date . ' 00:00:00'))
                    ->where('created_at', '<', strtotime($date . ' 23:59:59'))
                    ->get()->toArray();
            } elseif ($request->exportDataType == 'one_hundred') {
                $crsResult = CrsResult::orderBy('id', 'DESC')->limit(100)->get()->toArray();
            } else {
                $crsResult = CrsResult::all()->toArray();
            }

            if (count($crsResult)) {
                foreach ($crsResult as $key => $item) {
                    $crsResult[$key]['created_at'] = Date::timestampToShamsiDatetimeEng($item['created_at']);
                    $crsResult[$key]['updated_at'] = Date::timestampToShamsiDatetimeEng($item['updated_at']);
                }
                return Excel::download(new CrsResultExport(collect($crsResult)), 'CrsResultExport.xlsx');
            } else
                return redirect()->back()->withErrors(['هیچ رکوردی یافت نشد.']);

        } catch (\Exception $e) {
            Session::flash('alert', $e->getMessage());
            return redirect()->back();
        }
    }
}
