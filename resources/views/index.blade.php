<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#2196f3">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#2196f3">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Random App">

        <!-- Disable automatic detection of possible phone numbers in a webpage in Safari on iOS. -->
        <meta name="format-detection" content="telephone=no">

        <title>Random App</title>

        <!-- PWA Sources -->
        <link rel="manifest" href="/manifest.json">
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="{{ asset('/css/Linearicons-Free-v1.0.0.css')}}"/>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/releases/random/app.css')}}"/>

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token()]) !!};
        </script>

        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-48976816-6', 'auto');
            ga('send', 'pageview');
        </script>

    </head>
    <body>
        <div id="app"></div>

        <!-- Scripts -->
        <script src="{{url('')}}/releases/random/app.js"></script>
    </body>
</html>
