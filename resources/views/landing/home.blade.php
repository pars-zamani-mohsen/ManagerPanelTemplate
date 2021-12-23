@extends('layouts.landing.app')

@section('content')
    <!-- first-content -->
    <section class="first-content">
        <div class="container">
            <div class="row row-cols-md-2 align-items-center">
                <div class="col">
                    <h1 class="home-main-title">پارسی کانادا با مشاورین ICCRC با بیش از 1200 پرونده مهاجرتی موفق ، در
                        مسیر رسیدن به رویاهایتان همراه شماست .</h1>
                </div>
                <div class="col recommded-form-wrapper">
                    <div class="recommend-im-way">
                        <div class="recommend-way-title text-center">
                            <p class="">پیشنهاد مهاجرتی</p>
                        </div>
                        <div class="recommend-way-subtite text-center"><span>اطلاعاتتان را وارد کنید تا ما به شما بهترین
                                روش را پیشنهاد دهیم</span></div>
                        <div class="recommend-way-form">
                            <form method="post" action="{{ url('/advice') }}">
                                @csrf
                                <input class="form-control" type="text" name="name" id="name" placeholder="نام و نام خانوادگی *" required>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="شماره همراه *" required>
                                <div class="select-wrapper">
                                    <select name="education_level" id="education_level">
                                        <option value="">انتخاب کنید</option>
                                        <option value="school">سیکل</option>
                                        <option value="diploma">دیپلم</option>
                                        <option value="associate_degree">فوق دیپلم</option>
                                        <option value="bachelor">لیسانس</option>
                                        <option value="master">فوق لیسانس</option>
                                        <option value="doctoral">دکتری</option>
                                    </select>
                                </div>
                                <div class="select-wrapper">
                                    <select name="age" id="age">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1">کمتر از 20 سال</option>
                                        <option value="2">20 تا 30 سال</option>
                                        <option value="3">31 تا 40 سال</option>
                                        <option value="4">41 تا 50 سال</option>
                                        <option value="5">51 سال و بالاتر</option>
                                    </select>
                                </div>
                                <input class="form-control secondary-btn" type="submit" value="درخواست مشاوره رایگان">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fast-contact">
                <div class="fast-contact-inner">
                    <div class="fast-contact-item fci1">
                        <a href="#">
                            <span class="material-icons">phone_enabled</span>
                            <span class="fast-contact-text fct1">تماس با مشاوران ما</span>

                        </a>
                    </div>
                    <div class="fast-contact-item fci2">
                        <a href="#">
                            <span class="material-icons">whatsapp</span>
                            <span class="fast-contact-text fct2">ارتباط در واتساپ</span>
                        </a>
                    </div>

                </div>
            </div>
            <div class="arrow-scroll">
                <span class="material-icons">expand_more</span>
                <span class="material-icons">expand_more</span>
            </div>
        </div>

    </section>
    <!-- why-us -->
    <section class="why-us">
        <div class="container">
            <div class="row">
                <div>
                    <p class="home-section-title">چرا موسسه مهاجرتی پارسی کانادا</p>
                </div>
                <div class="why-us-subtitle mt-3">
                    <p class="text-center">موسسه حقوقی بین المللی دادگران حق و عدالت با مجوز قانونی و شماره ثبت 40681 در
                        سال 1395 فعالیت خود را شروع کرد. این موسسه از جمله مراکز معتبری است که به متقاضیان اخذ ویزای
                        کانادا و استرالیا کمک می کند با صرف هزینه های معقول و در کوتاه ترین زمان ممکن با استفاده از
                        خدمات مشاوره این مرکز در راستای رسیدن به اهداف خود اقدام نمایند.</p>
                </div>
                <div class="our-services">
                    <div class="world-circle">
                        <div class="pre-services">
                            <p>پشتیبانی ۷۲۴</p>
                            <p>زمانبندی مشخص</p>
                            <p>تکمیل اطلاعات و پیگیری آن</p>

                        </div>
                        <img src="{{ asset('/landing/images/world-circle.svg') }}" alt="">
                        <div class="after-services">
                            <p>مشاوره رایگان</p>
                            <p>ارزیابی واقعی شما</p>
                            <p>پنل های مختلف مهاجرتی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- choose-visa -->
    <section class="choose-visa">
        <div class="container">
            <div class="row">
                <div>
                    <p class="home-section-title">با ما بهترین تجربه خدمات مهاجرتی را داشته باشید!</p>
                </div>
                <div class="home-section-subtitle mt-3 mb-4">
                    <p class="text-center">ویزای خود را انتخاب کنید</p>
                    <div class="arrow-scroll">
                        <span class="material-icons">expand_more</span>
                        <span class="material-icons">expand_more</span>
                    </div>

                </div>
                <div class="visa-items-warpper row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
                    <div class="col visa-item">
                        <div class="choose-visa-box">
                            <div class="visa-box-title">
                                <h2>ویزای کاری</h2>
                            </div>
                            <div class="visa-box-icon">
                                <i class="pars-job-visa"></i>
                            </div>
                            <div class="visa-box-text">
                                <p>برنامه‌های مختلفی برای مهاجرت کاری به کانادا وجود دارد که با توجه به شرایط خود
                                    می‌توانید با استفاده از یکی از آن‌ها اقامت کاری کانادا را اخذ کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col visa-item">
                        <div class="choose-visa-box">
                            <div class="visa-box-title">
                                <h2>ویزای سرمایه گذاری</h2>
                            </div>
                            <div class="visa-box-icon">
                                <i class="pars-money"></i>
                            </div>
                            <div class="visa-box-text">
                                <p>برنامه‌های مختلفی برای مهاجرت کاری به کانادا وجود دارد که با توجه به شرایط خود
                                    می‌توانید با استفاده از یکی از آن‌ها اقامت کاری کانادا را اخذ کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col visa-item">
                        <div class="choose-visa-box">
                            <div class="visa-box-title">
                                <h2>ویزای تحصیلی</h2>
                            </div>
                            <div class="visa-box-icon">
                                <i class="pars-education"></i>
                            </div>
                            <div class="visa-box-text">
                                <p>برنامه‌های مختلفی برای مهاجرت کاری به کانادا وجود دارد که با توجه به شرایط خود
                                    می‌توانید با استفاده از یکی از آن‌ها اقامت کاری کانادا را اخذ کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col visa-item">
                        <div class="choose-visa-box">
                            <div class="visa-box-title">
                                <h2>ویزای استانی</h2>
                            </div>
                            <div class="visa-box-icon">
                                <i class="pars-federal-skill"></i>
                            </div>
                            <div class="visa-box-text">
                                <p>برنامه‌های مختلفی برای مهاجرت کاری به کانادا وجود دارد که با توجه به شرایط خود
                                    می‌توانید با استفاده از یکی از آن‌ها اقامت کاری کانادا را اخذ کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- free-assessment -->
    <section class="free-assessment">
        <div class="container">
            <div class="row">
                <div class="first-row">
                    <span>ارزیابی رایگان شرایط مهاجرت</span>
                    <span>(تضمین ۱۰۰٪ موفقیت)</span>
                </div>
                <div class="second-row">
                    <span>پارسی کانادا همراه شماست تا مسیر مهاجرت را سریع و راحت طی کنید!</span>
                    <a href="#">شروع کنید!</a>
                </div>
            </div>
        </div>
    </section>
    <!-- recommmend -->
    <section class="recommmend">
        <div class="container">
            <div>
                <p class="home-section-title">پیشنهاد ویژه مهاجرتی </p>
                <div class="arrow-scroll">
                    <span class="material-icons">expand_more</span>
                    <span class="material-icons">expand_more</span>
                </div>
            </div>
            <div class="row row-cols-md-3 row-cols-1">
                <div class="col recommend-box-wrapper ">
                    <div class="recommend-box">
                        <div class="recommend-box-icon">
                            <img src="{{ asset('/landing/images/adv.svg') }}" alt="advertise">
                        </div>
                        <div class="recommend-box-title">
                            <h2>خرید بیزنس در کانادا</h2>
                            <span class="material-icons">expand_more</span>

                        </div>
                        <div class="recommend-box-text">
                            <p>ﺗﺼﻮر ﮐﻨﯿﺪ ﺑﺎ ﺧﺮﯾﺪ ﺑﯿﺰﯾﻨﺲ ﻓﻌﺎل در
                                ﮐﺎﻧﺎدا، در ﮐﻤﺘﺮ از یک ﺳﺎل ﺑﻪ اﻗﺎﻣﺖ داﺋﻢ
                                اﯾﻦ ﮐﺸﻮر دﺳﺖ پیدا می کنید. ﺑﻪ ﻧﻈﺮ
                                شما این یک شرایط ایده آل مهاجرتی نیست
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col recommend-box-wrapper ">
                    <div class="recommend-box">
                        <div class="recommend-box-icon">
                            <img src="{{ asset('/landing/images/adv.svg') }}" alt="advertise">

                        </div>
                        <div class="recommend-box-title">
                            <h2>خرید بیزنس در کانادا</h2>
                            <span class="material-icons">expand_more</span>

                        </div>
                        <div class="recommend-box-text">
                            <p>ﺗﺼﻮر ﮐﻨﯿﺪ ﺑﺎ ﺧﺮﯾﺪ ﺑﯿﺰﯾﻨﺲ ﻓﻌﺎل در
                                ﮐﺎﻧﺎدا، در ﮐﻤﺘﺮ از یک ﺳﺎل ﺑﻪ اﻗﺎﻣﺖ داﺋﻢ
                                اﯾﻦ ﮐﺸﻮر دﺳﺖ پیدا می کنید. ﺑﻪ ﻧﻈﺮ
                                شما این یک شرایط ایده آل مهاجرتی نیست
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col recommend-box-wrapper ">
                    <div class="recommend-box">
                        <div class="recommend-box-icon">
                            <img src="{{ asset('/landing/images/adv.svg') }}" alt="advertise">

                        </div>
                        <div class="recommend-box-title">
                            <h2>خرید بیزنس در کانادا</h2>
                            <span class="material-icons">expand_more</span>

                        </div>
                        <div class="recommend-box-text">
                            <p>ﺗﺼﻮر ﮐﻨﯿﺪ ﺑﺎ ﺧﺮﯾﺪ ﺑﯿﺰﯾﻨﺲ ﻓﻌﺎل در
                                ﮐﺎﻧﺎدا، در ﮐﻤﺘﺮ از یک ﺳﺎل ﺑﻪ اﻗﺎﻣﺖ داﺋﻢ
                                اﯾﻦ ﮐﺸﻮر دﺳﺖ پیدا می کنید. ﺑﻪ ﻧﻈﺮ
                                شما این یک شرایط ایده آل مهاجرتی نیست
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 recommend-box-wrapper">
                    <div class="recommend-box full-remcommend-box">
                        <div class="row row-cols-md-2 row-cols-1 full-remcommend-inner align-items-end">
                            <div class="col-md-9">
                                <p class="fw-bold full-width-title">اگر نمی دانید...!</p>
                                <p class="full-width-text mb-0">چه کشوری برای شما مناسب است مشاوران ما در به شما کمک می
                                    کنند</p>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="button-primary">مشاوره رایگان</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="link-view-more">
                <a href="#" class="outlined-btn"><span class="material-icons"> visibility</span> پیشنهادهای
                    بیشتر</a>
            </div>
        </div>
    </section>
    <!-- padkast -->
    <section class="podcast">
        <div class="container">
            <p class="home-section-title">جدیدترین پادکست های مهاجرتی</p>
            <div class="arrow-scroll">
                <span class="material-icons">expand_more</span>
                <span class="material-icons">expand_more</span>
            </div>
            <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 mt-5">
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>
                <div class="col podcast-item-wrapper">
                    <div class="podcast-item">
                        <div class="podcast-item-img">
                            <figure><img src="{{ asset('/landing/images/podcast.jpg') }}" alt="podcast"></figure>
                        </div>
                        <div class="podcast-item-content">
                            <h4 class="pc-title">مهاجرت به کانادا</h4>
                            <div class="pc-footer">
                                <div class="pc-view">
                                    <i class="material-icons">visibility</i>
                                    <span>4000</span>
                                </div>
                                <div class="pc-time">
                                    <i class="material-icons">timer</i>
                                    <span>200 دقیقه</span>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-item-btn">
                            <button><i class="material-icons">play_arrow</i></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="link-view-more">
                <a href="#" class="outlined-btn"><span class="material-icons"> visibility</span> پادکست های بیشتر
                </a>
            </div>
        </div>
    </section>
    <!-- certificates -->
    <section class="certificates">
        <p class="home-section-title">مجوزات و افتخارات</p>
        <div class="arrow-scroll mb-4">
            <span class="material-icons">expand_more</span>
            <span class="material-icons">expand_more</span>
        </div>
        <div class="splide certificate-carousel">
            <div class="splide__track">
                <div class="splide__list">
                    <article class="certificate-item splide__slide ">
                        <div class="certificate-item-inner">
                            <figure>
                                <a href="images/03.jpg" data-fslightbox><img src="{{ asset('/landing/images/03.jpg') }}" alt="cerrtificate"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="certificate-item splide__slide ">
                        <div class="certificate-item-inner">
                            <figure>
                                <a href="images/02.jpg" data-fslightbox="gallery" ><img src="{{ asset('/landing/images/02.jpg') }}" alt="cerrtificate"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="certificate-item splide__slide ">
                        <div class="certificate-item-inner">
                            <figure>
                                <a href="images/03.jpg" data-fslightbox="gallery" ><img src="{{ asset('/landing/images/03.jpg') }}" alt="cerrtificate"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="certificate-item splide__slide ">
                        <div class="certificate-item-inner">
                            <figure>
                                <a href="images/02.jpg" data-fslightbox="gallery"><img src="{{ asset('/landing/images/04.jpg') }}" alt="cerrtificate"></a>
                            </figure>
                        </div>
                    </article>
                    <article class="certificate-item splide__slide ">
                        <div class="certificate-item-inner">
                            <figure>
                                <a href="images/02.jpg" data-fslightbox="gallery" > <img src="{{ asset('/landing/images/03.jpg') }}" alt="cerrtificate"></a>
                            </figure>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- successful project -->
    <section class="successful-project">
        <div class="container">
            <div class="row row-cols-md-2 row-cols-1 align-items-center">
                <div
                    class="successful-details  col bg-white d-flex align-items-center flex-wrap align-items-center justify-content-center">
                    <div class="successful-title">
                        <p>پرونده های موفق پارسی کانادا</p>
                    </div>
                    <div class="progress-successsful row row-cols-4" id="progress_circle">
                        @if(count($cases))
                            @foreach($cases as $item)
                                <div class="col progress-item progress-secondary">
                                    <div class="circle-wrap">
                                        <div class="circle">
                                            <div class="mask full">
                                                <div class="fill"></div>
                                            </div>
                                            <div class="mask half">
                                                <div class="fill"></div>
                                            </div>
                                            <div class="inside-circle"> {{ $item['percent'] }}% </div>
                                        </div>
                                    </div>
                                    <div class="progress-item-footer">
                                        <span>{{ $item['title'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="video-successful col " data-bs-toggle="modal" href="#sucess_video_modal" role="button">
                    <button ><i class="material-icons">play_arrow</i></button>
                </div>
            </div>
        </div>
        <!-- modal successfull -->
        <div class="modal fade" id="sucess_video_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <video  id="video-47-1" width="100%" height="auto" controls="controls"  preload="none"><source type="video/mp4" src="{{ asset('/landing/images/0.ogv') }}"></video>
                </div>
            </div>
        </div>
    </section>
    <!-- latest-news -->
    <section class="latest-news">
        <div class="container">
            <p class="home-section-title">جدیدترین اخبار مهاجرتی</p>
            <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1">
                <div class="latest-item-wrapper">
                    <div class="latest-news-item">
                        <div class="latest-news-img">
                            <figure><a href="#"><img src="{{ asset('/landing/images/news01.jpg') }}" alt="latest-news"></a></figure>
                        </div>
                        <div class="latest-news-content">
                            <div class="latest-news-time">
                                <span>22 خرداد</span>
                                <br />
                                <span>1400</span>
                            </div>
                            <div class="latest-news-meta">
                                <div class="meta-item col">
                                    <i class="material-icons">person</i>
                                    <a href="#"><a href="#"><span>فرشاد کریمی </span></a></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">style</i>
                                    <a href="#"><span>ویزای کانادا</span></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">feedback</i>
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="latest-news-title">
                                <h4><a href="#">کانادا 90 هزار شغل را در ماه آگوست، بازگشایی میکند......</a></h4>
                            </div>
                            <div class="latest-news-excerpt">
                                <p>توریست هایی ک به طور کامل واکسینه شده اند می توانند توریست هایی ک به طور کامل واکسینه
                                    شده اند می توانند ....</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest-item-wrapper">
                    <div class="latest-news-item">
                        <div class="latest-news-img">
                            <figure><a href="#"><img src="{{ asset('/landing/images/news02.jpg') }}" alt="latest-news"></a></figure>
                        </div>
                        <div class="latest-news-content">
                            <div class="latest-news-time">
                                <span>22 خرداد</span>
                                <br />
                                <span>1400</span>
                            </div>
                            <div class="latest-news-meta">
                                <div class="meta-item col">
                                    <i class="material-icons">person</i>
                                    <a href="#"><a href="#"><span>فرشاد کریمی </span></a></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">style</i>
                                    <a href="#"><span>ویزای کانادا</span></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">feedback</i>
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="latest-news-title">
                                <h4><a href="#">کانادا 90 هزار شغل را در ماه آگوست، بازگشایی میکند......</a></h4>
                            </div>
                            <div class="latest-news-excerpt">
                                <p>توریست هایی ک به طور کامل واکسینه شده اند می توانند توریست هایی ک به طور کامل واکسینه
                                    شده اند می توانند ....</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest-item-wrapper">
                    <div class="latest-news-item">
                        <div class="latest-news-img">
                            <figure><a href="#"><img src="{{ asset('/landing/images/news03.jpg') }}" alt="latest-news"></a></figure>
                        </div>
                        <div class="latest-news-content">
                            <div class="latest-news-time">
                                <span>22 خرداد</span>
                                <br />
                                <span>1400</span>
                            </div>
                            <div class="latest-news-meta">
                                <div class="meta-item col">
                                    <i class="material-icons">person</i>
                                    <a href="#"><a href="#"><span>فرشاد کریمی </span></a></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">style</i>
                                    <a href="#"><span>ویزای کانادا</span></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">feedback</i>
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="latest-news-title">
                                <h4><a href="#">کانادا 90 هزار شغل را در ماه آگوست، بازگشایی میکند......</a></h4>
                            </div>
                            <div class="latest-news-excerpt">
                                <p>توریست هایی ک به طور کامل واکسینه شده اند می توانند توریست هایی ک به طور کامل واکسینه
                                    شده اند می توانند ....</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest-item-wrapper">
                    <div class="latest-news-item">
                        <div class="latest-news-img">
                            <figure><a href="#"><img src="{{ asset('/landing/images/news04.jpg') }}" alt="latest-news"></a></figure>
                        </div>
                        <div class="latest-news-content">
                            <div class="latest-news-time">
                                <span>22 خرداد</span>
                                <br />
                                <span>1400</span>
                            </div>
                            <div class="latest-news-meta">
                                <div class="meta-item col">
                                    <i class="material-icons">person</i>
                                    <a href="#"><a href="#"><span>فرشاد کریمی </span></a></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">style</i>
                                    <a href="#"><span>ویزای کانادا</span></a>
                                </div>
                                <div class="meta-item col">
                                    <i class="material-icons">feedback</i>
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="latest-news-title">
                                <h4><a href="#">کانادا 90 هزار شغل را در ماه آگوست، بازگشایی میکند......</a></h4>
                            </div>
                            <div class="latest-news-excerpt">
                                <p>توریست هایی ک به طور کامل واکسینه شده اند می توانند توریست هایی ک به طور کامل واکسینه
                                    شده اند می توانند ....</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="link-view-more d-table d-sm-none">

                <a href="#" class="outlined-btn"><span class="material-icons"> visibility</span> مشاهده اخبار
                    بیشتر</a>
            </div>
        </div>
    </section>
@endsection
