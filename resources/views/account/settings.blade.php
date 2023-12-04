@extends('layout.account')
@section('pg_metatags')
    <title>settings - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/account/settings.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
@endsection


@section('pg_source')
    <div class="main__header">
        <a href="/">الرئيسية</a>
        <span>-</span>
        <span>إعدادات الحساب</span>
    </div>
@endsection

@section('pg_content')
    <div class="settings">
        <div class="content__head">
            <span>إعدادات الحساب</span>
        </div>
        <div class="settings__row">
            <form id="updateSettings" method="POST" enctype="multipart/form-data">
                <div class="login__form">
                    <div class="input__group">
                        <input name="avatar" id="avatar" type="file" accept="image/jpeg, image/png, image/jpg" hidden />
                        <label class="avatar__img" for="avatar">
                            <img src="{{$user->avatar}}" id="avatarPreview" />
                        </label>
                        <span id="avatar_err" style="display: none;"></span>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="firstname">الإسم الشخصي</label>
                            <input name="firstname" id="firstname" type="text" autocomplete="off" value="{{$user->firstname}}" />
                            <span id="firstname_err" style="display: none;"></span>
                        </div>
                        <div class="input__group">
                            <label for="lastname">الإسم العائلي</label>
                            <input name="lastname" id="lastname" type="text" autocomplete="off" value="{{$user->lastname}}" />
                            <span id="lastname_err" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="country">الدولة</label>
                            <select name="country" id="country">
                                @if (!$user->country)
                                    <option value=""></option>
                                @endif
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == ($user->country->id ?? null) ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <span id="country_err" style="display: none;"></span>
                        </div>
                        <div class="input__group">
                            <label for="city">المدينة</label>
                            <select name="city" id="city">
                            </select>
                            <span id="city_err" style="display: none;"></span>
                        </div>
                    </div>

                    <div class="group__in__group">
                        <div class="input__group">
                            <label for="gender">الجنس</label>
                            <select name="gender" id="gender">
                                @if (!$user->gender)
                                    <option value=""></option>
                                @endif
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                            <span id="gender_err" style="display: none;"></span>
                        </div>
                        <div class="input__group">
                            <label for="birthdate">تاريخ الإزدياد</label>
                            <input name="birthdate" id="birthdate" type="date" autocomplete="off" value="{{$user->birthdate}}" min="1960-01-01" max="2020-12-31" />
                            <span id="birthdate_err" style="display: none;"></span>
                        </div>
                    </div>

                    <div id="result" style="display: none;margin: 2rem 0;"></div>

                    <div class="input__btn">
                        <button type="submit" id="submitButton">
                            حفظ التعديلات
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var submitForm = document.getElementById("updateSettings");

        submitForm.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append("avatar", document.querySelector("#avatar").files[0]);
            formData.append("firstname", document.querySelector("#firstname").value);
            formData.append("lastname", document.querySelector("#lastname").value);
            formData.append("country", document.querySelector("#country").value);
            formData.append("city", document.querySelector("#city").value);
            formData.append("gender", document.querySelector("#gender").value);
            formData.append("birthdate", document.querySelector("#birthdate").value);


            var inputs = [
                document.querySelector("#firstname"),
                document.querySelector("#lastname"),
                document.querySelector("#gender"),
                document.querySelector("#birthdate")
            ];
            

            document.getElementById("avatar_err").style.display = "none";
            document.getElementById("firstname_err").style.display = "none";
            document.getElementById("lastname_err").style.display = "none";
            document.getElementById("lastname_err").style.display = "none";
            document.getElementById("country_err").style.display = "none";
            document.getElementById("city_err").style.display = "none";
            document.getElementById("birthdate_err").style.display = "none";
            document.getElementById("result").style.display = "none";


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

            
            async function sendRequest() {
                
                const submitButton = document.getElementById("submitButton");

                try {
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'جاري الإرسال...';

                    const response = await axios.post('/account/update-settings', formData, {
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
                    submitButton.innerHTML = 'حفظ التعديلات';
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
                    submitButton.innerHTML = 'حفظ التعديلات';
                }
            }

            sendRequest();
        });
        

        // avatar
        document.getElementById('avatar').addEventListener('change', function(e) {
            const preview = document.getElementById('avatarPreview');

            const file = e.target.files[0];

            if (file) {
                const imageUrl = URL.createObjectURL(file);
                preview.src = imageUrl;
            }
            else {
                preview.src = "{{ url($user->avatar ?? '') }}";
            }
        });


        // selections
        var citiesData = @json($cities);
        var countrySelect = document.getElementById("country");
        var citySelect = document.getElementById("city");
        var userCity = @json($user->city->id ?? null);

        function setCities(id) {
            if (id) {
                // Filter cities based on the selected country
                var filteredCities = citiesData.filter(function(city) {
                    return city.country == id;
                });

                // Populate the city select element with filtered cities
                filteredCities.forEach(function(city) {
                    var isSelected = (userCity == city.id) ? true : false;
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
            citySelect.innerHTML = '';
            setCities(this.value)
        });
    </script>
@endsection
