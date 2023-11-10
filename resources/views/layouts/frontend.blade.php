<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>

    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="Content-Language" content="en-us">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/limo-mobile.css">

    @stack('css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @stack('js')

    <script src="/js/limo_lng.js"></script>
    <script src="/js/limo.js"></script>
</head>

<body>
    <div id="container" class="container">
        <div id="header"><a href="/"><img src="/img/logo.png"></a></div>

        <x-login-panel></x-login-panel>

        @include('alert::bootstrap')

        {{ $slot }}

        <div id="footer">

        </div>
    </div>
</body>
</html>
