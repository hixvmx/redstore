@extends('layout.account')
@section('pg_metatags')
    <title>ads - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/account/ads.css') }}" />
@endsection


@section('pg_source')
    <div class="main__header">
        <a href="/">الرئيسية</a>
        <span>-</span>
        <span>إعلاناتي</span>
    </div>
@endsection

@section('pg_content')
    <div class="ads">
        <div class="content__head">
            <span>إعلاناتي</span>
        </div>
        <div class="ads__row">
            <div class="ads__slide grid">
                @foreach ($ads as $ad)
                    <div class="ad">
                        <div class="ad__row">
                            <div class="href">
                                <div>
                                    <div class="ad__image__row">
                                        <a href="{{ url('ad/'.$ad->slug) }}">
                                            <div class="ad__image" style="background-image: url({{$ad->image}})"></div>
                                        </a>
                                        <a href="{{ url('edit-ad/'.$ad->slug) }}" target="_blank">
                                            <button class="editBtn" title="Edit / Delete">
                                                <svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="ad__body">
                                    <a href="{{ url('ad/'.$ad->slug) }}">
                                        <h3 class="ad__title" title="{{ $ad->title }}">{{ $ad->title }}</h3>
                                    </a>
                                    <ul class="ad__statics">
                                        <li>
                                            <div>
                                                <p>الدولة :</p>
                                                <a href="{{ url('country/' . $ad->country->slug) }}">{{ $ad->country->name }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <p>المدينة :</p>
                                                <a href="{{ url('city/' . $ad->city->slug) }}">{{ $ad->city->name }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <p>التصنيف الرئيسي : </p>
                                                <a href="{{ url('category/' . $ad->category->slug) }}">{{ $ad->category->name }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <p>التصنيف الفرعي : </p>
                                                <a href="{{ url('sub-category/' . $ad->sub_category->slug) }}">{{ $ad->sub_category->name }}</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
