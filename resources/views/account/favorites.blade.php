@extends('layout.account')
@section('pg_metatags')
    <title>favorites - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/account/favorites.css') }}" />
@endsection


@section('pg_source')
    <div class="main__header">
        <a href="/">الرئيسية</a>
        <span>-</span>
        <span>المفضلة</span>
    </div>
@endsection

@section('pg_content')
    <div class="favorites">
        <div class="content__head">
            <span>المفضلة</span>
        </div>
        <div class="favorites__row">
            <div class="ads__slide grid">
                
                @foreach ($ads as $ad)
                    <div class="ad">
                        <div class="ad__row">
                            <a href="{{ url('ad/'.$ad->slug) }}" class="href">
                                <div class="ad__image">
                                    <img src="{{ url($ad->image) }}" alt="{{ $ad->title }}" />
                                </div>
                                <div class="ad__title">
                                    <h3 title="{{ $ad->title }}">{{ $ad->title }}</h3>
                                </div>
                            </a>
                            <div class="ad__price">
                                <b>{{ $ad->currency->name .' '. $ad->price }}</b>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($ads->lastPage() > 1)
        <div class="pagination">
            <ul>
                <li><a href="{{$ads->previousPageUrl()}}"><div>السابق</div></a></li>
                <li><a href="{{$ads->nextPageUrl()}}"><div>التالي</div></a></li>
            </ul>
            <span>الصفحة رقم {{$ads->currentPage()}} من أصل {{$ads->lastPage()}}</span>
        </div>
    @endif
@endsection
