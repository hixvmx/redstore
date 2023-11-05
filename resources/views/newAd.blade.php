@extends('layout.master')
@section('metatags')
    <title>add new ad - RedBox</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/newad.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
@endsection

@section('content')
    <main class="main wd__80">
        <div class="newad__page">
            <div class="new__ad__header">
                <h2>أضف إعلان جديد</h2>
            </div>

            <div class="new__ad__body">
                <form id="AddNewAdForm" method="POST" enctype="multipart/form-data">
                    <div class="input__group">
                        <label for="title">العنوان</label>
                        <input name="title" id="title" type="text" autocomplete="off" />
                        <span id="title_err"></span>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="price">الثمن</label>
                            <input name="price" id="price" type="text" autocomplete="off" />
                            <span id="price_err"></span>
                        </div>
                        <div class="input__group">
                            <label for="currency">العملة</label>
                            <select name="currency" id="currency">
                                <option value=""></option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                            <span id="currency_err"></span>
                        </div>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="category">التصنيف الرئيسي</label>
                            <select name="category" id="category">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span id="category_err"></span>
                        </div>
                        <div class="input__group">
                            <label for="sub_category">التصنيف الفرعي</label>
                            <select name="sub_category" id="sub_category">
                            </select>
                            <span id="sub_category_err"></span>
                        </div>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="country">الدولة</label>
                            <select name="country" id="country">
                                <option value=""></option>
                                @foreach ($countries as $country)
                                    <option value={{ $country->id }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <span id="country_err"></span>
                        </div>
                        <div class="input__group">
                            <label for="city">المدينة</label>
                            <select name="city" id="city">
                            </select>
                            <span id="city_err"></span>
                        </div>
                    </div>

                    <div class="choose__images__section" id="indexImageSection">
                        <label class="section__title">الصورة الرئيسية</label>
                        <div class="choose__images__body">
                            <label for="indexImage" class="choose__images" id="indexImageBtn">
                                <input name="image" id="indexImage" type="file" accept="image/jpeg, image/png, image/jpg" hidden />
                                <i id="indexImageBtnTitle">اختر الصورة</i>
                            </label>
                            <span id="image_err"></span>
                            <div id="indexImagePreview"></div>
                        </div>
                    </div>

                    <div class="choose__images__section" id="moreImagesSection">
                        <label class="section__title">المزيد من الصور</label>
                        <div class="choose__images__body">
                            <label for="moreImages" class="choose__images" id="moreImagesBtn">
                                <input name="images" id="moreImages" type="file" multiple accept="image/jpeg, image/png, image/jpg" hidden />
                                <i id="moreImagesBtnTitle">اختر الصور</i>
                            </label>
                            <span id="images_err"></span>
                            <div id="moreImagesPreview"></div>
                        </div>
                    </div>

                    <div id="result" style="display: none;margin: 2rem 0;"></div>

                    <div class="input__btn">
                        <button type="submit" id="submitButton">
                            نشر الإعلان
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var submitForm = document.getElementById("AddNewAdForm");

        submitForm.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData();

            formData.append("title", document.querySelector("#title").value);
            formData.append("price", document.querySelector("#price").value);
            formData.append("currency", document.querySelector("#currency").value);
            formData.append("category", document.querySelector("#category").value);
            formData.append("sub_category", document.querySelector("#sub_category").value);
            formData.append("country", document.querySelector("#country").value);
            formData.append("city", document.querySelector("#city").value);
            formData.append("image", document.querySelector("#indexImage").files[0]);


            document.getElementById("title_err").style.display = "none";
            document.getElementById("price_err").style.display = "none";
            document.getElementById("currency_err").style.display = "none";
            document.getElementById("category_err").style.display = "none";
            document.getElementById("sub_category_err").style.display = "none";
            document.getElementById("country_err").style.display = "none";
            document.getElementById("city_err").style.display = "none";


            var moreImagesInput = document.querySelector("#moreImages");
            for (var i = 0; i < moreImagesInput.files.length; i++) {
                formData.append("images[]", moreImagesInput.files[i]);
            }


            var inputs = [
                document.querySelector("#title"),
                document.querySelector("#price"),
                document.querySelector("#category"),
                document.querySelector("#sub_category"),
                document.querySelector("#country"),
                document.querySelector("#city")
            ];


            document.querySelector("#indexImageBtn").style.border = "1px solid #e4e4e7";
            document.querySelector("#moreImagesBtn").style.border = "1px solid #e4e4e7";
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].style.border = "1px solid #e4e4e7";
            }

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                if (input.value.trim() === "") {
                    input.style.border = "1px solid #ff9999";
                    return false;
                }
            }

            if (document.querySelector("#indexImage").files.length === 0) {
                document.querySelector("#indexImageBtn").style.border = "1px solid #ff9999";
                return false;
            }

            if (document.querySelector("#moreImages").files.length === 0) {
                document.querySelector("#moreImagesBtn").style.border = "1px solid #ff9999";
                return false;
            }

            async function sendRequest() {

                try {
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'جاري الإرسال...';

                    const response = await axios.post('/save-new-ad', formData, {
                        headers : {
                            "X-CSRF-TOKEN": csrfToken
                        }
                    })

                    const data = await response.data;

                    if (data.status == 1) {
                        const resultsElement = document.getElementById("result");
                        resultsElement.innerHTML = '<p style="color: green;">' + data.result + '</p>';
                        resultsElement.style.display = 'block';
                    }

                    submitButton.disabled = false;
                    submitButton.innerHTML = 'نشر الإعلان';
                } catch (error) {

                    if (error.response) {
                        if (error.response.status === 422) {
                            for (var key in error.response.data.errors) {
                                var errorElement = document.getElementById(key + "_err");
                                errorElement.innerHTML = error.response.data.errors[key][0];
                                errorElement.style.display = "block";
                            }
                        }
                    }

                    else if (error.request) {
                        console.log("No response received:", error.request);
                    }
                    
                    else {
                        console.error("Request error:", error.message);
                    }

                    submitButton.disabled = false;
                    submitButton.innerHTML = 'نشر الإعلان';
                }
            }

            sendRequest();
        });

        // country selection
        var citiesData = @json($cities);
        var countrySelect = document.getElementById("country");
        var citySelect = document.getElementById("city");
        countrySelect.addEventListener("change", function() {
            citySelect.innerHTML = '';

            var selectedCountryId = this.value;

            if (selectedCountryId) {
                // Filter cities based on the selected country
                var filteredCities = citiesData.filter(function(city) {
                    return city.country == selectedCountryId;
                });

                // Populate the city select element with filtered cities
                filteredCities.forEach(function(city) {
                    var option = document.createElement("option");
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        });

        // category selection
        var subCategoriesData = @json($sub_categories);
        var categorySelect = document.getElementById("category");
        var subCategorySelect = document.getElementById("sub_category");
        categorySelect.addEventListener("change", function() {
            subCategorySelect.innerHTML = '';

            var selectedCategoryId = this.value;

            if (selectedCategoryId) {
                // Filter cities based on the selected country
                var filteredsubCategories = subCategoriesData.filter(function(subCat) {
                    return subCat.category == selectedCategoryId;
                });

                // Populate the city select element with filtered cities
                filteredsubCategories.forEach(function(subCat) {
                    var option = document.createElement("option");
                    option.value = subCat.id;
                    option.textContent = subCat.name;
                    subCategorySelect.appendChild(option);
                });
            }
        });

        // index image
        document.getElementById('indexImage').addEventListener('change', function(e) {
            const indexImageBtn = document.getElementById('indexImageBtn');
            const indexImageBtnTitle = document.getElementById('indexImageBtnTitle');
            const indexImagePreview = document.getElementById('indexImagePreview');
            indexImagePreview.innerHTML = '';

            const file = e.target.files[0];
            if (file) {
                indexImageBtn.style.height = 'auto';
                indexImageBtnTitle.innerHTML = 'تغيير الصورة';

                const reader = new FileReader();

                reader.onload = function(e) {
                    const image = new Image();
                    image.src = e.target.result;
                    indexImagePreview.appendChild(image);
                };

                reader.readAsDataURL(file);
            } else {
                indexImageBtn.style.height = '200px';
                indexImageBtnTitle.innerHTML = 'اختر الصورة';
            }
        });

        // images
        document.getElementById('moreImages').addEventListener('change', function(e) {
            const moreImagesBtn = document.getElementById('moreImagesBtn');
            const moreImagesBtnTitle = document.getElementById('moreImagesBtnTitle');
            const moreImagesPreview = document.getElementById('moreImagesPreview');
            moreImagesPreview.innerHTML = '';

            const files = e.target.files;

            if (files) {
                moreImagesBtn.style.height = 'auto';
                moreImagesBtnTitle.innerHTML = 'تغيير الصور';
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const image = new Image();
                        image.src = e.target.result;

                        // Add the image to the preview div
                        moreImagesPreview.appendChild(image);
                    };

                    reader.readAsDataURL(file);
                }
            } else {
                moreImagesBtn.style.height = '200px';
                moreImagesBtnTitle.innerHTML = 'اختر الصور';
            }
        });
    </script>
@endsection
