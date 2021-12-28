<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موسسه مهاجرتی پارسی کانادا</title>
    @yield('meta')

    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/logo/parsicanada-farsi.png') }}">

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('/landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/landing/css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/landing/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/landing/css/custom.css') }}">
    @yield('head')
</head>

<body>
<!-- header -->
<header class="main-header home-header">
    <!-- topheader -->
    <div class="top-header">
        <div class="container">
            <div class="row row-cols-lg-2 row-cols-md-1 align-items-center">
                <div class="col topheader-info">
                    <span class="ms-5">موسسه حقوقی دادگران حق و عدالت</span>
                    <a href="tel:02191300007"><span class="material-icons">phone_enabled</span> ۰۲۱۹۱۳۰۰۰۰۷</a>
                </div>
                <div class="col topheader-links text-start">
                    <a href="{{ url('/crs') }}">محاسبه ی Express Entry</a>
                    <a href="#">فرم ارزیابی مهاجرت</a>
                </div>
            </div>
        </div>
    </div>
    <!-- nav -->
    <div class="navbar-menu-wrapper" id="navbar_wrapper">
        <div class="container">
            <div class="">
                <div class="navbar-brand">
                    <a href="#"><img src="{{ asset('/landing/images/logo.png') }}" alt="Parsicanada"></a>
                </div>
                <span class="material-icons" id="open_menu">menu</span>
                <nav class="navbar-menu" id="navbar_menu">
                    <ul class="d-flex align-items-center flex-wrap" id="pars_menu_first">
                        <span class="material-icons" id="close_menu">close</span>
                        <li class="active-link"><a href="#"><i class="material-icons">home</i></a></li>
                        <li><a href="#">کانادا</a>
                            <div class="mega-menu">
                                <ul>
                                    <li class="mega-item "><a class="mega-link " href="#">ویزای کاری</a>
                                        <div class="sub-mega-wrapper ">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div></li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت از طریق برنامه های استانی</a>
                                        <div class="sub-mega-wrapper"></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">استرالیا</a>
                            <div class="mega-menu">
                                <ul>
                                    <li class="mega-item "><a class="mega-link " href="#">ویزای کاری</a>
                                        <div class="sub-mega-wrapper ">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div></li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت از طریق برنامه های استانی</a>
                                        <div class="sub-mega-wrapper"></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">کشورهای حوزه خلیج فارس</a>
                            <div class="mega-menu">
                                <ul>
                                    <li class="mega-item "><a class="mega-link " href="#">ویزای کاری</a>
                                        <div class="sub-mega-wrapper ">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div></li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت تحصیلی</a>
                                        <div class="sub-mega-wrapper">
                                            <ul>
                                                <div class="sub-mega-item">
                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">s </a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="sub-mega-img">
                                                            <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                                                     alt="image"></a></figure>

                                                        </div>
                                                        <div class="sub-mega-content">
                                                            <div class="sub-mega-title">
                                                                <h4><a href="#">اسکیل وورکر</a></h4>
                                                            </div>
                                                            <div class="sub-mega-excerpt">
                                                                <p> آمار و ارقام حاکی از بهبود وضعیت کاری و رشد
                                                                    مشاغل در کانادا است و این روند روبه رشد.....
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="mega-item"><a class="mega-link" href="#">مهاجرت از طریق برنامه های استانی</a>
                                        <div class="sub-mega-wrapper"></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">سایر کشورها</a></li>
                        <li><a href="#">ویزای شینگن</a></li>
                        <li><a href="#">پادکست </a></li>
                        <li><a href="#">ارتباط با ما</a></li>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="responsive-menu">
        <div class="responsive-menu-wrapper">
            <div class="chat-icon">
                <div class="chat-icon-inner">
                    <a href="#"><span class="material-icons">headset</span></a>
                </div>
            </div>
            <div class="menu-part">
                <div class="menu-item">
                    <a href="#">
                        <span class="material-icons">home </span>
                        خانه
                    </a>
                </div>
                <div class="menu-item">
                    <a href="#">
                        <span class="material-icons">dashboard </span>
                        خدمات
                    </a>
                </div>
            </div>
            <div class="menu-part">
                <div class="menu-item">
                    <a href="#">
                        <span class="material-icons">chat </span>
                        مشاوره
                    </a>
                </div>
                <div class="menu-item">
                    <a href="#">
                        <span class="material-icons">assignment </span>
                        ارزیابی
                    </a>
                </div>
            </div>
        </div>
        <svg id="navbar" xml:space="preserve" width="100%" version="1.1"
             style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
             viewBox="0 0 510.9 82.18" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <style type="text/css">
                        .fil0 {
                            fill: #FFF
                        }
                    </style>
                </defs>
            <g id="Layer_x0020_1">
                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                <path class="fil0"
                      d="M255.45 54.78c8.15,0 16.3,-3.09 22.48,-9.27l33.46 -33.46c5.92,-5.96 11.44,-11.65 21.85,-12.05l177.66 0 0 82.18 -255.45 0 -255.45 0 0 -82.18 177.66 0c10.41,0.4 15.93,6.09 21.85,12.05l33.46 33.46c6.18,6.18 14.33,9.27 22.48,9.27z">
                </path>
            </g>
            </svg>
    </div>
</header>
    @yield('content')
<!-- footer -->
<footer class="main-footer">
    <div class="footer-logo"><a href="#"><img src="{{ asset('/landing/images/logo-footer.png') }}" alt="parsicanada"></a></div>
    <div class="container">
        <div class="row row-cols-md-3 row-cols-1 footer-column-wrapper">
            <div class="col col-md-3 footer-column contact-us">
                <div class="column-footer-title">
                    <p>ارتباط با ما</p>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">location_on</i>
                    <p> دفتر تهران: شهرک غرب، بلوار دریا، خیابان موج تقاطع توحید 3، پلاک ۴</p>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">phone</i>
                    <p> ۰۲۱۹۱۰۰۳۵۵۸</p>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">location_on</i>
                    <p> دفتر اصفهان: خیابان آزادی، خیابان سعادت آباد، هولدینگ پارس پندار نهاد</p>
                </div>
                <div class="footer-contact-item">
                    <i class="material-icons">phone</i>
                    <p> ۰۲۱۹۱۳۰۰۰۰۷</p>
                </div>
            </div>
            <div class="col col-md-5 footer-column contact-us">
                <div class="row">
                    <div class="col">
                        <div class="column-footer-title">
                            <p>دسترسی سریع</p>
                        </div>
                        <ul>
                            <li><a href="#">صفحه ی اصلی</a></li>
                            <li><a href="#">وبلاگ</a></li>
                            <li><a href="#">تماس با ما</a></li>
                            <li><a href="#">فرم ارزیابی مهاجرت </a></li>
                            <li><a href="#">محاسبه اکسپرس اینتری</a></li>
                        </ul>
                    </div>

                    <div class="col">
                        <div class="column-footer-title">
                            <p>انواع ویزا</p>
                        </div>
                        <ul>
                            <li><a href="#">ویزای کاری</a></li>
                            <li><a href="#">ویزای تحصیلی </a></li>
                            <li><a href="#">ویزای توریستی</a></li>
                            <li><a href="#">ویزای شینگن</a></li>
                            <li><a href="#">ویزای سرمایه گذاری</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col col-md-4 footer-column">
                <div class="row row-cols-2">
                    <div class="col-7">
                        <div class="column-footer-title">
                            <p> جدیدترین پادکست </p>
                        </div>
                        <ul>
                            <li><a href="#">توضیحات افراد موفق</a></li>
                            <li><a href="#">توضیحات مدیر پارسی کانادا</a></li>
                            <li><a href="#">توضیحات مشاوران</a></li>
                            <li><a href="#">مهاجرت در دوران کرونا</a></li>
                        </ul>
                    </div>
                    <div class="col-5">
                        <figure class="mt-5 text-end">
                            <img class="img-fluid" src="{{ asset('/landing/images/footer-certificate.png') }}" alt="footer-certificate">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-10  footer-column insta-api mx-auto">
                <div class="insta-api-inner">
                    <div class="row align-items-center">
                        <div class="col-8 clr">
                            <div class="column-footer-title">
                                <p>آخرین پست های ما در اینستاگرام</p>
                            </div>
                        </div>
                        <div class="col-4 cll">
                            <a href="#" class="follow-insta float-start"> <i class="material-icons">thumb_up</i> ما
                                را دنبال کنید</a>
                        </div>
                    </div>
                    <div class="splide insta-carousel">
                        <div class="splide__track">
                            <div class="splide__list">
                                <div class="insta-item splide__slide ">
                                    <figure><a href="#"><img src="{{ asset('/landing/images/insta1.jpg') }}"
                                                             alt="parsicanada instagram"></a></figure>
                                </div>
                                <div class="insta-item splide__slide ">
                                    <figure><a href="#"><img src="{{ asset('/landing/images/insta2.jpg') }}"
                                                             alt="parsicanada instagram"></a></figure>
                                </div>
                                <div class="insta-item splide__slide ">
                                    <figure><a href="#"><img src="{{ asset('/landing/images/insta3.jpg') }}"
                                                             alt="parsicanada instagram"></a></figure>
                                </div>
                                <div class="insta-item splide__slide ">
                                    <figure><a href="#"><img src="{{ asset('/landing/images/insta4.jpg') }}"
                                                             alt="parsicanada instagram"></a></figure>
                                </div>
                                <div class="insta-item splide__slide ">
                                    <figure><a href="#"><img src="{{ asset('/landing/images/insta5.jpg') }}"
                                                             alt="parsicanada instagram"></a></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-socials">
            <div class="footer-social-title">
                <p>ما را در شبکه های اجتماعی دنبال کنید</p>
            </div>
            <div class="social-icons">
                <a href="https://www.instagram.com/parsicanada/" target="_blank" rel="noreferrer noopener"><img src="{{ asset('/landing/images/instagram.svg') }}" alt="parsicanda"></a>
                <a href="https://t.me/parsicanadacom" target="_blank" rel="noreferrer noopener"><img src="{{ asset('/landing/images/telegram.svg') }}" alt="parsicanda"></a>
                <a href="https://www.youtube.com/channel/UCYZmvJGd7RziBPxzR4iM4Bg/videos" target="_blank" rel="noreferrer noopener"><img src="{{ asset('/landing/images/youtube.svg') }}" alt="parsicanda"></a>
                <a href="https://www.linkedin.com/company/parsicanada" target="_blank" rel="noreferrer noopener"><img src="{{ asset('/landing/images/linkedin.svg') }}" alt="parsicanda"></a>
            </div>
        </div>
    </div>
</footer>

@if (count($errors) > 0)
    @foreach ($errors->all() as $key => $error)
        <div class="toast-container position-fix p-3 bottom-{{ $key }} end-0">
            <div class="toast toast-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="18000">
                <div class="toast-body">
                    <div class="row">
                        <div class="col-11">
                            <p>
                                {!! $error !!}
                            </p>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn-close float-start" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="clearfix"></div>
@endif

@if (Session::has('message'))
    <div class="toast-container position-fix p-3 bottom-0 end-0">
        <div class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="18000">
            <div class="toast-body">
                <div class="row">
                    <div class="col-11">
                        <p>
                            {!! Session::get('message') !!}
                        </p>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn-close float-start" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endif

@if (Session::has('alert'))
    <div class="toast-container position-fix p-3 bottom-0 end-0">
        <div class="toast toast-warning" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="18000">
            <div class="toast-body">
                <div class="row">
                    <div class="col-11">
                        <p>
                            {!! Session::get('alert') !!}
                        </p>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn-close float-start" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endif

@if (Session::has('error'))
    <div class="toast-container position-fix p-3 bottom-0 end-0">
        <div class="toast toast-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="18000">
            <div class="toast-body">
                <div class="row">
                    <div class="col-11">
                        <p>
                            {!! Session::get('error') !!}
                        </p>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn-close float-start" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endif
<!-- script -->
<script src="{{ asset('/landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/landing/js/splide.min.js') }}"></script>
<script src="{{ asset('/landing/js/fslightbox.js') }}"></script>
<script src="{{ asset('/landing/js/index.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Creates an array of toasts (it only initializes them)
            return new bootstrap.Toast(toastEl) // No need for options; use the default options
        });
        toastList.forEach(toast => toast.show()); // This show them
    });
</script>
@yield('script')

</body>
</html>
