@extends('layouts.manager.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/' . App\Http\Controllers\HomeController::fetch_manager_pre_url()) }}">داشبورد</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    <!-- Hoverable rows start -->
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="row justify-content-start"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            @include('manager.403')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hoverable rows end -->
    </div>
@endsection
