<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaze UI Admin index Examples</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="amaze/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="amaze/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="stylesheet" href="amaze/css/amazeui.min.css"/>
    <link rel="stylesheet" href="amaze/css/admin.css">
    <link rel="stylesheet" href="amaze/css/app.css">
</head>

<body data-type="index">


@include('layouts._head')
@include('layouts._left')
@yield('content')
<script src="amaze/js/jquery.min.js"></script>
<script src="amaze/js/amazeui.min.js"></script>
<script src="amaze/js/iscroll.js"></script>
<script src="amaze/js/app.js"></script>
</body>

</html>