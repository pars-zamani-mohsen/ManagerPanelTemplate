@php $login_user = \Illuminate\Support\Facades\Auth::user() @endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ url('/' . App\Http\Controllers\HomeController::fetch_manager_pre_url()) }}"><img src="{{ asset('/images/logo.png') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="ms-3 name">
            <h6 class="text-muted text-center">
                <span>
                    {{ $login_user->name }} ({{ \App\Role::getRoleLable($login_user->role_id) }})
                </span>
                <span class="text-muted mb-0">{{ $login_user->mobile }}</span>
            </h6>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">فهرست</li>

                @php $url = '/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/dashboard'; @endphp
                <li class="sidebar-item" data-url="{{ $url }}">
                    <a href="{{ url($url) }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>داشبورد</span>
                    </a>
                </li>


                @php
                    $menu = array(/*
                        array('model' => '\App\Order', 'icon' => 'bi-clipboard-check', 'label' => ' لیست کل پرداخت های موفق و ناموفق'),
                        array('model' => '\App\Advicer', 'icon' => 'bi-person', 'label' => 'لیست مشاوران'),
                        array('model' => '\App\ReservingRoom', 'icon' => 'bi-sticky', 'label' => 'تعریف ساعت های رزرو اتاق'),
                        array('model' => '\App\Room', 'icon' => 'bi-building', 'label' => 'تعریف لیست اتاق ها'),
                        array('model' => '\App\City', 'icon' => 'bi-geo-alt', 'label' => 'تعریف لیست شهر ها'),
                    */);
                @endphp
                @foreach($menu as $item)
                    @php $moduleModel = $item['model']; $url = '/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/' . $moduleModel::$modulename['en']; @endphp
                    @if(($login_user->isAbleTo(['show-' . $moduleModel::$modulename['model']])) || $login_user->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole()))
                        <li class="sidebar-item" data-url="{{ $url }}">
                            <a href="{{ url($url) }}" class='sidebar-link'>
                                <i class="bi {{ $item['icon'] }}"></i>
                                <span>{{ (isset($item['label']) && $item['label']) ? $item['label'] : $moduleModel::$modulename['fa'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach

                @php
                    $submenu = array(
                        array('model' => '\App\User', 'icon' => 'bi-people'),
                        array('model' => '\App\Role', 'icon' => 'bi-person-square'),
                        array('model' => '\App\Permission', 'icon' => 'bi-shield-exclamation'),
                        array('model' => '\App\PermissionToRole', 'icon' => 'bi-key'),
                    );

                    $permission = false;
                    if ($login_user->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole())) {
                        $permission = true;
                    } else {
                        foreach ($submenu as $item) {
                            if (($login_user->isAbleTo(['show-' . $item['model']::$modulename['model']]))) {
                                $permission = true;
                            }
                        }
                    }
                @endphp
                @if($permission)
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>کاربران و دسترسی ها</span>
                        </a>
                        <ul class="submenu">
                            @foreach ($submenu as $item)
                                @php  $moduleModel = $item['model'];  $url = '/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/' . $moduleModel::$modulename['en']; @endphp
                                @if(($login_user->isAbleTo(['show-' . $moduleModel::$modulename['model']])) || $login_user->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole()))
                                    <li class="submenu-item" data-url="{{ $url }}">
                                        <a href="{{ url($url) }}">
                                            <i class="bi {{ $item['icon'] }}"></i>
                                            <span>{{ $moduleModel::$modulename['fa'] }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif

                @php
                    $submenu = array(
                        array('model' => '\App\Recyclebin', 'icon' => 'bi-trash'),
                        array('model' => '\App\ActivityLog', 'icon' => 'bi-clipboard'),
                    );

                    $permission = false;
                    if ($login_user->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole())) {
                        $permission = true;
                    } else {
                        foreach ($submenu as $item) {
                            if (($login_user->isAbleTo(['show-' . $item['model']::$modulename['model']]))) {
                                $permission = true;
                            }
                        }
                    }
                @endphp
                @if($permission)
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-gear"></i>
                            <span>تنظیمات</span>
                        </a>
                        <ul class="submenu">
                            @foreach ($submenu as $item)
                                @php  $moduleModel = $item['model'];  $url = '/'. App\Http\Controllers\HomeController::fetch_manager_pre_url() .'/' . $moduleModel::$modulename['en']; @endphp
                                @if(($login_user->isAbleTo(['show-' . $moduleModel::$modulename['model']])) || $login_user->hasRole(\App\Http\Controllers\DashboardController::getOwnerRole()))
                                    <li class="submenu-item" data-url="{{ $url }}">
                                        <a href="{{ url($url) }}">
                                            <i class="bi {{ $item['icon'] }}"></i>
                                            <span>{{ $moduleModel::$modulename['fa'] }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif

                @guest
                @else
                    <li class="sidebar-item">
                        <a id="_logout" class='sidebar-link' href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>خروج</span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
