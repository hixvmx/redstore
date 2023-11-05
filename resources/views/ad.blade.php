@extends('layout.master')
@section('metatags')
    <title>{{ $ad->title }} - RedBox</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ad.css') }}" />
@endsection

@section('content')
    <main class="main wd__80">
        <div class="main__header">
            <a href="/">الرئيسية</a>
            <span>-</span>
            <a href="/search?category={{ $ad->category->id }}">{{ $ad->category->name }}</a>
            <span>-</span>
            <a href="/search?category={{ $ad->category->id }}&subCategory={{ $ad->sub_category->id }}">{{ $ad->sub_category->name }}</a>
            <span>-</span>
            <a href="/ad/{{$ad->slug}}">{{$ad->title}}</a>
        </div>

        {{-- Preview Image --}}
        <div class="preview">
            <button class="closeBtn" onclick="hidePreviewImage()">
                <svg viewBox="0 0 1024 1024"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"></path></g></svg>
            </button>
            <div class="preview__bg">
                <div class="previrew__image">
                    <img id="previewImg" src="" />
                </div>
            </div>
        </div>

        <div class="ad">
            <div class="ad__row flex">
                <div class="ad__article">
                    <div class="ad__images">
                        <div class="images__row">
                            <div class="ad__info">
                                <div class="title__price flex aic__jcs">
                                    <h3>{{ $ad->title }}</h3>
                                    <b>{{ $ad->currency->name .' '. $ad->price }}</b>
                                </div>
                                <div class="ad__address__date">
                                    <p>بتاريخ :</p>
                                    <a>{{ explode(' ', $ad->created_at)[0] }}</a>
                                    <span>.</span>
                                    <p>الدولة :</p>
                                    <a href="/search?country={{ $ad->country->id }}" class="a">{{ $ad->country->name }}</a>
                                    <span>.</span>
                                    <p>المدينة :</p>
                                    <a href="/search?country={{ $ad->country->id }}&city={{ $ad->city->id }}" class="a">{{ $ad->city->name }}</a>
                                </div>
                            </div>
                            <div class="image__img">
                                <img src="{{ $ad->image }}" alt="{{ $ad->title }}" onclick="showPreviewImage('{{ $ad->image }}')" />
                            </div>
                            @if ($ad->images)
                                <div class="more__images flex">
                                    @foreach ($ad->images as $img)
                                        <img src="{{ $img }}" onclick="showPreviewImage('{{ $img }}')" />
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="ad__aside">
                    <div class="publisher">
                        <div class="publisher__row">

                            <div class="publisher__info flex jcs">
                                <div class="p__i__a flex">
                                    <a href="/user/{{ $ad->publisher->username }}">
                                        <img src="{{ $ad->publisher->avatar }}" alt="{{ $ad->publisher->firstname .' '. $ad->publisher->lastname }}" />
                                    </a>
                                    <div class="p__i__b flex">
                                        <a href="/user/{{ $ad->publisher->username }}">
                                            <h3>{{ $ad->publisher->firstname .' '. $ad->publisher->lastname }}</h3>
                                        </a>
                                        <span>{{ $ad->publisher->country->name }}</span>
                                    </div>
                                </div>
                                <a href="/user/{{ $ad->publisher->username }}" target="_blank">
                                    <button class="viewProfileBtn">
                                        <svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M21 9.00001L21 3.00001M21 3.00001H15M21 3.00001L12 12M10 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                    </button>
                                </a>
                            </div>

                            <div class="p_contact grid">
                                <a href="{{$ad->publisher->phone_number ? 'tel:+'.$ad->publisher->phone_number : '#'}}">
                                    <div>
                                        <button>إتصال</button>
                                        <p>{{ $ad->publisher->phone_number ?? null }}</p>
                                    </div>
                                </a>
                                <a href="mailto:{{$ad->publisher->email}}">
                                    <div>
                                        <button>إرسال</button>
                                        <p>{{ $ad->publisher->email }}</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    {{-- sharing options --}}
                    <?php
                        $adUrl = url()->current();
                        $facebook = 'https://www.facebook.com/sharer.php?u='.$adUrl;
                        $twitter  = 'https://twitter.com/intent/tweet?url='.$adUrl;
                        $linkedin = 'https://www.linkedin.com/feed/?shareActive=true&shareUrl='.$adUrl;
                        $telegrame = 'https://t.me/share/url?url='.$adUrl;
                        $whatsapp = 'https://api.whatsapp.com/send/?text='.$adUrl;
                    ?>
                    <div class="share__page">
                        <div class="share__page__head">
                            <span>شارك الإعلان</span>
                        </div>
                        <div class="share__page__row">
                            <div><button onclick="window.open('{{$facebook}}','_blank')" title="Share on Facebook"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21ZM12 21V13.0001M12 13.0001V10.0001C12 8.02404 13.3537 7.03622 15.5 7.18462M12 13.0001L15 13.0001M12 13.0001H9" stroke="#3741519e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button></div>
                            <div><button onclick="window.open('{{$twitter}}','_blank')" title="Share on Twitter"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" clip-rule="evenodd" d="M14.8486 5.65845C13.1442 5.65845 11.7626 7.0401 11.7626 8.74446C11.7626 8.95304 11.7831 9.15581 11.822 9.35119C11.8846 9.66589 11.7924 9.99153 11.5741 10.2267C11.3558 10.4619 11.0379 10.578 10.7194 10.5389C8.51116 10.268 6.50248 9.35556 4.88498 7.9954C4.91649 8.59732 5.12515 9.23671 5.57799 9.90654L6.25677 10.9106L5.14211 11.3863L4.92704 11.4781C5.0869 11.6609 5.2791 11.8487 5.49369 12.0332C5.73717 12.2425 5.97247 12.4165 6.14726 12.5381C6.23408 12.5985 6.30452 12.645 6.35171 12.6755C6.37527 12.6907 6.39294 12.7018 6.40383 12.7086L6.41495 12.7155L6.41519 12.7157L6.41551 12.7159L6.41578 12.7161L6.41619 12.7163L6.41647 12.7165L7.96448 13.655L6.34397 14.4653C6.26374 14.5054 6.18367 14.5412 6.10393 14.573C6.42924 14.8471 6.82517 15.0995 7.2464 15.2986L8.63623 15.9556L7.47226 16.9598C6.8369 17.508 6.19778 17.9166 5.36946 18.1326C6.59681 18.7875 8.00315 19.1596 9.49941 19.1596C14.3045 19.1596 18.1746 15.325 18.1746 10.6256V10.1059L18.5998 9.80721C19.2636 9.34107 19.7329 8.71068 20.0689 7.99004H18.5398H17.9084L17.637 7.41994C17.1401 6.37633 16.0772 5.65845 14.8486 5.65845ZM3.56882 12.9581C3.38031 13.174 3.29093 13.4642 3.33193 13.7553C3.44474 14.5563 3.92441 15.2462 4.45444 15.7728C4.59838 15.9158 4.75232 16.0531 4.91396 16.184C4.88926 16.1909 4.86437 16.1975 4.83925 16.2038C4.35789 16.3243 3.70926 16.3494 2.62755 16.2434C2.20934 16.2024 1.81014 16.4273 1.62841 16.8062C1.44668 17.185 1.5212 17.6371 1.81492 17.9376C3.75693 19.9245 6.48413 21.1596 9.49941 21.1596C15.212 21.1596 19.8978 16.7239 20.1628 11.126C21.4521 10.0429 22.0976 8.57673 22.4458 7.24263C22.5241 6.94292 22.459 6.62387 22.2696 6.37873C22.0803 6.13359 21.788 5.99004 21.4783 5.99004H19.1247C18.2201 4.58853 16.6437 3.65845 14.8486 3.65845C12.1796 3.65845 9.99072 5.71435 9.7793 8.32892C7.91032 7.84456 6.2705 6.78758 5.05863 5.35408C4.83759 5.09261 4.49814 4.9624 4.15894 5.00897C3.81974 5.05554 3.52794 5.27241 3.38555 5.58378C2.78087 6.90597 2.66434 8.43104 3.34116 9.98046L3.10746 10.0802C2.64466 10.2777 2.40073 10.7884 2.5379 11.2725C2.72276 11.925 3.14129 12.5011 3.56882 12.9581Z" fill="#3741519e"></path> </g></svg></button></div>
                            <div><button onclick="window.open('{{$linkedin}}','_blank')" title="Share on Linkedin"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M6.5 8C7.32843 8 8 7.32843 8 6.5C8 5.67157 7.32843 5 6.5 5C5.67157 5 5 5.67157 5 6.5C5 7.32843 5.67157 8 6.5 8Z" fill="#3741519e"></path> <path d="M5 10C5 9.44772 5.44772 9 6 9H7C7.55228 9 8 9.44771 8 10V18C8 18.5523 7.55228 19 7 19H6C5.44772 19 5 18.5523 5 18V10Z" fill="#3741519e"></path> <path d="M11 19H12C12.5523 19 13 18.5523 13 18V13.5C13 12 16 11 16 13V18.0004C16 18.5527 16.4477 19 17 19H18C18.5523 19 19 18.5523 19 18V12C19 10 17.5 9 15.5 9C13.5 9 13 10.5 13 10.5V10C13 9.44771 12.5523 9 12 9H11C10.4477 9 10 9.44772 10 10V18C10 18.5523 10.4477 19 11 19Z" fill="#3741519e"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M20 1C21.6569 1 23 2.34315 23 4V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H20ZM20 3C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3H20Z" fill="#3741519e"></path> </g></svg></button></div>
                            <div><button onclick="window.open('{{$telegrame}}','_blank')" title="Send on Telegrame"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" clip-rule="evenodd" d="M23.1117 4.49449C23.4296 2.94472 21.9074 1.65683 20.4317 2.227L2.3425 9.21601C0.694517 9.85273 0.621087 12.1572 2.22518 12.8975L6.1645 14.7157L8.03849 21.2746C8.13583 21.6153 8.40618 21.8791 8.74917 21.968C9.09216 22.0568 9.45658 21.9576 9.70712 21.707L12.5938 18.8203L16.6375 21.8531C17.8113 22.7334 19.5019 22.0922 19.7967 20.6549L23.1117 4.49449ZM3.0633 11.0816L21.1525 4.0926L17.8375 20.2531L13.1 16.6999C12.7019 16.4013 12.1448 16.4409 11.7929 16.7928L10.5565 18.0292L10.928 15.9861L18.2071 8.70703C18.5614 8.35278 18.5988 7.79106 18.2947 7.39293C17.9906 6.99479 17.4389 6.88312 17.0039 7.13168L6.95124 12.876L3.0633 11.0816ZM8.17695 14.4791L8.78333 16.6015L9.01614 15.321C9.05253 15.1209 9.14908 14.9366 9.29291 14.7928L11.5128 12.573L8.17695 14.4791Z" fill="#3741519e"></path> </g></svg></button></div>
                            <div><button onclick="window.open('{{$whatsapp}}','_blank')" title="Send on Whatsapp"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.50002 12C3.50002 7.30558 7.3056 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C10.3278 20.5 8.77127 20.0182 7.45798 19.1861C7.21357 19.0313 6.91408 18.9899 6.63684 19.0726L3.75769 19.9319L4.84173 17.3953C4.96986 17.0955 4.94379 16.7521 4.77187 16.4751C3.9657 15.176 3.50002 13.6439 3.50002 12ZM12 1.5C6.20103 1.5 1.50002 6.20101 1.50002 12C1.50002 13.8381 1.97316 15.5683 2.80465 17.0727L1.08047 21.107C0.928048 21.4637 0.99561 21.8763 1.25382 22.1657C1.51203 22.4552 1.91432 22.5692 2.28599 22.4582L6.78541 21.1155C8.32245 21.9965 10.1037 22.5 12 22.5C17.799 22.5 22.5 17.799 22.5 12C22.5 6.20101 17.799 1.5 12 1.5ZM14.2925 14.1824L12.9783 15.1081C12.3628 14.7575 11.6823 14.2681 10.9997 13.5855C10.2901 12.8759 9.76402 12.1433 9.37612 11.4713L10.2113 10.7624C10.5697 10.4582 10.6678 9.94533 10.447 9.53028L9.38284 7.53028C9.23954 7.26097 8.98116 7.0718 8.68115 7.01654C8.38113 6.96129 8.07231 7.046 7.84247 7.24659L7.52696 7.52195C6.76823 8.18414 6.3195 9.2723 6.69141 10.3741C7.07698 11.5163 7.89983 13.314 9.58552 14.9997C11.3991 16.8133 13.2413 17.5275 14.3186 17.8049C15.1866 18.0283 16.008 17.7288 16.5868 17.2572L17.1783 16.7752C17.4313 16.5691 17.5678 16.2524 17.544 15.9269C17.5201 15.6014 17.3389 15.308 17.0585 15.1409L15.3802 14.1409C15.0412 13.939 14.6152 13.9552 14.2925 14.1824Z" fill="#3741519e"></path> </g></svg></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- More Ads --}}
        <section class="s_ads">
            <div class="s_ads__row">
                <div class="s_ads__title">
                    <h2>قد يعجبك أيضاً</h2>
                </div>
                <div class="s_ads__slide grid">
                        
                    <div class="s_ad">
                        <div class="s_ad__row">
                            <a href="/ad" class="href">
                                <div class="s_ad__image">
                                    <img src="/image/default.png" alt="" />
                                </div>
                                <div class="s_ad__title">
                                    <h3 title="title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،</h3>
                                </div>
                            </a>
                            <div class="s_ad__price">
                                <b>$30.99</b>
                            </div>
                            <div class="s_ad__footer flex aic__jcs">
                                <div>
                                    <span>الدار البيضاء</span>
                                </div>
                                <div>
                                    <span>20 أغسطس</span>
                                </div>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                        
                    <div class="s_ad">
                        <div class="s_ad__row">
                            <a href="/ad" class="href">
                                <div class="s_ad__image">
                                    <img src="/image/default.png" alt="" />
                                </div>
                                <div class="s_ad__title">
                                    <h3 title="title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،</h3>
                                </div>
                            </a>
                            <div class="s_ad__price">
                                <b>$30.99</b>
                            </div>
                            <div class="s_ad__footer flex aic__jcs">
                                <div>
                                    <span>الدار البيضاء</span>
                                </div>
                                <div>
                                    <span>20 أغسطس</span>
                                </div>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                        
                    <div class="s_ad">
                        <div class="s_ad__row">
                            <a href="/ad" class="href">
                                <div class="s_ad__image">
                                    <img src="/image/default.png" alt="" />
                                </div>
                                <div class="s_ad__title">
                                    <h3 title="title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،</h3>
                                </div>
                            </a>
                            <div class="s_ad__price">
                                <b>$30.99</b>
                            </div>
                            <div class="s_ad__footer flex aic__jcs">
                                <div>
                                    <span>الدار البيضاء</span>
                                </div>
                                <div>
                                    <span>20 أغسطس</span>
                                </div>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                        
                    <div class="s_ad">
                        <div class="s_ad__row">
                            <a href="/ad" class="href">
                                <div class="s_ad__image">
                                    <img src="/image/default.png" alt="" />
                                </div>
                                <div class="s_ad__title">
                                    <h3 title="title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،</h3>
                                </div>
                            </a>
                            <div class="s_ad__price">
                                <b>$30.99</b>
                            </div>
                            <div class="s_ad__footer flex aic__jcs">
                                <div>
                                    <span>الدار البيضاء</span>
                                </div>
                                <div>
                                    <span>20 أغسطس</span>
                                </div>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                        
                    <div class="s_ad">
                        <div class="s_ad__row">
                            <a href="/ad" class="href">
                                <div class="s_ad__image">
                                    <img src="/image/default.png" alt="" />
                                </div>
                                <div class="s_ad__title">
                                    <h3 title="title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة،</h3>
                                </div>
                            </a>
                            <div class="s_ad__price">
                                <b>$30.99</b>
                            </div>
                            <div class="s_ad__footer flex aic__jcs">
                                <div>
                                    <span>الدار البيضاء</span>
                                </div>
                                <div>
                                    <span>20 أغسطس</span>
                                </div>
                            </div>
                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

    <script>
        var previewBox = document.querySelector(".preview");
        var previewImg = document.querySelector("#previewImg");

        function showPreviewImage(url) {
            previewImg.src = url;
            previewBox.style.display = 'block';
        }

        function hidePreviewImage() {
            previewImg.src = '';
            previewBox.style.display = 'none';
        }
    </script>
@endsection
