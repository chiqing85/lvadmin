$(window).on("load", function() {
    var b = $(".preloader");
    var a = $(".lines-grid");
    b.find(".spinner").fadeOut(function() {
        b.fadeOut();
        a.addClass("loaded")
    })
});
$(function() {
    var f = $(window).width();
    var b = $(window).height();
    $(".typed-title").typed({
        stringsElement: $(".typing-title"),
        backDelay: 5000,
        typeSpeed: 0,
        loop: true
    });
    $(".header").on("click", ".menu-btn", function() {
        if ($(".header").hasClass("opened")) {
            $(".header").removeClass("opened")
        } else {
            $(".header").addClass("opened")
        }
    });
    if ($("#home-card").length) {
        $(".top-menu").on("click", "a", function() {
            var j = $(".lines-grid");
            var i = $(this).attr("href");
            var h = $(".card-inner");
            var g = $(i);
            var l = $(".top-menu li");
            var k = $(this).closest("li");
            var u = $(this).attr('data-url');
            if (!k.hasClass("active") & $("#home-card").length) {
                l.removeClass("active");
                j.removeClass("loaded");
                k.addClass("active");
                setTimeout(function() {
                    j.addClass("loaded");
                    $(h).removeClass("active");
                    $(g).addClass("active");
                    if( u )  {
                        card( '/' + u );
                    }

                }, 1000)
            }
            return false
        })
    }

    $(document).on('click', 'a.contents', function() {
        var j = $(".lines-grid");
        var h = $(".card-inner");
        var l = $(".top-menu li");
        var k = $(this).closest("li");
        var u = $(this).attr('data-url');
        if (!k.hasClass("active") & $("#home-card").length) {
            l.removeClass("active");
            j.removeClass("loaded");
            k.addClass("active");
            setTimeout(function() {
                j.addClass("loaded");
                $(h).removeClass("active");
                if( u ) {
                    $('#card').load( u + ' .card-container',function () {
                        view();
                    }).addClass('active');
                };
            }, 1000)
        }
        return false
    })
    if ($("#video-bg").length) {
        var c = $("#video-bg").YTPlayer()
    }
    var a = $(".grid-items");
    a.imagesLoaded(function() {
        a.multipleFilterMasonry({
            itemSelector: ".grid-item",
            filtersGroupSelector: ".filter-button-group",
            percentPosition: true,
            gutter: 0
        })
    });
    $(".filter-button-group").on("change", 'input[type="radio"]', function() {
        if ($(this).is(":checked")) {
            $(".f_btn").removeClass("active");
            $(this).closest(".f_btn").addClass("active")
        }
        $(".has-popup-image").magnificPopup({
            type: "image",
            closeOnContentClick: true,
            mainClass: "popup-box",
            image: {
                verticalFit: true
            }
        });
        $(".has-popup-video").magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 0,
            mainClass: "popup-box"
        });
        $(".has-popup-music").magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 0,
            mainClass: "popup-box"
        });
        $(".has-popup-media").magnificPopup({
            type: "inline",
            overflowY: "auto",
            closeBtnInside: true,
            mainClass: "popup-box-inline"
        })
    });
    $(".has-popup-image").magnificPopup({
        type: "image",
        closeOnContentClick: true,
        mainClass: "popup-box",
        image: {
            verticalFit: true
        }
    });
    $(".has-popup-video").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        disableOn: 0,
        mainClass: "popup-box"
    });
    $(".has-popup-music").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        disableOn: 0,
        mainClass: "popup-box"
    });
    $(".has-popup-media").magnificPopup({
        type: "inline",
        overflowY: "auto",
        closeBtnInside: true,
        mainClass: "popup-box-inline",
        callbacks: {
            open: function() {
                $(".popup-box-inline .popup-box").slimScroll({
                    height: b + "px"
                })
            }
        }
    });
    $("#cform").validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true
            },
            message: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == "") {
                        return true
                    } else {
                        return false
                    }
                }
            }
        },
        success: "valid",
        submitHandler: function() {
            $.ajax({
                url: "mailer/feedback.php",
                type: "post",
                dataType: "json",
                data: "name=" + $("#cform").find('input[name="name"]').val() + "&email=" + $("#cform").find('input[name="email"]').val() + "&message=" + $("#cform").find('textarea[name="message"]').val(),
                beforeSend: function() {},
                complete: function() {},
                success: function(g) {
                    $("#cform").fadeOut();
                    $(".alert-success").delay(1000).fadeIn()
                }
            })
        }
    });
    $("#comment_form").validate({
        rules: {
            name: {
                required: true
            },
            message: {
                required: true
            }
        },
        success: "valid",
        submitHandler: function() {}
    });
    if ($("#map").length) {
        initMap()
    }
    if (($(".blogs-content").height() > $(".blogs-sidebar").height()) && (f > 1023)) {
        $(".blogs-sidebar").css({
            "min-height": $(".blogs-content").height()
        })
    }
    if (($(".blogs-content").height() < $(".blogs-sidebar").height()) && (f > 1023)) {
        $(".blogs-content").css({
            "min-height": $(".blogs-sidebar").height()
        })
    }
    $(window).resize(function() {
        var g = $(window).width();
        if (($(".blogs-content").height() > $(".blogs-sidebar").height()) && (g > 1023)) {
            $(".blogs-sidebar").css({
                "min-height": $(".blogs-content").height()
            })
        }
        if (($(".blogs-content").height() < $(".blogs-sidebar").height()) && (g > 1023)) {
            $(".blogs-content").css({
                "min-height": $(".blogs-sidebar").height()
            })
        }
    });
    $(".top-menu").on("click", "a", function() {
        if (!$("#home-card").length) {
            location.href = "/" + $(this).attr("href")
        }
        return false
    });
    var e = location.hash;
    var d = $(e);
    if (e.indexOf("#") == 0 && e.indexOf("-card") != -1 && d.length) {
        $(".top-menu li").removeClass("active");
        $('.top-menu a[href="' + e + '"]').parent().addClass("active");
        $(".lines-grid").removeClass("loaded");
        $(".card-inner").removeClass("active");
        $(e).addClass("active")
    }
    function view() {
        if($('#testeditormdview')) {
            editormd.markdownToHTML("testeditormdview",
                {
                    htmlDecode: "style,script,iframe", //可以过滤标签解码
                    emoji: true,
                    taskList: true,
                    tex: true,               // 默认不解析
                    flowChart: true,         // 默认不解析
                    sequenceDiagram: true, // 默认不解析
                    codeFold: true
                });
        }
        return false
    }
    view();
    function  card ( url ) {
        $('#card').load(url + ' .card-container').addClass('active');
        if( url == '/archives') {
            archives();
        }
    }
    $(document).on('click', '.article_button', function () {
        let form = $('#cform');
        if( ! $( 'textarea').val())
        {
            $( 'textarea').addClass('error');
            return false;
        }
        $.ajax({
            url: form.attr('data-action'),
            data:  form.serialize(),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function ( req ) {
                req = JSON.parse( req );
                if( req.code == 0 ) {
                    layer.msg( req.message, { icon: 2, time: 1500 })
                } else if( req.code == 1 ) {
                    layer.msg( req.message, { icon: 1, time: 1500}, ()=> {
                        let articleid = $("input[name=articleid]").val();
                        let pn = '';
                        if( $( "input[name=parentid]").val() ) {
                            let page =  $.trim( $('.pagination>.active>span').text() ) ;
                            if( page ) {
                                pn = '?page=' + page;
                            }
                        }
                        $('.comment_item').load( '/article/' + articleid +  pn + ' .comment_item>div');
                    })
                }
            },
            error:function ( req ) {
                if(req.status == 422 )
                {
                    let json=JSON.parse(req.responseText);
                    json = json.errors;
                    for ( var item in json) {
                        for ( var i = 0; i < json[item].length; i++) {
                            layer.msg( json[item][i], { icon: 2, time: 2000})
                            return false;
                        }
                    }
                }
            }
        } )
    })
    $(document).on("input propertychange",".error",function( ){
        if( $( 'textarea').val()) {
            $( 'textarea').removeClass('error');
        }
    });

    $(document).on('keydown', 'form#cform textarea', function (e) {
        if( e.keyCode == 8 ){
            setTimeout(function () {
                if( $( 'textarea').val().length < 1 )
                {
                    if( $('input').is('.comentsharecid') )
                    {
                        $('.comentsharecid, .comparent').remove();
                    }
                }
            }, 100 )
        }
    });

    $(document).on('click', '.commentshare', function () {
        let id = $(this).attr('data-id');
        let parentid = $(this).closest('.parent').attr('data-parent');
        let username = $.trim( $(this).closest('.resume-item').find('.name:first').text() );
        let html = '<input type="hidden" name="pid" value="' + id + '" class="comentsharecid">' +
                   '<input type="hidden" name="parentid" value="' + parentid + '" class="comparent">';
        if( $('input').is('.comentsharecid')) {
            $('.comentsharecid,.comparent').remove();
        }
        $('#cform>.align-right').append( html );
        $('textarea[name=contents]').val('@' +  username + ' ').focus();
    })

    $(document).on('click', '.commentlzl a.page-link', function () {
        $(this).closest('.lzl').load( $(this).attr('href') + ' .lzl>div');
        return false
    })

    $(document).on('click','.comment a.page-link', function(){
        $('.comment_item').load( $(this).attr('href') + ' .comment_item>div');
        return false
    })

    $(document).on('click', '.links a.page-link', function () {
        $('#card').load( $(this).attr('href') + ' .card-container').addClass('active');
        return false
    })
    $('.lines-grid .row .col .lines').width( 0 );
    
    function archives() {
        /*if(!$(".history").length){
            return false;
        }*/
        var $warpEle = $(".history-date"),
            $targetA = $warpEle.find("h2 a,ul li dl dt a"),
            parentH,
            eleTop = [];

        parentH = $warpEle.parent().height();
        $warpEle.parent().css({"height":59});

        setTimeout(function(){

            $warpEle.find("ul").children(":not('h2:first')").each(function(idx){
                eleTop.push($(this).position().top);
                $(this).css({"margin-top":-eleTop[idx]}).children().hide();
            }).animate({"margin-top":0}, 1600).children().fadeIn();

            $warpEle.parent().animate({"height":parentH}, 2600);

            $warpEle.find("ul").children(":not('h2:first')").addClass("bounceInDown").css({"-webkit-animation-duration":"2s","-webkit-animation-delay":"0","-webkit-animation-timing-function":"ease","-webkit-animation-fill-mode":"both"}).end().children("h2").css({"position":"relative"});

        }, 600);
        $(document).on('click', 'a.nogo', function () {
            $(this).parent().css({"position":"relative"});
            $(this).parent().siblings().slideToggle();
            $warpEle.parent().removeAttr("style");
            return false;
        });
    }


});