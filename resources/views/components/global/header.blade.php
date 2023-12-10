<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Ad;

    $authCheck = Auth::check();
    $authUser = Auth::user();
    if ($authUser) {
        $adsCount = Ad::where('publisher', $authUser->id)->count();
    }

?>
<header>
    <div class="header wd__80 flex aic__jcs ">
        <ul class="header__ul flex aic">
            @if ($authCheck)
                <li class="header__li">
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
                                @if ($authUser->isAdmin == 1)
                                <a class="a" href='/dashboard'>
                                    <div>
                                        <span>لوحة التحكم</span>
                                    </div>
                                </a>
                                @endif
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
                </li>
            @else
                <li class="header__li">
                    <div class="header__user__dropdown">
                        <div class="img__icon" style="background: transparent;">
                            <svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <circle cx="12" cy="9" r="3" stroke="#898989" stroke-width="1.5"></circle> <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#898989" stroke-width="1.5" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#898989" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        </div>
                        <div class="user__dropdown">
                            <div class="dropdown_body">
                                <a class="a" href="/login">
                                    <div>
                                        <span>تسجيل الدخول</span>
                                    </div>
                                </a>
                                <a class="a" href="/register">
                                    <div>
                                        <span>إنشاء حساب</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
            <li class="header__li">
                <div class="header__publish__btn">
                    <a href="/new-ad">
                        <div>
                            <span class="btn_txt_web">انشر إعلانك</span>
                            <span class="btn_txt_mob">نشر</span>
                        </div>
                    </a>
                </div>
            </li>
            <li class="header__li">
                <div class="header__categories__btn">
                    <a href="/categories">
                        <div>
                            <span>التصنيفات</span>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <div class="header__logo">
            <a href="/">
                <img src="/image/logo.png" alt="" />
            </a>
        </div>
    </div>
</header>
