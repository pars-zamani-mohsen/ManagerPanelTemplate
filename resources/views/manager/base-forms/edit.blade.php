@extends('layouts.manager.app')

@section('_title')
    <title>{{ config('app.name') . ' - ' . $modulename['fa'] }} </title>
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('manager/assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row pb-3">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    <p class="text-subtitle text-muted">لطفا اطلاعات را با دقت تکمیل کنید</p>
                </div>
                <div class="row col-12 col-md-6 order-md-2 order-first pb-md-0 pb-3">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/') }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/' . $modulename['en']) }}">فهرست {{ $modulename['fa'] }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $modulename['fa'] }}</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 text-end">
                        @yield('baseform_edit_head')
                        <a href="{{ url('/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/' . $modulename['en']) }}" class="btn btn-outline-primary col-xxl-3 col-lg-6 col-md-3 col-md-6 col-12">
                            <i class="bi bi-arrow-left-circle bi-line-height"></i> بازگشت </a>
                    </div>
                </div>
            </div>
        </div>

        @php if(isset($This) && $This) $operation = 'update'; else $operation = 'create'; @endphp
        @if((Auth::user()->isAbleTo([$operation . '-' . $modulename['model']])) || Auth::user()->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole()))
            @yield('form')
        @else
            <section id="ticket-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content pt-4">
                                <div class="card-body">
                                    @include('manager.403')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection

@section('script')
    <script src="{{ asset('manager/assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection
