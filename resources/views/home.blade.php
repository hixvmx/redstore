@extends('layout.master')
@section('metatags')
    <title>redStore</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/home_content.css') }}" />
@endsection

@section('content')
    <section class="welcome">
        <div class="welcome__row flex wd__80">
            <h2 class="welcome__title">
                بيع و شراء كل ما تحتاجه وأنت متكي على الكنبة
            </h2>
            <div class="search">
                <div class="search__row">
                    <form action="/search" method="get">
                        <div class="search__form flex">
                            <button type="submit">بحث</button>
                            <input type="text" name="keywords" placeholder="ابحث في الموقع" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <main class="main wd__80">
                <section class="ads">
                    <div class="ads__row">
                        <div class="ads__title">
                            <h2>الأكثر مبيعاََ :</h2>
                        </div>
                        <div class="ads__slide grid">
                            @if (count($ads) > 0)
                                @foreach ($ads as $ad)
                                    <div class="ad">
                                        <div class="ad__row">
                                            <a href="/ad/{{ $ad->slug }}" class="href">
                                                <div class="ad__image">
                                                    <img src="{{ $ad->image }}" alt="{{ $ad->title }}" />
                                                </div>
                                                <div class="ad__title">
                                                    <h3 title="title">{{ $ad->title }}</h3>
                                                </div>
                                            </a>
                                            <div class="ad__price">
                                                <b>{{ $ad->price . ' ' . $ad->currency->name }}</b>
                                            </div>
                                            <div class="ad__footer flex aic__jcs">
                                                <div>
                                                    <span>{{ $ad->country->name }}</span>
                                                </div>
                                                <div>
                                                    <span>{{ $ad->created_at['date'] }}</span>
                                                </div>
                                            </div>
                                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none">
                                                    <g stroke-width="0"></g>
                                                    <g stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g>
                                                        <path
                                                            d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z"
                                                            stroke-width="2"></path>
                                                    </g>
                                                </svg></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
    </main>
@endsection
