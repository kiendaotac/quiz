<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="{{ env('APP_NAME') }}" />
    <meta name="keywords" content="{{ env('APP_NAME') }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:url" content="{{ asset('/') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>
<body>
    {{ $slot }}
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>