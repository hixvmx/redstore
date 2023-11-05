<?php
    use App\Models\Category;
    use App\Models\SubCategory;

    // get categories
    $categories = Category::select('id','slug','name','image')->get();

    function getSubCategoriesx($categoryID) {
        if (!empty($categoryID)) {

            $SubCategoriesData = SubCategory::select('id','slug','name','image')
            ->where('category', $categoryID)
            ->get();

            return $SubCategoriesData;
        }
        return [];
    }

?>
@extends('layout.master')
@section('metatags')
<title>RedBox</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/home_content.css') }}" />
@endsection

@section('content')
    <main class="main wd__80">
        <section class="welcome">
            <div class="welcome__row flex ">
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


        @if (count($categories) > 0)
        <section class="categories">
            <div class="categories__row">
                <div class="categories__title">
                    <h2>التصنيفات</h2>
                </div>
                <div class="show__categories grid">
                    
                    @foreach ($categories as $category)
                                <div class="category">
                                    <div class="category__row">
                                        <div class="category__title__img">
                                            <a href="/search?category={{$category->id}}">
                                                <div>
                                                    <img src="{{$category->image}}" alt="{{$category->name}}" />
                                                    <h3>{{$category->name}}</h3>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="categories__sub__category">
                                            <?php $subCategories = getSubCategoriesx($category->id); ?>
                                            @if (count($subCategories) > 0)
                                                @foreach ($subCategories as $subCategory)
                                                    <a href="/search?category={{$category->id}}&subCategory={{$subCategory->id}}">
                                                        <div>
                                                            <img src="{{$subCategory->image}}" alt="{{$subCategory->name}}" />
                                                            <h3>{{$subCategory->name}}</h3>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                
                        </div>
                    </div>
                </section>
        @endif

        @if (count($categoriesx) > 0)
            @foreach ($categoriesx as $categoryx)
                <section class="ads">
                    <div class="ads__row">
                        <div class="ads__title">
                            <h2>الأكثر مبيعاََ في : {{$categoryx['name']}}</h2>
                        </div>
                        <div class="ads__slide grid">
                            @if (count($categoryx['items']) > 0)
                                @foreach ($categoryx['items'] as $ad)
                                    <div class="ad">
                                        <div class="ad__row">
                                            <a href="/ad/{{$ad->slug}}" class="href">
                                                <div class="ad__image">
                                                    <img src="{{$ad->image}}" alt="{{$ad->title}}" />
                                                </div>
                                                <div class="ad__title">
                                                    <h3 title="title">{{$ad->title}}</h3>
                                                </div>
                                            </a>
                                            <div class="ad__price">
                                                <b>{{$ad->currency->name .' '. $ad->price}}</b>
                                            </div>
                                            <div class="ad__footer flex aic__jcs">
                                                <div>
                                                    <span>{{$ad->country->name}}</span>
                                                </div>
                                                <div>
                                                    <span>20 أغسطس</span>
                                                </div>
                                            </div>
                                            <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
            @endforeach
        @endif
    </main>
@endsection
