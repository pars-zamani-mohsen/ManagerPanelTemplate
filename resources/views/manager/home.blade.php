@extends('layouts.manager.app')

@section('_title')
    <title>{{ config('app.name') . ' - داشبورد' }} </title>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('manager/assets/css/farsi-calendar.css') }}" />
@endsection

@section('content')
    <div class="page-heading">
        <h3>به سامانه مدیریت <b class="text-primary">پارسی کانادا</b> خوش آمدید</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dashboard-icon">
                                            <i class="bi bi-layout-text-sidebar-reverse bg-warning text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">تعداد کل برگه ها</h6>
                                        <h6 class="font-extrabold mb-0">{{ $page ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dashboard-icon">
                                            <i class="bi bi-journal-richtext bg-info text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">تعداد کل بلاگ ها</h6>
                                        <h6 class="font-extrabold mb-0">{{ $blog ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dashboard-icon">
                                            <i class="bi bi-card-checklist bg-primary text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">تعداد کل ارزیابی های مهاجرت</h6>
                                        <h6 class="font-extrabold mb-0">{{ $evaluation ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="dashboard-icon">
                                            <i class="bi bi-headset bg-success text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">تعداد کل درخواست های مشاوره</h6>
                                        <h6 class="font-extrabold mb-0">{{ $advice ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  main  --}}
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>آخرین نظر های ارسال شده</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>برگه</th>
                                            <th>نام</th>
                                            <th>ایمیل</th>
                                            <th>موبایل</th>
                                            <th>تاریخ ثبت</th>
                                            <th>فعال</th>
                                            <th class="d-none d-lg-table-cell">متن</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($comment))
                                                @foreach($comment as $item)
                                                    <tr class="text-center">
                                                        <td><a href="{{ url(\App\Http\Controllers\HomeController::fetch_manager_pre_url() . "/comment/".$item['id']."/edit") }}">#{{ $item['id'] }}</a></td>
                                                        <td>{{ $item['page_id'] }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['email'] }}</td>
                                                        <td>{{ $item['mobile'] }}</td>
                                                        <td>{{ App\AdditionalClasses\Date::timestampToShamsiDatetime($item['created_at']) }}</td>
                                                        <td>{{ $item['active'] }}</td>
                                                        <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($item['content'], 50) }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="4">
                                                        <p>در حال حاضر درخواستی ثبت نشده</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  /main  --}}

            {{--  side  --}}
            <div class="col-12 col-lg-3">
                {{--  profile  --}}
                <div class="card">
                    @php
                        $user = \Auth::user();
                    @endphp
                    <div class="card-body py-4 px-5">
                        <div class="row text-center">
                            <div class="col-12 col-xxl-4">
                                <div class="avatar avatar-xl position-relative edit-avatar">
                                    <img src="{{ asset('images/users/' . $user->picture) }}" alt="Face">
                                </div>
                            </div>
                            <div class="col-12 col-xxl-8">
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ $user->name }} ({{ \App\Role::getRoleLable($user->role_id) }})</h5>
                                    <h6 class="text-muted mb-0">{{ $user->mobile }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  /profile  --}}
            </div>
            {{--  /side  --}}
        </section>
        <section class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>تقویم</h4>
                    </div>
                    <div class="card-content pb-4 p-1">
                        <span class="fc-calendar"></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('manager/assets/js/farsi-calendar.js') }}"></script>
    <script>
        $(document).ready(function () {
            InitCalendar($(".fc-calendar"));
        });
    </script>
@endsection
