const common = {
    g_tk: 2381,
    loginUin:0,
    format: 'json',
    inCharset: 'utf8',
    outCharset: 'utf-8'
};
var playstatus = false
    ,Songdata = Array()
    ,ListIndex = -1
    ,PlayMuted = 0.3
    ,audio = ''
    ,radioId = ''
    ,vkey;
const localStorage = window.localStorage
if( !localStorage['PlayMuted'] ) {
    localStorage['PlayMuted'] = PlayMuted;
}
function jAudio() {
    if($('div').is('.jAudio--ui'))
    {
        if( !$('.dropdown-menu').is('.portal')) {
            let url = "/apiradio";
            let data = Object.assign({}, common, {
                channel: 'radio',
                platform: 'yqq.json'
            })
            let req = AjaxAudio( url, data, 'get' );
            req = req.responseJSON.data.data;
            req = req['groupList'][0]['radioList'];
            let html = ''
            for( let k in req)
            {
                let radioId = req[k].radioId
                if( k > 16 ){
                    break;
                }else if( radioId == 307 || radioId == 99 || radioId == 134  || radioId == 550 || radioId == 368 || radioId == 554){
                    continue;
                } else {
                    html += `<a class="dropdown-item radioId" data-href="`+ radioId +`">`+ req[k].radioName + `</a>`
                }
            }
            $('.jAudio-radio').html( html )

            if( Songdata.length > 0) {
                MainPanel();
                $('.aplayer-volume').height( PlayMuted * 100 + '%' );
                if( playstatus ) {
                    $('.jAudio_play').addClass('play-off').html('&#xe036;');
                    $('.round_icon').addClass('pause')
                    getlyric( Songdata[ListIndex].mid );
                }
                return ;
            }
            Fnew();
            $('.aplayer-volume').height(localStorage['PlayMuted'] * 100 + '%')
        }
    }
}

function AjaxAudio( url, Data, Method) {
    return $.ajax({
        async: false,
        url,
        type: Method,
        data:Data,
        dataType : "json",
        success: function ( req ) {
            if(req.code == 0)
            {
                return req;
            }
        }
    });
}

function Fnew( radioId = 134 ) {
    let url = 'https://u.y.qq.com/cgi-bin/musicu.fcg'
    let jsondata =  {
        "songlist":{
            "module":"pf.radiosvr",
            "method":"GetRadiosonglist",
            "param":{
                "id":radioId,
                "firstplay":0,
                "num":10
            }
        },
        "comm":{
            "ct":24,
            "cv":0
        }
    }
    let data = Object.assign({}, common, {
        '-': 'getradiosonglist9054570365850374',
        hostUin: 0,
        needNewCode: 0,
        format: 'json',
        notice: 0,
        platform: 'yqq.json',
        data: JSON.stringify( jsondata )
    })
    AjaxFnew( url, data, 'get' );
}

function AjaxFnew( url, Data, Method )
{
    return $.ajax({
        type: Method,
        url,
        dataType : "jsonp",
        jsonp : 'callback', //指定一个查询参数名称来覆盖默认的 jsonp 回调参数名 callback
        jsonpCallback: 'handleResponse', //设置回调函数名
        data: Data,
        success: function (req ) {
            if( req.code == 0 )
            {
                req = req.songlist.data
                _getvkey( req.track_list )
            }
        }
    })
}
function _getvkey( req ) {
    Songdata = [];
    if ( !localStorage['vkey'] ) {
        getvkey().then(() => {
            setSong( req )
        });
    } else {
        let vkeys = JSON.parse( localStorage['vkey']);
        if( new Date().getTime() - parseInt( vkeys.export) > 24 * 60 * 60 * 1000) {
            getvkey().then(() => {
                setSong( req )
            });
        } else {
            vkey = vkeys['vkey']
            setSong( req )
        }
    }
}
function setSong( req ) {
    for( let v in req ){
        Songdata.push({
            id: req[v].id,
            mid: req[v].mid,
            singer: Singer(req[v].singer),
            name: req[v].title,
            interval: req[v].interval,
            albumname: req[v].album.name,
            image: `https://y.gtimg.cn/music/photo_new/T002R300x300M000${req[v].album.mid}.jpg?max_age=2592000`,
            url:  `//183.131.60.16/amobile.music.tc.qq.com/M500${req[v].mid}.mp3?vkey=${vkey}&guid=1234567890&uin=1008611&fromtag=8`
        })
    }
    $('.round_icon').attr('src', Songdata[0]['image'] );
    $('.u-music-title>h2').text(Songdata[0]['name']);
    $('.u-music-title>small').text(Songdata[0]['singer']);
    $('.jAudio--time-total').text( seconds( Songdata[0]['interval'] ) );
    if( playstatus ) {
        ListIndex = -1;
        jAudioplay();
    }
}
function Singer( s ) {
    let r = []
    if( !s ) {
        return ''
    }
    s.forEach( (res) => {
        r.push( res.name)
    });
    return r.join(' / ')
}
$(document).on('click', '.radioId', function () {
    radioId = parseInt($.trim( $(this).attr('data-href') ));
    let req = Fnew( radioId );
})

$(document).on('click', '.jAudio_play', function () {
    if( playstatus ) {
        playstatus = false;
        $(this).html('&#xe039;').removeClass('play-off');
    } else {
        playstatus = true;
        $(this).html('&#xe036;').addClass('play-off');
    }
    if( audio.paused )
    {
        $('.round_icon').addClass('pause')
        audio.play();
        return false;
    }
    jAudioplay();

})

$(document).on('click', '.playnext', function () {
    nextMusic();
})

function nextMusic() {
    ListIndex ++;
    if( ListIndex >= Songdata.length) {
        if( radioId == false ) radioId = 134
        Fnew( radioId )
        ListIndex = -1;
    } else {
        MainPanel();
        if( playstatus ) {
            jAudioplay();
        }
    }
}

function MainPanel() {
    $('.round_icon').attr('src', Songdata[ListIndex]['image'] );
    $('.u-music-title>h2').text(Songdata[ListIndex]['name']);
    $('.u-music-title>small').text(Songdata[ListIndex]['singer']);
    $('.jAudio--time-total').text( seconds( Songdata[ListIndex]['interval']) );
}
function jAudioplay() {
    var curl = '';
    if( playstatus ) {
        if( ListIndex == -1 ) ListIndex ++;
        if( audio.paused == false)
        if( audio.length !== 0 ) {
            audio.src = '';
        }
        curl = Songdata[ListIndex]['url'];
        audio = new Audio(curl);
        audio.volume = localStorage['PlayMuted'];
        audio.play()
        audio.addEventListener('ended',nextMusic);
        getlyric(Songdata[ListIndex]['mid']);//更新歌词
        $('.round_icon').addClass('pause')
        setInterval(currentTime,1000);
    } else {
        $('.round_icon').removeClass('pause')
        if( audio.paused === false)  audio.pause();
    }
}

function currentTime() {
    var newTime = audio.currentTime;
    $('span.jAudio--time-elapsed').text( seconds( newTime ) );
    if( Songdata.length > 0 || ListIndex != -1 ) $('.jAudio--progress-bar-played').width((newTime / Songdata[ListIndex]['interval']) * 100 + '%')
    refreshLyric( newTime );
}
var lrcTime = [],
    lrcLine = [];
function getlyric( mid ) {
    let url = "/apilyric";
    let data = Object.assign({}, common, {
        songmid: mid,
    })
    let req = AjaxAudio( url, data, 'get' );
    req = req.responseJSON
    if( req.code == 0) {
        req = $.base64.atob( req.lyric, true )
        lrcTime = [],
        lrcLine = [];
        var l = req,
            s = l.split(/\n/),
            n = /\[(\d{2}):(\d{2})\.(\d{2})]/,
            r = /](.*)$/
        if( s.length <= 1 ) {
            c = r.exec(s[0]);
            lrcLine.push(c[1])
        } else {
            for (var o = 0; o < s.length; o++) {
                var d = n.exec(s[o])
                    , c = r.exec(s[o]);
                if( d && c ) {
                    if( c[1] ) {
                        lrcTime.push( 60 * parseInt(d[1]) + parseInt(d[2]) + parseInt(d[3]) / 100)
                        lrcLine.push(c[1])
                    }
                }
            }
        }

        $('.lyric').removeAttr('style').html();
        let str = '';
        for( let o = 0; o < lrcLine.length; o++ )
        {
            str += `<p data-no="${o}">${lrcLine[o]}</p>`
        }
        $('.lyric').html( str);
        
    }
}

function getvkey() {
    let uin = '1008611'
    let guid = '1234567890'
    let getVkeyUrl = `http://c.y.qq.com/base/fcgi-bin/fcg_music_express_mobile3.fcg?g_tk=0&loginUin=${uin}&hostUin=0&format=json&inCharset=utf8&outCharset=utf-8&notice=0&platform=yqq&needNewCode=0&cid=205361747&uin=${uin}&songmid=003a1tne1nSz1Y&filename=C400003a1tne1nSz1Y.m4a&guid=${guid}`
    return $.ajax({
        type: 'GET',
        url:getVkeyUrl,
        dataType : "jsonp",
        jsonp : 'callback', //指定一个查询参数名称来覆盖默认的 jsonp 回调参数名 callback
        jsonpCallback: 'handleResponse', //设置回调函数名
        success: function (req ) {
            if( req.code == 0){
                req = req.data.items[0]['vkey']
                let vkeys = {
                    export: new Date().getTime(),
                    vkey: req
                };
                vkey = req;
                localStorage['vkey'] = JSON.stringify(vkeys)
            }
        }
    })
}
function seconds(e) {
    e = e | 0
    const minute = e / 60 | 0
    const second = this._pad(e % 60)
    return `${minute}:${second}`
}
function _pad(num, n = 2) {
    let len = num.toString().length
    while (len < n) {
        num = '0' + num
        len++
    }
    return num
}
var p;
$(document).on('mousedown', '.jAudio--progress-bar-pointer', function () {
    p = $('.jAudio--progress-bar-wrapper')[0].clientWidth,
    document.addEventListener("mousemove", e)
    document.addEventListener("mouseup", a)
})
$(document).on('click', '.jAudio--progress-bar-wrapper', function () {
    p = $('.jAudio--progress-bar-wrapper')[0].clientWidth,
    e()
})

$(document).on('click', '.aplayer-volume-bar-wrap', function ( e) {
    let v = $('.aplayer-volume-bar')[0].clientHeight
    let a = e || window.event
        , t = (v - a.clientY + i( $('.aplayer-volume-bar')[0] ) ) / v;
        t = t > 0 ? t : 0,
        t = 1 > t ? t : 1

    PlayMuted = t;
    localStorage['PlayMuted'] = t;
    $('.aplayer-volume').height( t * 100 + '%');
    if( audio.length !== 0 ) {
        audio.volume = t;
    }
    $(this).show();
})
function i( e) {
    for (var a, t = e.offsetTop, i = e.offsetParent; null !== i; )
        t += i.offsetTop,
            i = i.offsetParent;
    return a = document.body.scrollTop + document.documentElement.scrollTop,
    t - a
}
function e( e ) {
    let a = e || window.event
        , i = (a.clientX - $('.jAudio--progress-bar').parent().offset().left ) / p;
    i = i > 0 ? i : 0,
    i = 1 > i ? i : 1
    $('.jAudio--progress-bar-played').width(i * 100 + '%');
    if( audio.length !== 0 ) {
        audio.currentTime = Songdata[ListIndex].interval * i;
    }
}
function a() {
    document.removeEventListener("mouseup", a),
    document.removeEventListener("mousemove", e)
}
$(document).on('click', '.jAudio_volume>i',function () {
    if( PlayMuted ) {
        $(this).html('&#xe04f;')
        PlayMuted = 0;
        audio.volume = PlayMuted;
    } else {
        $(this).html('&#xe050;')
        PlayMuted = localStorage['PlayMuted'];
        audio.volume = PlayMuted;
    }
})
var lrcIndex = 0
function refreshLyric( t ) {
    if(lrcLine === '') return false;
    t = t.toFixed(2);  // 时间取整
    var i = 0;
    for (var k in lrcTime) {
        if(lrcTime[k] >= t) break;
        i = k;      // 记录上一句的
    };
    $(".jAudio-lyric .on").removeClass("on");
    $('.jAudio-lyric p[data-no=' + i + ']').addClass('on');
    let outerHeight = $('.lyric p').outerHeight( true );
    $(".lyric").css({'transform':`translateY(-${outerHeight * i - outerHeight}px)`});
}