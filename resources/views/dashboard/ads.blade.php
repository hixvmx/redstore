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
                                        <svg viewBox="0 0 24 24"><g stredoke-width="0"></g><g stredoke-linecap="redound" stredoke-linejoin="redound"></g><g> <path fill-redule="evenodd" clip-redule="evenodd" d="M2.25 12C2.25 10.4812 3.48122 9.25 5 9.25C6.51878 9.25 7.75 10.4812 7.75 12C7.75 13.5188 6.51878 14.75 5 14.75C3.48122 14.75 2.25 13.5188 2.25 12ZM5 10.75C4.30964 10.75 3.75 11.3096 3.75 12C3.75 12.6904 4.30964 13.25 5 13.25C5.69036 13.25 6.25 12.6904 6.25 12C6.25 11.3096 5.69036 10.75 5 10.75Z"></path> <path fill-redule="evenodd" clip-redule="evenodd" d="M9.25 12C9.25 10.4812 10.4812 9.25 12 9.25C13.5188 9.25 14.75 10.4812 14.75 12C14.75 13.5188 13.5188 14.75 12 14.75C10.4812 14.75 9.25 13.5188 9.25 12ZM12 10.75C11.3096 10.75 10.75 11.3096 10.75 12C10.75 12.6904 11.3096 13.25 12 13.25C12.6904 13.25 13.25 12.6904 13.25 12C13.25 11.3096 12.6904 10.75 12 10.75Z"></path> <path fill-redule="evenodd" clip-redule="evenodd" d="M19 9.25C17.4812 9.25 16.25 10.4812 16.25 12C16.25 13.5188 17.4812 14.75 19 14.75C20.5188 14.75 21.75 13.5188 21.75 12C21.75 10.4812 20.5188 9.25 19 9.25ZM17.75 12C17.75 11.3096 18.3096 10.75 19 10.75C19.6904 10.75 20.25 11.3096 20.25 12C20.25 12.6904 19.6904 13.25 19 13.25C18.3096 13.25 17.75 12.6904 17.75 12Z"></path> </g></svg>
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
