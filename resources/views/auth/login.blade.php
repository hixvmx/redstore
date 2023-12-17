@extends('layout.master')
@section('metatags')
    <title>تسجيل الدخول - redStore</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    <main class="main maxWidth">
        <div class="main__header">
            <a href="/">الرئيسية</a>
            <span>-</span>
            <span>دخول</span>
        </div>
        <div class="login">
            <div class="login__row">
                <div class="form__header">
                    <h1>تسجيل الدخول</h1>
                </div>

                <form id="LoginForm">
                    <div class="login__form">
                        <div class="input__group">
                            <label for="">البريد الإلكتروني</label>
                            <input name="email" id="email" type="text" />
                            <span class="err" id="email-error" style="display: none;"></span>
                        </div>
                        <div class="input__group">
                            <label for="">كلمة السر</label>
                            <input name="password" id="password" type="password" />
                            <span class="err" id="password-error" style="display: none;"></span>
                        </div>

                        <div class="result input__group" style="display: none;"></div>

                        <div class="input__btn">
                            <button type="submit" id="submitButton">
                                تسجيل الدخول
                            </button>
                        </div>
                    </div>
                </form>

                <div class="form__footer">
                    <ul>
                        <li><a href="/register">ليس لدي حساب</a></li>
                        <li><a href="#">شروط الإستخدام</a></li>
                        <li><a href="#">سياسة الخصوصية</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#LoginForm").submit(function() {
                var formData = new FormData(this);
                var inputs = ["#email", "#password"];

                for (var i = 0; i < inputs.length; i++) {
                    var input = $(inputs[i]);
                    if ($.trim(input.val()) === "") {
                        input.css("border", "1px solid #ff9999");
                        return false;
                    }
                }

                var submitButton = $("#submitButton");

                $.ajax({
                    type: 'POST',
                    url: '/login',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".result, .err").html('').hide();
                        submitButton.prop("disabled", true).html('جاري الإرسال...');
                    },
                    success: function(data) {
                        var messageClass = data.status == 1 ? "color: green;" : "";
                        $(".result").html(
                            '<p class="message__error" style="' + messageClass + '">' + data.result + '</p>'
                        ).show();

                        if (data.status == 1) {
                            window.location.href = '/';
                        }
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            $.each(error.responseJSON.errors, function(key, value) {
                                $("#" + key + "-error").html(value[0]).show();
                            });
                        } else {
                            $(".result").html(
                                '<p class="message__error">Something went wrong, please try again later.</p>'
                            ).show();
                        }
                    },
                    complete: function() {
                        submitButton.prop("disabled", false).html('تسجيل الدخول');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
