<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon" />
    @yield('metatags')
</head>
<body>
    @include('components.global.header')

    @yield('content')

    @include('components.global.footer')
</body>
</html>
