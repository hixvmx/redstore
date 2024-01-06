@extends('layout.master')
@section('metatags')
    <title>التصنيفات - ريدسطور</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}" />
@endsection

@section('content')
    @if (count($categories) > 0)
    <section class="categories">
        <div class="categories__row maxWidth">
            <div class="categories__title">
                <h2>التصنيفات</h2>
            </div>
            <div class="show__categories grid">
                @foreach ($categories as $category)
                    <div class="category">
                        <div class="category__row">
                            <div class="category__title">
                                <a href="/search?category={{ $category->id }}">
                                    <div class="category_parent">
                                        <h3>{{ $category->name }}</h3>
                                        <span>{{ $category->total_ads }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="categories__sub__category">
                                @if (count($category->childrens) > 0)
                                    @foreach ($category->childrens as $subcategory)
                                        <a
                                            href="/search?category={{ $category->id }}&subCategory={{ $subcategory->id }}">
                                            <div class="category_child">
                                                <h3>{{ $subcategory->name }}</h3>
                                                <span>{{ $subcategory->total_ads }}</span>
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
@endsection
