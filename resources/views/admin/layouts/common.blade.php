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
    <!-- aside -->
    @include('admin.layouts.aside')

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
        <div class="app-header white box-shadow">
            <div class="navbar navbar-toggleable-sm flex-row align-items-center">
                <!-- Open side - Naviation on mobile -->
                <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
                    <i class="material-icons">&#xe5d2;</i>
                </a>
                <!-- / -->

                <!-- Page title - Bind to $state's title -->
                <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>

                <!-- navbar collapse -->
                <div class="collapse navbar-collapse" id="collapse">
                    <!-- link and dropdown -->
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href data-toggle="dropdown">
                            </a>
                            <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                        </li>
                    </ul>
                    <!-- / -->
                </div>
                <!-- / navbar collapse -->

                <!-- navbar right -->
                <ul class="nav navbar-nav ml-auto flex-row">
                    <li class="nav-item dropdown pos-stc-xs">
                        <a class="nav-link mr-2" href data-toggle="dropdown">
                            <i class="material-icons">&#xe7f5;</i>
                            <span class="label label-sm up warn">3</span>
                        </a>
                        <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="{{ \Auth::user()->pic }}" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                        </a>
                    </li>
                    <li class="nav-item hidden-md-up">
                        <a class="nav-link pl-2" data-toggle="collapse" data-target="#collapse">
                            <i class="material-icons">&#xe5d4;</i>
                        </a>
                    </li>
                </ul>
                <!-- / navbar right -->
            </div>
        </div>
        <div class="app-footer">
            <div class="p-2 text-xs">
                <div class="pull-right text-muted py-1">
                    &copy; Copyright <strong>Flatkit</strong> <span class="hidden-xs-down">- Built with Love v1.1.3</span>
                    <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
                </div>
                <div class="nav">
                    <a class="nav-link" href="../">About</a>
                    <a class="nav-link" href="http://themeforest.net/user/flatfull/portfolio?ref=flatfull">Get it</a>
                </div>
            </div>
        </div>
        <div ui-view class="app-body" id="view">
            <!-- ############ PAGE START-->
           @yield('content')
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
@yield('script')
</body>
</html>
