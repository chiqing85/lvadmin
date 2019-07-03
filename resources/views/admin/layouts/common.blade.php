<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ $cofig['title'] }}</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- style -->
    <link rel="stylesheet" href="/static/admin/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/static/admin/glyphicons/glyphicons.css" type="text/css" />
    {{--<link rel="stylesheet" href="/static/admin/font-awesome/css/font-awesome.min.css" type="text/css" />--}}
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<script src="http://demo.htmleaf.com/1706/201706241549/js/jquery.base64.js"></script>
<script src="/static/admin/js/radio/music.js"></script>
<!-- ajax -->
<script src="/static/admin/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="/static/admin/scripts/ajax.js"></script>
<!-- editor -->
<script src="/static/editor/editormd.js"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>

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

    $(document).on('click', '.file-users', function () {
        // if( $("input.file-upload").is('.users') ) url = '/admin/upload/thumb';
        layer.open({
            type: 2,
            title: '<i class="fa fa-crop"></i> 用户头像',
            area: ['870px', '600px'],
            fixed: true, //涓嶅浐瀹�
            content: '/static/admin/cropper/index.html'
        });
        return false;

    })

    $(document).on('change', "input.file-upload", ()=> {
        var formData = new FormData();
        formData.append('images', $("input.file-upload")[0].files[0]);
        let url = '';
        if( $("input.file-upload").is('.config') ) url = '/admin/upload/image';
        if( $("input.file-upload").is('.article') ) {
            url = '/admin/upload/thumb';
            formData.append('size', 750);
        }
        $.ajax({
            url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            // 鍛婅瘔jQuery涓嶈鍘诲鐞嗗彂閫佺殑鏁版嵁
            processData : false,
            // 鍛婅瘔jQuery涓嶈鍘昏缃瓹ontent-Type璇锋眰澶�
            contentType : false,
            success: function (v) {
                $('input.file_img').val( v );
                $('.upload_img').show().attr('src', v);
            }
        });
    })

    function keys( e ) {
        let k = $('input.keywords');
        let kt = $('input.keywords-tag');
        if( e.keyCode == 13 ) {
            e.preventDefault();
            let t = '<span class="tag accent"><span>' + k.val() + '&nbsp;&nbsp;</span><a href="javascript:;" title="Removing tag">x</a></span>';
            if( $('span.tag.accent').length < 3) {
                let ktv = kt.val() + k.val() + ',';
                kt.val( ktv );
            } else {
                if($('ul.parsley-errors-list').length < 1) {
                    k.addClass('parsley-error');
                    let it = '<ul class="parsley-errors-list filled" id="parsley-id-4"><li class="parsley-required">关键词最多添加 3 条…</li></ul>';
                    k.parent('.form-item-content').append( it );
                }
                t = '';
            }
            $('.keywords').val('');
            $('.form-item-content.tag').append( t );
        } else {
            if( k.is('.parsley-error') ) {
                k.removeClass('parsley-error');
                k.parent('.form-item-content').find('.parsley-errors-list.filled').remove();
            }
        }
    }

    $(document).on('click', 'span.tag.accent>a', function() {
        let t = $(this).siblings('span');
        let k = $('input.keywords-tag');
        let str = k.val().replace($.trim( t.text() ) + ',', "");
        k.val( str );
       $(this).parent('span.tag.accent').remove();
       let ik = $('input.keywords');
       if(  ik.is('.parsley-error')) {
           ik.removeClass('parsley-error');
           ik.parent('.form-item-content').find('.parsley-errors-list.filled').remove();
       }
    })

    $(document).on('click', '.edit', function () {
        let data = eval( "("+ $(this).attr('data-value') +")" );
        let url = $(this).attr('data-url');
        pj( data, url)
    })
    $(document).on('change', '.change',function () {
        let data = eval( "("+ $(this).attr('data-value') +")" );
        let url = $(this).attr('data-url');
        pj(data, url);
    })

    // 局部刷新
    function pj( data, url ) {
        $.ajax({
            url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data,
            success: function ( req ) {
                if(req.code == 403 ){
                    layer.msg( req.msg, { icon: 2, time: 1000 })
                    return false;
                }
                req = JSON.parse( req );
                if( req.code == 1 ) {
                    layer.msg( req.message,{ icon: 1, time: 1500}, (index) => {
                        layer.close(index);
                        $('#view').load(req.url+ ' #view' )
                    } );
                }else if(req.code == 403 ){
                    layer.msg( req.msg, { icon: 2, time: 1000 })
                } else {
                    layer.msg( req.message, { icon: 2, time: 1000 })
                }
            }
        });
    }
    
    //
    $(document).on('click', '#ACheck', function () {
        var flage = $(this).is(':checked');
        $('.checkbox_all').each(function () {
            $(this).prop('checked', flage);
        })
    })
    $(document).on('click', '.deletec', function () {
        let all = $('input.checkbox_all');
        let data = Array();
        all.each( function() {
            if($(this).is(':checked'))  data.push( $(this).val());
        });
        pj({ id : data }, $(this).attr('data-url'))
    })

    $(document).on('click', '.contacts', function () {
        let data = $('#contacts').serialize()
        let url = $('#contacts').attr('data-action')
        $.ajax({
            url,
            type: "POST",
            data,
            success: function ( req) {
                req = JSON.parse( req )
                if( req.code == 1)
                {
                    layer.msg( req.message, { icon: 1, time: 1500})
                    return false;
                }
            },
            error( req )
            {
                if( req.status == 422) {
                    req = req.responseJSON.errors;
                    for( let item in req )
                    {
                        for ( var i = 0; i < req[item].length; i++) {
                            layer.msg( req[item][i], { icon: 2, time: 1500})
                            return false;
                        }
                    }
                }
            }
        })
    })
    // 个人中心修改信息
    $(document).on('click','.penbtn', function () {
        let f_p = $(this).parents('.info_p');
        $(this).hide();
        f_p.find('.p_text').hide();
        f_p.find('input').show();
        f_p.find('.penbtns').show();
    })
    // 个人中心_保存信息
    $(document).on('click', '.penbtns', function () {
        let url = '/admin/account/update',
            inputs = $(this).parents('.info_p').find('input'),
            inputName = inputs.attr('name'),
            data = { name: inputName, value: inputs.val() };
        $.ajax({
            url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data,
            success:function ( data ) {
                if( data == 1)
                {
                    layer.msg( '保存成功…',{ icon: 1, time: 1500}, (index) => {
                        layer.close(index);
                        $('#view').load('/admin/account/infop' + ' #view' )
                    } );
                } else {
                    layer.msg( '失败…', { icon: 2, time: 1000 })
                }
            }
        })
    })

    //
    $(document).on('click', '.commentsCount', function () {
        $.get('/admin/notices/noticesall', function (data) {
            if( data.length ) {
                $('.list-group.list-group-gap').html('');
                let html = '';
                for( let i in data)
                {
                   let pull_img = data[i]['item_pic'] ? `<img src="${data[i]['item_pic']}" class="w-40 img-circle">` : `<span class="w-40 _400 rounded  blue  ">${data[i]['item']}</span>`;
                    html += `<li class="list-group-item lt box-shadow-z0 b dark-white"><span class="pull-left m-r">${pull_img}</span><span class="clear block notices">` +
                            `<a href="javascript:;" class="text-primary"> ${data[i]['name']} </a>${data[i]['content']}` +
                            `<br><small class="text-muted">${data[i]['created_at']}</small></span></li>`;
                }
                $('.list-group.list-group-gap').append( html );
            }
        })
    })

    // 接收通知
    var pusher = new Pusher("{{ env("PUSHER_APP_KEY") }}", {
        cluster: 'mt1',
        forceTLS: false,
        authEndpoint: '/admin/pusher_auth',
        auth: {
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }
    })
    var channel = pusher.subscribe('private-NewComment');
    channel.bind('App\\Events\\NewComments', function(data) {
        if($('span').is('.CCS')) {
            $('.CCS').text( JSON.stringify(data.count) );
        } else {
            $('.commentsCount').append(`<span class="label label-sm up warn CCS">${JSON.stringify(data.count)}</span>`);
        }
    });
</script>
</body>
</html>

