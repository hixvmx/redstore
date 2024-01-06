@extends('layout.master')
@section('metatags')
    <title>إنشاء حساب - ريدسطور</title>
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')
    <main class="main maxWidth">
        <div class="main__header">
            <a href="/">الرئيسية</a>
            <span>-</span>
            <span>إنشاء حساب</span>
        </div>
        <div class="register">
            <div class="register__row">
                <div class="form__header">
                    <h1>إنشاء حساب جديد</h1>
                </div>

                <form id="RegisterationForm">
                    <div class="login__form">
                        <div class="group__in__group">
                            <div class="input__group">
                                <label for="">الإسم الشخصي</label>
                                <input name="firstname" id="firstname" type="text" autocomplete="off" />
                                <span class="err" id="firstname-error" style="display: none;"></span>
                            </div>
                            <div class="input__group">
                                <label for="">الإسم العائلي</label>
                                <input name="lastname" id="lastname" type="text" autocomplete="off" />
                                <span class="err" id="lastname-error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="input__group">
                            <label for="">البريد الإلكتروني</label>
                            <input name="email" id="email" type="text" autocomplete="off" />
                            <span class="err" id="email-error" style="display: none;"></span>
                        </div>
                        <div class="input__group">
                            <label for="">كلمة السر</label>
                            <input name="password" id="password" type="password" autocomplete="off" />
                            <span class="err" id="password-error" style="display: none;"></span>
                        </div>

                        <div class="result input__group" style="display: none;"></div>

                        <div class="input__btn">
                            <button type="submit" id="submitButton">
                                إنشاء حساب
                            </button>
                        </div>
                    </div>
                </form>

                <div class="form__footer">
                    <ul>
                        <li><a href="/login">لدي حساب بالفعل</a></li>
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

            $("#RegisterationForm").submit(function() {
                var formData = new FormData(this);
                var inputs = ["#firstname", "#lastname", "#email", "#password"];

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
                    url: '/register',
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
                            window.location.href = '/login';
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
                        submitButton.prop("disabled", false).html('إنشاء حساب');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
