@extends('layout.account')
@section('pg_metatags')
    <title>تغيير كلمة السر - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/account/changePassword.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/useAxios.js') }}"></script>
@endsection


@section('pg_source')
    <div class="main__header">
        <a href="/">الرئيسية</a>
        <span>-</span>
        <span>تغيير كلمة السر</span>
    </div>
@endsection

@section('pg_content')
    <div class="password">
        <div class="content__head">
            <span>تغيير كلمة السر</span>
        </div>
        <div class="password__row">
            <form id="changePassword">
                <div class="input__group">
                    <label for="current_password">كلمة السر الحالية</label>
                    <input name="current_password" id="current_password" type="password" autocomplete="off" />
                    <span id="current_password_err" style="display: none;"></span>
                </div>
                <div class="input__group">
                    <label for="new_password">كلمة السر الجديدة</label>
                    <input name="new_password" id="new_password" type="password" autocomplete="off" />
                    <span id="new_password_err" style="display: none;"></span>
                </div>
                <div class="input__group">
                    <label for="repeat_new_password">تأكيد كلمة السر الجديدة</label>
                    <input name="repeat_new_password" id="repeat_new_password" type="password" autocomplete="off" />
                    <span id="repeat_new_password_err" style="display: none;"></span>
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
        var submitForm = document.getElementById("changePassword");

        submitForm.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData();
            formData.append("current_password", document.querySelector("#current_password").value);
            formData.append("new_password", document.querySelector("#new_password").value);
            formData.append("repeat_new_password", document.querySelector("#repeat_new_password").value);


            var inputs = [
                document.querySelector("#current_password"),
                document.querySelector("#new_password"),
                document.querySelector("#repeat_new_password")
            ];
            

            document.getElementById("current_password_err").style.display = "none";
            document.getElementById("new_password_err").style.display = "none";
            document.getElementById("repeat_new_password_err").style.display = "none";
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

                    const response = await axios.post('/account/update-password', formData, {
                        headers : {
                            "X-CSRF-TOKEN": csrfToken
                        }
                    })

                    const data = await response.data;

                    const resultsElement = document.getElementById("result");
                    
                    if (data.status == 1) {
                        resultsElement.innerHTML = '<p style="color: green;">' + data.result + '</p>';
                        resultsElement.style.display = 'block';
                        document.querySelector("#current_password").value = '';
                        document.querySelector("#new_password").value = '';
                        document.querySelector("#repeat_new_password").value = '';
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
