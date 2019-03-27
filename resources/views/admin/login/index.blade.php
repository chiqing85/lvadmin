
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
<body class="login-bg">
<div class="app" id="app">
    <div class="center-block w-xxl w-auto-xs p-y-md login">
        <div class="p-a-md box-color r box-shadow-z1 text-color m-a ">
            <div class="m-b text-sm text-center">
                <h5>后台登录</h5>
            </div>
            <form name="form" method="post" action="/login">
                {{ csrf_field() }}
                <div class="md-form-group float-label">
                    <input type="text" class="md-input" name="user" required>
                    <label>用户名：</label>
                </div>
                <div class="md-form-group float-label">
                    <input type="password" class="md-input" name="password" required>
                    <label>密码：</label>
                </div>
                <div class="md-form-group float-label" style="display: flex;">
                    <div>
                        <input type="text" class="md-input" name="captcha" required>
                        <label>验证码：</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{captcha_src('flat')}}" style="cursor: pointer" onclick="this.src='{{captcha_src('flat')}}'+Math.random()">
                    </div>
                </div>
                <div class="m-b-md">
                    <label class="md-check">
                        <input type="checkbox" value="1" name="is_remember"><i class="primary"></i> 记住密码
                    </label>
                </div>
                <button type="submit" class="btn primary btn-block p-x-md">登 录</button>
            </form>
        </div>

        <div class="p-v-lg text-center">
            <div> <a href="/" class="text-primary _600">清蝎子</a> © 2015 - 2019版权所有</div>
        </div>
    </div>
    @if(count($errors) > 0)
        <div class="alert alert-danger login animated slideInUp">
        @foreach($errors->all() as $v)
            <li> {{ $v }}</li>
        @endforeach
        </div>
    @endif

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
</body>
</html>