<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Ad;

    $authUser = Auth::user();
    if ($authUser) {
        $adsCount = Ad::where('publisher', $authUser->id)->count();
    }

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon" />
    @yield('metatags')
</head>
<body>
    <main class="dashboard__main">
        <div class="">
        <aside class="dashboard__aside">
            <div class="aside__logo">
                <img src="/image/logo.png" alt="website logo" />
                <a href="/" target="_blank">
                    <button class="visitWebsiteBtn">
                        <svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M21 9.00001L21 3.00001M21 3.00001H15M21 3.00001L12 12M10 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                    </button>
                </a>
            </div>
            <div class="aside__links">
                <a href="/dashboard">
                    <div class="aside__link {{ (request()->is('dashboard')) ? 'active' : '' }}">
                        <div class="link__icon">
                            <svg viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" clip-rule="evenodd" d="M3 2C2.44772 2 2 2.44772 2 3V10C2 10.5523 2.44772 11 3 11H10C10.5523 11 11 10.5523 11 10V3C11 2.44772 10.5523 2 10 2H3ZM4 9V4H9V9H4Z"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M14 2C13.4477 2 13 2.44772 13 3V10C13 10.5523 13.4477 11 14 11H21C21.5523 11 22 10.5523 22 10V3C22 2.44772 21.5523 2 21 2H14ZM15 9V4H20V9H15Z"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M13 14C13 13.4477 13.4477 13 14 13H21C21.5523 13 22 13.4477 22 14V21C22 21.5523 21.5523 22 21 22H14C13.4477 22 13 21.5523 13 21V14ZM15 15V20H20V15H15Z"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M3 13C2.44772 13 2 13.4477 2 14V21C2 21.5523 2.44772 22 3 22H10C10.5523 22 11 21.5523 11 21V14C11 13.4477 10.5523 13 10 13H3ZM4 20V15H9V20H4Z"></path> </g></svg>
                        </div>
                        <span class="link__title">
                            الصفحة الرئيسية
                        </span>
                    </div>
                </a>
                <a href="/dashboard/ads">
                    <div class="aside__link {{ (request()->is('dashboard/ads')) ? 'active' : '' }}">
                        <div class="link__icon">
                            <svg viewBox="0 0 20 20" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" d="M19 4a1 1 0 01-1 1H7a1 1 0 010-2h11a1 1 0 011 1zM4 4a1 1 0 01-1 1H2a1 1 0 010-2h1a1 1 0 011 1zm15 6a1 1 0 01-1 1H7a1 1 0 110-2h11a1 1 0 011 1zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm14 7a1 1 0 100-2H7a1 1 0 100 2h11zM3 17a1 1 0 100-2H2a1 1 0 100 2h1z"></path> </g></svg>
                        </div>
                        <span class="link__title">
                            الإعلانات
                        </span>
                    </div>
                </a>
                <a href="/dashboard/accounts">
                    <div class="aside__link {{ (request()->is('dashboard/accounts')) ? 'active' : '' }}">
                        <div class="link__icon">
                            <svg viewBox="0 0 32 32"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M16 21.416c-5.035 0.022-9.243 3.537-10.326 8.247l-0.014 0.072c-0.018 0.080-0.029 0.172-0.029 0.266 0 0.69 0.56 1.25 1.25 1.25 0.596 0 1.095-0.418 1.22-0.976l0.002-0.008c0.825-3.658 4.047-6.35 7.897-6.35s7.073 2.692 7.887 6.297l0.010 0.054c0.127 0.566 0.625 0.982 1.221 0.982 0.69 0 1.25-0.559 1.25-1.25 0-0.095-0.011-0.187-0.031-0.276l0.002 0.008c-1.098-4.78-5.305-8.295-10.337-8.316h-0.002zM9.164 11.102c0 0 0 0 0 0 2.858 0 5.176-2.317 5.176-5.176s-2.317-5.176-5.176-5.176c-2.858 0-5.176 2.317-5.176 5.176v0c0.004 2.857 2.319 5.172 5.175 5.176h0zM9.164 3.25c0 0 0 0 0 0 1.478 0 2.676 1.198 2.676 2.676s-1.198 2.676-2.676 2.676c-1.478 0-2.676-1.198-2.676-2.676v0c0.002-1.477 1.199-2.674 2.676-2.676h0zM22.926 11.102c2.858 0 5.176-2.317 5.176-5.176s-2.317-5.176-5.176-5.176c-2.858 0-5.176 2.317-5.176 5.176v0c0.004 2.857 2.319 5.172 5.175 5.176h0zM22.926 3.25c1.478 0 2.676 1.198 2.676 2.676s-1.198 2.676-2.676 2.676c-1.478 0-2.676-1.198-2.676-2.676v0c0.002-1.477 1.199-2.674 2.676-2.676h0zM31.311 19.734c-0.864-4.111-4.46-7.154-8.767-7.154-0.395 0-0.784 0.026-1.165 0.075l0.045-0.005c-0.93-2.116-3.007-3.568-5.424-3.568-2.414 0-4.49 1.448-5.407 3.524l-0.015 0.038c-0.266-0.034-0.58-0.057-0.898-0.063l-0.009-0c-4.33 0.019-7.948 3.041-8.881 7.090l-0.012 0.062c-0.018 0.080-0.029 0.173-0.029 0.268 0 0.691 0.56 1.251 1.251 1.251 0.596 0 1.094-0.417 1.22-0.975l0.002-0.008c0.684-2.981 3.309-5.174 6.448-5.186h0.001c0.144 0 0.282 0.020 0.423 0.029 0.056 3.218 2.679 5.805 5.905 5.805 3.224 0 5.845-2.584 5.905-5.794l0-0.006c0.171-0.013 0.339-0.035 0.514-0.035 3.14 0.012 5.765 2.204 6.442 5.14l0.009 0.045c0.126 0.567 0.625 0.984 1.221 0.984 0.69 0 1.249-0.559 1.249-1.249 0-0.094-0.010-0.186-0.030-0.274l0.002 0.008zM16 18.416c-0 0-0 0-0.001 0-1.887 0-3.417-1.53-3.417-3.417s1.53-3.417 3.417-3.417c1.887 0 3.417 1.53 3.417 3.417 0 0 0 0 0 0.001v-0c-0.003 1.886-1.53 3.413-3.416 3.416h-0z"></path> </g></svg>
                        </div>
                        <span class="link__title">
                            الحسابات
                        </span>
                    </div>
                </a>
                <a href="/">
                    <div class="aside__link">
                        <div class="link__icon">
                            <svg viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" d="M1 10c0-3.9 3.1-7 7-7s7 3.1 7 7h-1c0-3.3-2.7-6-6-6s-6 2.7-6 6H1zm4 0c0-1.7 1.3-3 3-3s3 1.3 3 3-1.3 3-3 3-3-1.3-3-3zm1 0c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2z"></path></svg>
                        </div>
                        <span class="link__title">
                            معاينة الموقع
                        </span>
                    </div>
                </a>
            </div>
        </aside>
    </div>
        <section class="dashboard__section">
            <header class="dashboard__header">
                <div class="">
                    <button class="showOrHideAsideBarBtn" onclick="showOrHideAsideBar()">
                        <svg viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <rect x="3" y="17" width="18" height="2" rx="1" ry="1"></rect> <rect x="3" y="11" width="18" height="2" rx="1" ry="1"></rect> <rect x="3" y="5" width="18" height="2" rx="1" ry="1"></rect> </g></svg>
                    </button>
                </div>

                <div class="header__user__dropdown">
                    <div class="img__icon">
                        <img src="{{ url($authUser->avatar ?? '') }}" alt="{{ $authUser->username }}" />
                    </div>
                    <div class="user__dropdown">
                        <div class="dropdown_body">
                            <div class="dropdown__user__card">
                                <a href={{'/user' .'/'. $authUser->username}}>
                                    <div class="dropdown__user__card__body">
                                        <div>
                                            <div class="user__card__img">
                                                <img src="{{$authUser->avatar}}" alt="{{ $authUser->username }}" />
                                            </div>
                                        </div>
                                        <div class="user__card__name">
                                            <span>{{ $authUser->firstname .' '. $authUser->lastname }}</span>
                                            <i>{{$adsCount ?? ''}} إعلان</i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a class="a" href={{'/user' .'/'. $authUser->username}}>
                                <div>
                                    <span>حسابي</span>
                                </div>
                            </a>
                            <a class="a" href="/account/ads">
                                <div>
                                    <span>إعلاناتي</span>
                                </div>
                            </a>
                            <a class="a" href="/account/favorites">
                                <div>
                                    <span>المفضلة</span>
                                </div>
                            </a>
                            <a class="a" href="/account/settings">
                                <div>
                                    <span>إعدادات الحساب</span>
                                </div>
                            </a>
                            <a class="a" href="/logout">
                                <div>
                                    <span>تسجيل الخروح</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            
            <div class="dashboard__countainer">
                @yield('content')
            </div>
        </section>

        <div class="bg" onclick="showOrHideAsideBar()"></div>
    </main>

    <script>
        function showOrHideAsideBar() {
            var dashboardMain = document.querySelector(".dashboard__main");
            var className = 'showAsideBar';
            dashboardMain.classList.toggle(className);
        }
    </script>
</body>
</html>
