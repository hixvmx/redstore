@extends('layout.master')
@section('metatags')
    <title>Search - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/search.css') }}" />
@endsection

@section('content')
    <main class="main wd__80">
        <div class="search__page">
            <div class="aside">
                <div class="aside__body">
                    <?php
                    $pram = [];
                    $pram['keywords'] = app('request')->input('keywords');
                    $pram['category'] = app('request')->input('category');
                    $pram['subCategory'] = app('request')->input('subCategory');
                    $pram['country'] = app('request')->input('country');
                    $pram['city'] = app('request')->input('city');
                    $pram['orderBy'] = app('request')->input('orderBy');
                    ?>
                    <form action="" method="get">
                        <div class="input__group">
                            <label for="keywords">كلمة البحث</label>
                            <input name="keywords" id="keywords" type="text" autocomplete="off" value="{{ $pram['keywords'] }}" />
                        </div>
    
                        <div class="input__group">
                            <label for="category">التصنيف الرئيسي</label>
                            <select name="category" id="category">
                                <option value="all">الكل</option>
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $pram['category'] == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="input__group">
                            <label for="sub_category">التصنيف الفرعي</label>
                            <select name="subCategory" id="sub_category">
                                <option value="all">الكل</option>
                            </select>
                        </div>
    
                        <div class="input__group">
                            <label for="country">الدولة</label>
                            <select name="country" id="country">
                                <option value="all">الكل</option>
                                @foreach ($countries as $country)
                                    <option
                                        value="{{ $country->id }}"
                                        {{ $pram['country'] == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="input__group">
                            <label for="city">المدينة</label>
                            <select name="city" id="city">
                                <option value="all">الكل</option>
                            </select>
                        </div>
    
                        <div class="input__group">
                            <label for="orderBy">الترتيب حسب</label>
                            <select name="orderBy" id="orderBy">
                                <option value="new" {{ $pram['orderBy'] == "new" ? 'selected' : '' }}>الأحدث</option>
                                <option value="old" {{ $pram['orderBy'] == "old" ? 'selected' : '' }}>الأقدم</option>
                            </select>
                        </div>
    
                        <div class="input__btn">
                            <button type="submit">
                                عرض النتائج
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="results">
                <div class="results__header">
                    <h2>نتائج البحث</h2>
                </div>
                <div class="results__body">
                    <div class="ads__slide grid">
                        
                        @if (count($ads) > 0)
                            @foreach ($ads as $ad)
                                <div class="ad">
                                    <div class="ad__row">
                                        <a href="/ad/{{$ad->slug}}" class="href">
                                            <div class="ad__image">
                                                <img src="{{$ad->image}}" alt="{{$ad->title}}" loading="lazy" />
                                            </div>
                                            <div class="ad__title">
                                                <h3 title="{{$ad->title}}">{{$ad->title}}</h3>
                                            </div>
                                        </a>
                                        <div class="ad__price">
                                            <b>{{$ad->currency->name .' '. $ad->price}}</b>
                                        </div>
                                        <button class="favorite__btn"><svg viewBox="0 0 24 24" fill="none"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g><path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" stroke-width="2"></path></g></svg></button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="">
                                Not Found!
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // category selection
        var subCategoriesData = @json($sub_categories);
        var categorySelect = document.getElementById("category");
        var subCategorySelect = document.getElementById("sub_category");
        var adSubCategory = @json($pram['subCategory']);

        function setSubCategory(id) {
            if (id) {
                // Filter cities based on the selected country
                var filteredSubCategories = subCategoriesData.filter(function(category) {
                    return category.category == id;
                });

                // Populate the city select element with filtered cities
                filteredSubCategories.forEach(function(category) {
                    var isSelected = (adSubCategory == category.id) ? true : false;
                    var option = document.createElement("option");
                    option.value = category.id;
                    option.textContent = category.name;
                    option.selected = isSelected;
                    subCategorySelect.appendChild(option);
                });
            }
        }

        if (categorySelect.value !== "") {
            setSubCategory(categorySelect.value)
        }

        categorySelect.addEventListener("change", function() {
            subCategorySelect.innerHTML = '<option value="all">الكل</option>';
            setSubCategory(this.value);
        });


        // country selection
        var citiesData = @json($cities);
        var countrySelect = document.getElementById("country");
        var citySelect = document.getElementById("city");
        var adCity = @json($pram['city']);

        function setCities(id) {
            if (id) {
                // Filter cities based on the selected country
                var filteredCities = citiesData.filter(function(city) {
                    return city.country == id;
                });

                // Populate the city select element with filtered cities
                filteredCities.forEach(function(city) {
                    var isSelected = (adCity == city.id) ? true : false;
                    var option = document.createElement("option");
                    option.value = city.id;
                    option.textContent = city.name;
                    option.selected = isSelected;
                    citySelect.appendChild(option);
                });
            }
        }

        if (countrySelect.value !== "") {
            setCities(countrySelect.value)
        }

        countrySelect.addEventListener("change", function() {
            citySelect.innerHTML = '<option value="all">الكل</option>';
            setCities(this.value);
        });
    </script>
@endsection
