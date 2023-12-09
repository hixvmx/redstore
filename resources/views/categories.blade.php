<?php
use App\Models\Category;
use App\Models\SubCategory;

// get categories
$categories = Category::select('id', 'slug', 'name', 'image')->get();

function getSubCategoriesx($categoryID)
{
    if (!empty($categoryID)) {
        $SubCategoriesData = SubCategory::select('id', 'slug', 'name', 'image')
            ->where('category', $categoryID)
            ->get();

        return $SubCategoriesData;
    }
    return [];
}

?>
@extends('layout.master')
@section('metatags')
    <title>categories - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}" />
@endsection

@section('content')
    @if (count($categories) > 0)
    <section class="categories">
        <div class="categories__row wd__80">
            <div class="categories__title">
                <h2>التصنيفات</h2>
            </div>
            <div class="show__categories grid">
                @foreach ($categories as $category)
                    <div class="category">
                        <div class="category__row">
                            <div class="category__title__img">
                                <a href="/search?category={{ $category->id }}">
                                    <div class="category_parent">
                                        <h3>{{ $category->name }}</h3>
                                        <span>504</span>
                                    </div>
                                </a>
                            </div>
                            <div class="categories__sub__category">
                                <?php $subCategories = getSubCategoriesx($category->id); ?>
                                @if (count($subCategories) > 0)
                                    @foreach ($subCategories as $subCategory)
                                        <a
                                            href="/search?category={{ $category->id }}&subCategory={{ $subCategory->id }}">
                                            <div class="category_child">
                                                <h3>{{ $subCategory->name }}</h3>
                                                <span>504</span>
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
