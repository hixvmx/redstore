@extends('layout.master')

@section('metatags')
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/account/layout.css') }}" />
    @yield('pg_metatags')
@endsection

@section('content')
    <main class="main maxWidth">

        @yield('pg_source')

        <div class="settings__container">
            <div class="settings__aside">
                <div class="settings__aside__row">
                    <div class="aside__head">
                        <span>الإعدادات</span>
                    </div>
                    <div class="settings__aside__links">
                            <a href="/account/ads">
                                <div class="{{ (request()->is('account/ads')) ? 'aside__link active__link' : 'aside__link' }}">
                                    <span>إعلاناتي</span>
                                </div>
                            </a>
                            <a href="/account/favorites">
                                <div class="{{ (request()->is('account/favorites')) ? 'aside__link active__link' : 'aside__link' }}">
                                    <span>المفضلة</span>
                                </div>
                            </a>
                            <a href="/account/settings">
                                <div class="{{ (request()->is('account/settings')) ? 'aside__link active__link' : 'aside__link' }}">
                                    <span>إعدادات الحساب</span>
                                </div>
                            </a>
                            <a href="/account/contact-informations">
                                <div class="{{ (request()->is('account/contact-informations')) ? 'aside__link active__link' : 'aside__link' }}">
                                    <span>معلومات الإتصال</span>
                                </div>
                            </a>
                            <a href="/account/change-password">
                                <div class="{{ (request()->is('account/change-password')) ? 'aside__link active__link' : 'aside__link' }}">
                                    <span>تغيير كلمة السر</span>
                                </div>
                            </a>
                    </div>
                </div>
            </div>
            <div class="settings__body">
                @yield('pg_content')
            </div>
        </div>
    </main>
@endsection