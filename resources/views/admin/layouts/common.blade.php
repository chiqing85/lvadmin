<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Flatkit - HTML Version | Bootstrap 4 Web App Kit with AngularJS</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- style -->
    <link rel="stylesheet" href="/static/admin/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/material-design-icons/material-design-icons.css" type="text/css" />

    <link rel="stylesheet" href="/static/admin/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <!-- build:css /static/admin/styles/app.min.css -->
    <link rel="stylesheet" href="/static/admin/styles/app.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="/static/admin/styles/font.css" type="text/css" />
</head>
<body>
<div class="app" id="app">
    @include('admin.layouts.aside')
    <div id="content" class="app-content box-shadow-z0" role="main">
        @include('admin.layouts.header')
        @include('admin.layouts.footer')
        <div ui-view class="app-body" id="view">
           @yield('content')
           @include('admin.layouts.error')
        </div>
    </div>
</div>
<!-- build:js /static/admin/scripts/app.html.js -->
<!-- jQuery -->
<script src="/static/admin/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="/static/admin/jquery/tether/dist/js/tether.min.js"></script>
<script src="/static/admin/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
<script src="/static/admin/jquery/underscore/underscore-min.js"></script>
<script src="/static/admin/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="/static/admin/jquery/PACE/pace.min.js"></script>
<script src="/static/layer/layer.js"></script>
<script src="/static/admin/scripts/config.lazyload.js"></script>

<script src="/static/admin/scripts/palette.js"></script>
<script src="/static/admin/scripts/ui-load.js"></script>
<script src="/static/admin/scripts/ui-jp.js"></script>
<script src="/static/admin/scripts/ui-include.js"></script>
<script src="/static/admin/scripts/ui-device.js"></script>
<script src="/static/admin/scripts/ui-form.js"></script>
<script src="/static/admin/scripts/ui-nav.js"></script>
<script src="/static/admin/scripts/ui-screenfull.js"></script>
<script src="/static/admin/scripts/ui-scroll-to.js"></script>
<script src="/static/admin/scripts/ui-toggle-class.js"></script>

<script src="/static/admin/scripts/app.js"></script>

<!-- ajax -->
<script src="/static/admin/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="/static/admin/scripts/ajax.js"></script>
<!-- endbuild -->
<script>
    $(document).on('click', '.aclass-open', function () {
        var oid = $(this).attr('oid');
        if($(this).text() == ' ') {
            $(this).text(' ');
            $('.pid_'+ oid).show();
        } else {
            $(this).text(' ');
            var open = $(".pid_"+oid + ' .aclass-open');

            var coid = open.attr('oid');
            if(open.text() == " ") {
                open.text(' ');
            }
            $('.pid_'+ coid).hide();
            $('.pid_'+ oid).hide();
        }
    });
</script>
</body>
</html>
