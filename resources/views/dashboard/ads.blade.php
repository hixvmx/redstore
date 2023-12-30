@extends('layout.dashboard')
@section('metatags')
    <title>Ads - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/ads.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('content')
    <div class="db__sec maxWidth">
        <div class="db__header">
            <h2>الإعلانات ({{$ads->count()}})</h2>
        </div>
        <div class="db__body">

            <table id="ads">
                <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>التصنيف الرئيسي</th>
                        <th>التصنيف الفرعي</th>
                        <th>الدولة</th>
                        <th>المدينة</th>
                        <th>الناشر</th>
                        <th>تاريخ النشر</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ads->count() > 0)
                        @foreach ($ads as $ad)
                            <tr id="{{ "ad__".$ad->id }}">
                                <td>
                                    <div class="ad__title" onclick="window.open('/ad/{{$ad->slug}}', '_blank')">
                                        <p>{{$ad->title}}</p>
                                    </div>
                                </td>
                                <td>{{$ad->category ? $ad->category->name : '#'}}</td>
                                <td>{{$ad->sub_category ? $ad->sub_category->name : '#'}}</td>
                                <td>{{$ad->country ? $ad->country->name : '#'}}</td>
                                <td>{{$ad->city ? $ad->city->name : '#'}}</td>
                                <td>
                                    @if ($ad->publisher)
                                        <div class="user__data" onclick="window.open('/user/{{$ad->publisher->username}}', '_blank')">
                                            <div class="user__avatar">
                                                <img src="{{$ad->publisher->avatar}}" alt="{{$ad->publisher->firstname .' '. $ad->publisher->lastname}}" />
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>{{$ad->created_at['date']}}</td>
                                <td align="left">
                                    <button class="deleteBtn" onclick="deleteAd({{ $ad->id }})">
                                        <svg viewBox="0 0 473 473"><g><path d="M324.285,215.015V128h20V38h-98.384V0H132.669v38H34.285v90h20v305h161.523c23.578,24.635,56.766,40,93.477,40c71.368,0,129.43-58.062,129.43-129.43C438.715,277.276,388.612,222.474,324.285,215.015z M294.285,215.015c-18.052,2.093-34.982,7.911-50,16.669V128h50V215.015z M162.669,30h53.232v8h-53.232V30z M64.285,68h250v30h-250V68z M84.285,128h50v275h-50V128z M164.285,403V128h50v127.768c-21.356,23.089-34.429,53.946-34.429,87.802c0,21.411,5.231,41.622,14.475,59.43H164.285z M309.285,443c-54.826,0-99.429-44.604-99.429-99.43s44.604-99.429,99.429-99.429s99.43,44.604,99.43,99.429S364.111,443,309.285,443z"></path><polygon points="342.248,289.395 309.285,322.358 276.323,289.395 255.11,310.608 288.073,343.571 255.11,376.533 276.323,397.746 309.285,364.783 342.248,397.746 363.461,376.533 330.498,343.571 363.461,310.608"></polygon></g></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="pagination">
            <ul>
                <li><a href="{{$ads->nextPageUrl()}}"><div>التالي</div></a></li>
                <li><a href="{{$ads->previousPageUrl()}}"><div>السابق</div></a></li>
            </ul>
            <span>الصفحة رقم {{$ads->currentPage()}} من أصل {{$ads->lastPage()}}</span>
        </div>

        <script>
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            async function sendRequest(id) {
                try {
                    const response = await axios.delete('/dashboard/deleteAd/'+id, {
                        headers : {
                            "X-CSRF-TOKEN": csrfToken
                        }
                    })
    
                    const data = await response.data;
    
                    if (data.status == 1) {
                        document.getElementById("ad__"+id).style.display = "none";
                        swal("", "تم حذف الإعلان بنجاح.", "success");
                    }
    
                } catch (error) {
                    //
                }
            }
    
            
            function deleteAd(id) {
                if (id) {
                    sendRequest(id);
                }
            }
        </script>
    </div>
@endsection
