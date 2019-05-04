<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="vCard & Resume Template" />
    <meta name="keywords" content="vcard, resposnive, resume, personal, card, cv, cards, portfolio" />
    <meta name="author" content="beshleyua" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--		Load CSS	-->
    <link rel="stylesheet" href="/static/home/css/basic.css" />
    <link rel="stylesheet" href="/static/home/css/layout.css" />
    <link rel="stylesheet" href="/static/home/css/blogs.css" />
    <link rel="stylesheet" href="/static/home/css/line-awesome.css" />
    <link rel="stylesheet" href="/static/home/css/magnific-popup.css" />
    <link rel="stylesheet" href="/static/home/css/animate.css" />
    <link rel="stylesheet" href="/static/home/css/simplebar.css" />
    <!-- theme colors -->
    <link rel="stylesheet" href="/static/home/css/green.css" />
    <!--<link rel="stylesheet" href="/static/home/css/blue.css" />-->
    <!--<link rel="stylesheet" href="/static/home/css/red.css" />-->
    <!--<link rel="stylesheet" href="/static/home/css/orange.css" />-->
    <!--<link rel="stylesheet" href="/static/home/css/pink.css" />-->
    <!--<link rel="stylesheet" href="/static/home/css/purple.css" />-->
    <!--[if lt IE 9]>
    <script src="/static/home/js/css3-mediaqueries.js"></script>
    <script src="/static/home/js/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="page">
    @include('home.layouts.header')
    <div class="container">
        <div class="card-inner card-started active" id="home-card">
            @yield('indexs')
        </div>
    </div>
</div>
<div class="card-inner" id="card">
    @yield('contents')
</div>
@include('home.layouts.lines')
<script src="/static/home/js/jquery.min.js"></script>
<script src="/static/home/js/jquery.validate.js"></script>
<script src="/static/home/js/jquery.magnific-popup.js"></script>
<script src="/static/home/js/imagesloaded.pkgd.js"></script>
<script src="/static/home/js/masonry.pkgd.js"></script>
<script src="/static/home/js/masonry-filter.js"></script>
<script src="/static/home/js/simplebar.js"></script>
<script src="/static/home/js/typed.js"></script>
<!--		Main Scripts	-->
<script src="/static/editor/editormd.min.js"></script>
<script src="/static/editor/lib/marked.min.js"></script>
<script src="/static/editor/lib/prettify.min.js"></script>
<script src="/static/editor/lib/raphael.min.js"></script>
<script src="/static/editor/lib/underscore.min.js"></script>
<script src="/static/editor/lib/sequence-diagram.min.js"></script>
<script src="/static/editor/lib/flowchart.min.js"></script>
<script src="/static/editor/lib/jquery.flowchart.min.js"></script>

<script src="/static/home/js/scripts.js"></script>
</body>
</html>