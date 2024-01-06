@extends('layout.account')
@section('pg_metatags')
    <title>بيانات الإتصال - ريدسطور</title>
    <link rel="stylesheet" href="{{ asset('css/account/contactInformations.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
@endsection


@section('pg_source')
    <div class="main__header">
        <a href="/">الرئيسية</a>
        <span>-</span>
        <span>بيانات الإتصال</span>
    </div>
@endsection

@section('pg_content')
    <div class="contact__info">
        <div class="content__head">
            <span>بيانات الإتصال</span>
        </div>
        <div class="contact__info__row">
            <form id="contactInformations">
                <div class="group__in__group">
                    <div class="input__group">
                        <label for="email">البريد الإلكتروني</label>
                        <input name="email" id="email" type="text" autocomplete="off" value="{{ $user->email }}" />
                        <span id="email_err" style="display: none;"></span>
                    </div>
                    <div class="input__group">
                        <label for="phone">رقم الهاتف</label>
                        <input name="phone" id="phone" type="text" autocomplete="off" value="{{ $user->phone_number }}" />
                        <span id="phone_err" style="display: none;"></span>
                    </div>
                </div>

                <div class="group__in__group">
                    <div class="input__group">
                        <label for="facebook">فيسبوك</label>
                        <input name="facebook" id="facebook" type="text" autocomplete="off" value="{{ $user->facebook_url }}" />
                        <span id="facebook_err" style="display: none;"></span>
                    </div>
                    <div class="input__group">
                        <label for="instagram">إنستغرام</label>
                        <input name="instagram" id="instagram" type="text" autocomplete="off" value="{{ $user->instagram_url }}" />
                        <span id="instagram_err" style="display: none;"></span>
                    </div>
                </div>

                <div class="group__in__group">
                    <div class="input__group">
                        <label for="website">الموقع الإلكتروني</label>
                        <input name="website" id="website" type="text" autocomplete="off" value="{{ $user->website_url }}" />
                        <span id="website_err" style="display: none;"></span>
                    </div>
                    <div class="input__group">
                        <label for="twitter">تويتر</label>
                        <input name="twitter" id="twitter" type="text" autocomplete="off" value="{{ $user->twitter_url }}" />
                        <span id="twitter_err" style="display: none;"></span>
                    </div>
                </div>

                <div id="result" style="display: none;margin: 2rem 0;"></div>

                <div class="input__btn">
                    <button type="submit" id="submitButton">
                        حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var submitForm = document.getElementById("contactInformations");

        submitForm.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append("email", document.querySelector("#email").value);
            formData.append("phone", document.querySelector("#phone").value);
            formData.append("facebook", document.querySelector("#facebook").value);
            formData.append("instagram", document.querySelector("#instagram").value);
            formData.append("website", document.querySelector("#website").value);
            formData.append("twitter", document.querySelector("#twitter").value);


            var inputs = [
                document.querySelector("#email"),
                document.querySelector("#phone"),
                // document.querySelector("#facebook"),
                // document.querySelector("#instagram"),
                // document.querySelector("#website"),
                // document.querySelector("#twitter")
            ];
            

            document.getElementById("email_err").style.display = "none";
            document.getElementById("phone_err").style.display = "none";
            document.getElementById("facebook_err").style.display = "none";
            document.getElementById("instagram_err").style.display = "none";
            document.getElementById("website_err").style.display = "none";
            document.getElementById("twitter_err").style.display = "none";
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

                    const response = await axios.post('/account/update-contact-informations', formData, {
                        headers : {
                            "X-CSRF-TOKEN": csrfToken
                        }
                    })

                    const data = await response.data;

                    const resultsElement = document.getElementById("result");
                    
                    if (data.status == 1) {
                        resultsElement.innerHTML = '<p style="color: green;">' + data.result + '</p>';
                        resultsElement.style.display = 'block';
                    } else {
                        resultsElement.innerHTML = '<p style="color: red;">' + data.result + '</p>';
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
    </script>
@endsection
