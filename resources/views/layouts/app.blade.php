<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Extends -->
    <meta name="url"           content="@yield('url')" />
    <meta name="title"         content="@yield('title')" />
    <meta name="description"   content="@yield('description')" />
    <meta name="image"         content="@yield('image')" />

    <meta name="google-signin-client_id" content="524555026329-duc32e6en3f62mhdak03hi5scguviu9f.apps.googleusercontent.com">
    <!-- Icon -->
    <link href='<?php  ?>' rel='shortcut icon'>
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/img.css">
    <link rel="stylesheet" type="text/css" href="/css/thumb.css">
    <link rel="stylesheet" type="text/css" href="/css/threads.css">
    <link rel="stylesheet" type="text/css" href="/css/products.css">
    <link rel="stylesheet" type="text/css" href="/css/articles.css">
    <link rel="stylesheet" type="text/css" href="/css/headerFooter.css">
    @yield('css')
    <!-- Lib -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120528530-1"></script>
    <!-- Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="app">
        @include('layouts.navigation')
        <div id="body">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    @yield('js')
</body>
</html>
