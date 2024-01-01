@extends('layout.account')
@section('pg_metatags')
    <title>المفضلة - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/account/favorites.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    <div class="ad" id="{{ "ad__".$ad->id }}">
                        <div class="ad__row">
                            <a href="{{ url('ad/'.$ad->slug) }}" class="href">
                                <div class="ad__image" style="background-image: url({{$ad->image}})"></div>
                                <div class="ad__title">
                                    <h3 title="{{ $ad->title }}">{{ $ad->title }}</h3>
                                </div>
                            </a>
                            <div class="ad__price">
                                <b>{{ $ad->currency->name .' '. $ad->price }}</b>
                            </div>
                            <button onclick="removeFromMyFavorites({{ $ad->id }})" class="favorite__btn"><svg viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <g> <path d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg></button>
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

    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        async function sendRequest(id) {
            try {
                const response = await axios.post('/removeFromMyFavorites', {id}, {
                    headers : {
                        "X-CSRF-TOKEN": csrfToken
                    }
                })

                const data = await response.data;

                if (data.status == 1) {
                    document.getElementById("ad__"+id).style.display = "none";
                    swal("", "تمت إزالة الإعلان من المفضلة بنجاح.", "success");
                }

            } catch (error) {
                //
            }
        }

        
        function removeFromMyFavorites(id) {
            if (id) {
                sendRequest(id);
            }
        }
    </script>
@endsection
