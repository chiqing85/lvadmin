var media = [],
	playId,
	list = [];
//加载音频文件
var AduodList = (function () {
	return function (id, uid){
		if (!id) return false;
		$.ajax({
			type: mkPlayer.method, 
	        url: mkPlayer.api, 
	        data: "types=playlist&id=" + id,
	        dataType : "jsonp",
	        success: function(jsonData){
	        	if(jsonData.playlist.tracks.length == false) {
	        		$('.list-item').remove();
	        		addListbar('nodata');
	        		return false;
	        	}
	        	if(typeof jsonData.playlist.tracks !== undefined || jsonData.playlist.tracks.length !== 0) {
	        		tempItem(jsonData, uid);
	        	};
	        },
	        error: function(text) {
	            console.log(text.code);
	        }
		});
	};
})();
// 初始化加载音频文件
AduodList(List[mkPlayer.defaultlist].id,mkPlayer.defaultlist);
//初始化进度条
var MainPanel = function (){
	//音量进度条
	var volume = playerReaddata('volume');
	volume!= null ? volume : volume = mkPlayer.volume;
	if (volume == 0) $('.glyphicon-volume-up').addClass('glyphicon-volume-off').removeClass('glyphicon-volume-up');
    $('.volume .mkpgb-dot').css('left',volume * 100 + '%');
    $('.volume .mkpgb-cur').width(volume * 100 + '%');
	mkpgb(newVal);
	function newVal(a, e){
		if(a == true){
			if(e == 0) {
				$('.muted').addClass('glyphicon-volume-off').removeClass('glyphicon-volume-up');
			}	else {
				$('.muted').addClass('glyphicon-volume-up').removeClass('glyphicon-volume-off');
			};
			media.volume = e;
			playerSavedata('volume', e);	//存储音量
		}else{
			if(media.length !== 0){
				media.currentTime = media.duration * e;	//播放拖动
			};
		};
	};
};
MainPanel();
//进度条拖动
function mkpgb(callback) {
	var statu = false;
	var locked = false;
	$('.mkpgb-dot').mousedown(function (e) {
		if(!locked) statu = true;
		th = $(this);
		min = th.parent().offset().left;
		max = th.parent().width() + min;
		barMove(e);
	});
	$('html').mousemove(function (e) {
		barMove(e);
	});
    $('html').mouseup(function(e){
        statu = false;
    });
	function barMove(e){
		if(!statu) return;
		var left = 0;
		if(e.clientX < min) {
			left = 0; 
		}else if (e.clientX > max) {
			left = 1;
		}else {
			left = (e.clientX - min) / (max - min);
		};
		th.parent().find('.mkpgb-dot').css("left", (left * 100) +"%");
		th.parent().find('.mkpgb-cur').width(left * 100 + '%');
		if(th.parent('.volume').length !== 0){
			callback(true, left);
		}else {
			callback(false, left);
		};
	};
};
//初始化音频
function play(e){
	e < 0 ? e = 0 : e;
	var item = List[0].item[0][e];
	music(item.musicId,callback);
	var musicName = item.musicName;
	var artistsName = item.artistsName;
	wrapper(musicName + ' - ' + artistsName);  //进度条上方信息
	changeCover(item.albumPic);	//更新封面
	playId = item.musicId;
	list = e;
	addHis(item);  // 添加到播放历史
};
// 下一首歌
$('.btn-next').click(function(){
	nextMusic();
});
//上一首
$('.btn-prev').click(function(){
	prev();
});
//播放暂停
$(".btn-playvolume").click(function(){
    pause();
});
//播放暂停
function pause() {
	if(media.paused === false) {
		media.pause();
		$('.glyphicon-pause').addClass("glyphicon-play").removeClass('glyphicon-pause');
		$('.ric-info img').css('webkit-animation-play-state','paused');
	} else {
		//第一次播放
		if(list.length !== undefined) {
			play(0);
		} else {
			$('.glyphicon-play').addClass("glyphicon-pause").removeClass('glyphicon-play');
			$('.ric-info img').css('webkit-animation-play-state','inherit');
			media.play();
		};
	};
};
//静音样式
$('.muted').live('click',function(){
	if($(this).is('.glyphicon-volume-up')){
		media.volume = 0;
		if (media.volume == 0) $(this).addClass('glyphicon-volume-off').removeClass('glyphicon-volume-up');
	}else{
		media.volume = playerReaddata('volume');
		$(this).addClass('glyphicon-volume-up').removeClass('glyphicon-volume-off');
	};
});

function ended() {
	var item = List[0].item[0];
	if(media.ended && list < item.length) {
		$('.btn-next').trigger('click');
	};
	$('.glyphicon-play').addClass("glyphicon-pause").removeClass('glyphicon-play');
	$('.ric-info img').css('webkit-animation-play-state','inherit');
	sint=setInterval(currentTime,1000);
	media.play();
};
//上一首
function prev () {
	if(list.length !== undefined) {
		play(0);
	} else {
		$(".list-playing").removeClass("list-playing");
		$('.list-item').eq(list-1).find('.list-num').addClass('list-playing');
		play(list-1);
	};
	return false;
};
//下一首
function nextMusic () {
	$(".list-playing").removeClass("list-playing");
	$('.list-item').eq(list+1).find('.list-num').addClass('list-playing');
	play(list+1);
};
//播放准备工作
function callback(e){
	var e =e.replace("https", 'http');
	media.src = '';//移除audio
	media = new Audio(e);
	lyric(playId, lyricCallback);//更新歌词
	playerReaddata('volume') == null ? media.volume = mkPlayer.volume : media.volume =playerReaddata('volume'); //音量	
	media.addEventListener('ended', nextMusic);   // 播放结束
	ended();
	window.setTimeout("delayCheck()", 5000);
};
// 歌曲播放超时检测
function delayCheck() {
    if(isNaN(media.duration) || media.duration === undefined || media.duration ===0) {
        eroor('播放失败，自动播放下一曲');
        nextMusic();
    } else {
        // 调试信息输出
        if(mkPlayer.debug) {
            console.log('超时检测 - 歌曲播放正常');
        };
    };
};
//进度条上方信息
var wrapper =function (e) {
	$('.title-wrapper').text(e);
	str = '正在播放 '+e+'…';
	DocTitle(str);
	setInterval("DocTitle()",2000);
};
//标题跑马
function DocTitle() {
	str = str.substr(1)+str.charAt(0);
    document.title = str;
};
//更新封面
var changeCover = function (e) {
	if (!e) e = "https://y.gtimg.cn/mediastyle/yqq/extra/player_cover.png?max_age=31536000";
	//背景
	$('.bg_player').css('background-image','url('+e+')');
	//右侧
	$("#change").attr("src", e+"?param=186x186");
	//正在播放
	e = e + "?param=40x40";
	$(".sheet-playing img").attr('src',e);
	 // $(".sheet-item[data-no='1'] .sheet-cover").attr('src', e);
};
// 媒体文件时间
function currentTime(){
	var newTime = media.currentTime;
	refreshLyric (newTime);
	if(media.duration) {
		var Cu = secondsToTime(media.currentTime);
		var Du = secondsToTime(media.duration);
		$('.player-time').text(Cu +' / ' + Du);
	};
	var locked = newTime/media.duration * 100;
	$('.mkpgb-locked>.mkpgb-cur').width(locked + '%');
	$('.mkpgb-locked>.mkpgb-dot').css('left', locked + '%');
};
//菜单选项
$('.sheet-item').live('click',function(){
	var data=$(this).attr('data-no');
	var th = $(this);
	if(data == 1) {
		 playing(th);
		$('.list-head').html('');
		addListhead();
		var his = playerReaddata("his");
		var no = 0;
		for(var i =0; i < his.length; i++){
			no++;
			addItem(no, his[i].musicName, his[i].artistsName, his[i].albumName);
		};
		return false;
	} else if(data == 0) {
		 playing(th);
		$('.list-head').html('');
		addListhead();
		for(var i = 0; i< List[data].item[0].length; i++) {
			addItem(i+1, List[data].item[0][i].musicName, List[data].item[0][i].artistsName, List[data].item[0][i].albumName);
		};
		List[0].item[0].push(List[data].item);
	}else{
		AduodList(List[data].id, data);
	};
});
function playing(th){
	$('.sheet-playing img').attr('src','http://y.gtimg.cn/mediastyle/yqq/extra/player_cover.png?max_age=31536000');
	$(".sheet-playing").removeClass("sheet-playing");
	th.addClass("sheet-playing");
};
//搜索歌曲
//歌单读取失败 - 200
function eroor(a){
	var html = '<div class="eroor" style = "-webkit-transform: translatey(-250px);transform: translatey(-250px);opacity: 0;">' + a + '</div>';
	$('body').append(html).attr('style',"");
	setTimeout("$('.eroor').remove()",1500);
	return false;
};
//搜索回车
$(".sug-input").keydown(function(event){ 
    if(event.keyCode == 13){ 
        $(".glyphicon-search").click(); 
    };
});
// 搜索
$(".glyphicon-search").click(function(){
    var wd = $(".sug-input").val();
    if(!wd) {
        eroor('搜索内容不能为空');
        return false;
    };
    search(wd);
});
// 要搜索的字符
function search(str) {
    media.loadPage = 1;   // 已加载页数复位
    media.wd = str;
    ajaxSearch();
};
// ajax加载搜索结果
function ajaxSearch() {
    if(list.loadPage == 1) { // 弹出搜索提示
        var tmpLoading = eroor('搜索中');
    };
    if(media.wd == undefined) return false;
    $.ajax({
        type: mkPlayer.method,
        url: mkPlayer.api, 
        data: "types=search&count=" + mkPlayer.loadcount + "&pages=" + media.loadPage + "&name=" + media.wd,
        dataType : "jsonp",
        complete: function(XMLHttpRequest, textStatus) {
            if(tmpLoading) layer.close(tmpLoading);    // 关闭加载中动画
        },  // complete
        success: function(jsonData){            
            if(jsonData.result === undefined || jsonData.result.songCount === undefined || jsonData.result.songCount == "0"){
                eroor('没有找到相关歌曲');
		        return false;
            };
            // 调试信息输出
            if(mkPlayer.debug) {
                console.log("搜索结果获取成功");
            };
            
            if(media.loadPage == 1) {   // 加载第一页，清空列表
                List[0].item = [];		
                $('.list-head').html('');   // 清空列表中原有的元素
                addListhead();      // 加载列表头
            } else {
                $("#list-foot").remove();     //已经是加载后面的页码了，删除之前的“加载更多”提示
            };
            if(typeof jsonData.result.songs === undefined || typeof jsonData.result.songs == "undefined") {
                addListbar("nomore");  // 加载完了
                return false;
            };
            //存储歌单
            var no = List[0].item.length;
            var tempItem = {
            	item: []
            };
            for ( var i = 0; i < jsonData.result.songs.length; i++) {
            	no++;
            	tempItem.item[i] =  {
            		musicName: jsonData.result.songs[i].name,  // 音乐名字
		            artistsName: jsonData.result.songs[i].ar[0].name, // 艺术家名字
		            albumName: jsonData.result.songs[i].al.name,    // 专辑名字
		            albumPic: jsonData.result.songs[i].al.picUrl,    // 专辑图片
		            musicId: jsonData.result.songs[i].id,  // 网易云音乐ID
		            mp3Url: null // mp3链接
            	};
            	List[0].item.push(tempItem.item);
            	addItem(no, tempItem.item[i].musicName, tempItem.item[i].artistsName, tempItem.item[i].albumName);

            };
            media.dislist = 1;    // 当前显示的是搜索列表
            media.loadPage ++;    // 已加载的列数+1
            if (no < mkPlayer.loadcount) {
                addListbar("nomore");  // 没加载满，说明已经加载完了
            } else {
                addListbar("more");     // 还可以点击加载更多
            };
        },   //success
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            layer.msg('搜索结果获取失败 - ' + XMLHttpRequest.status);
        }
    });
};
// 加载列表中的提示条
// 参数：类型（more、nomore、loading、nodata、clear）
function addListbar(types) {
    var html;
    switch(types) {
        case "more":    // 还可以加载更多
            html = '<li class="list-item text-center list-loadmore list-clickable" title="点击加载更多数据" id="list-foot">点击加载更多...</li>';
        break;
        
        case "nomore":  // 数据加载完了
            html = '<li class="list-item text-center" id="list-foot">全都加载完了</li>';
        break;
        
        case "loading": // 加载中
            html = '<li class="list-item text-center" id="list-foot">播放列表加载中...</li>';
        break;
        
        case "nodata":  // 列表中没有内容
            html = '<li class="list-item text-center" id="list-foot">列表里面什么也没有……</li>';
        break;
        
        case "clear":   // 清空列表
            html = '<li class="list-item text-center list-clickable" id="list-foot" onclick="clearDislist();">清空列表</li>';
        break;
    };
   $('.list-head').append(html);
};
// 点击加载更多
$(".list-loadmore").live("click", function() {
    $(".list-loadmore").removeClass('list-loadmore');
    $(".list-loadmore").html('加载中...');
    ajaxSearch();
});
//将加载的数据加入到数组中
function tempItem(e, id){
    // 存储歌单信息
	var tempList = {
        id: e.playlist.id,    // 列表的网易云 id
        name: e.playlist.name,   // 列表名字
        cover: e.playlist.coverImgUrl,   // 列表封面
        creatorName: e.playlist.creator.nickname,   // 列表创建者名字
        creatorAvatar: e.playlist.creator.avatarUrl,   // 列表创建者头像
        item: []
    };
    List[0].item = [];
	$('.list-head').html('');
	addListhead();
	var userList = [],no = List[0].item.length;
	for(var i = 0; i < e.playlist.tracks.length; i++){
		no ++;
        tempList.item[i] =  {
            musicName: e.playlist.tracks[i].name,  // 音乐名字
            artistsName: e.playlist.tracks[i].ar[0].name, // 艺术家名字
            albumName: e.playlist.tracks[i].al.name,    // 专辑名字
            albumPic: e.playlist.tracks[i].al.picUrl,    // 专辑图片
            musicId: e.playlist.tracks[i].id,  // 网易云音乐ID
            mv: e.playlist.tracks[i].mv,
            mp3Url: null // mp3链接
        };
        addItem(no, tempList.item[i].musicName, tempList.item[i].artistsName, tempList.item[i].albumName,tempList.item[i].mv);
	};
	List[0].item.push(tempList.item);
	List[id] = tempList;
};
// 列表鼠标移过显示对应的操作按钮
// $(document).on('mousemove', ".list-item",
$(".list-item").live('mousemove', function() {
    var num = $(this).attr('data-no');
    if (isNaN(num)) return false;
    // 还没有追加菜单则加上菜单
    if(!$(this).data("loadmenu")) {
        var target = $(this).find(".music-name");
        var html = '<span class="music-name-cult">' + 
        target.html() + 
        '</span>' +
        '<div class="list-menu" data-no="' + num + '">' +
            '<span class="list-icon icon-play" data-function="play" title="点击播放这首歌"></span>' +
            '<span class="list-icon icon-download" data-function="download" title="下载歌曲"></span>' +
        '</div>';
        target.html(html);
        $(this).data("loadmenu", true);
    };
});
//列表中的菜单点击
$('span.list-icon').live('click',function(){
	var num = parseInt($(this).parent().attr('data-no'));
    if (isNaN(num)) return false;
    switch($(this).attr("data-function")) {
        case "play":    // 播放
            $(".list-playing").removeClass("list-playing"); 
            $(this).closest('.list-item').find('.list-num').addClass('list-playing');
            play(num);
        break;
        case "download":    // 下载
            // music(List[0].item[0][num].musicId, download);
        break;
        case "share":   // 分享
            // ajax 请求数据
            ajaxUrl(musicList[rem.dislist].item[num], ajaxShare);
        break;
    };
    return true;
});
//下载歌曲
// function download(music) {
    // var tmpUrl = mkPlayer.api + "?types=download&url=" + music + "&name=" + urlEncode(List[0].item[0][0].musicName) + "%20-%20" + urlEncode(List[0].item[0][0].artistsName);
    // window.open(tmpUrl);
   	// var tmpUrl = ('id =' + urlEncode(5439031) + urlEncode('凉凉') +'/' +urlEncode(24984908) + '/'+ urlEncode(205000) + '/' + urlEncode("杨宗纬") +'/' +urlEncode('充满坎坷的惊世之爱'));
   	// console.log(tmpUrl);
// }
// url编码
// 输入参数：待编码的字符串
function urlEncode(String) {
    return encodeURIComponent(String).replace(/'/g,"%27").replace(/"/g,"%22");
}
//如果大家喜欢看书，可以来本网站，1w本小说，心情体验阅读乐趣！
console.log('麒麟阁·休闲音乐\n好听的音乐，就来(http://music.qilinge.la).\n音乐资源，来自网易云音乐(http://music.163.com).\n万本小说，等你来读，麒麟阁 %cwww.qilinge.la.',"color:red");
//加载列头
function addListhead(){
	var html	='<li>'+
			'	<span class="list-num"></span>'+
			'	<span class="music-album">专辑</span>'+
			'	<span class="auth-name">歌手</span>'+
			'	<span class="music-name">歌曲</span>'+
			'</li>';
	 $('.list-head').append(html);
};
//加载播放列表
function addItem(no, name, auth, album, mv) {
	// var mvid = '';
	// if(mv > 0) mvid = '<span class="glyphicon glyphicon-hd-video" data-no=' + mv +'></span>';
    var html ='<li class="list-item" data-no="'+(no-1) +'">'+
    '   <span class="list-num">' + no + '</span>' +
    '   <span class="music-album">' + album + '</span>' +
    '    <span class="auth-name">' + auth + '</span>' +
    '   <span class="music-name">' + name  + '</span>' +
    '</li>'; 
   $('.list-head').append(html);
};
//播放mv
$('.glyphicon-hd-video').live('click', function(){
	var MVID = $(this).attr('data-no');
	MV(MVID,mvplay);

});
function mvplay(e){
	$("body").append('<video src="' + e + '"  width="320" height="240" controls="controls"></video>');
	// $('html').append('<video controls autoplay name="media"><source src="http://58.220.74.80/v4.music.126.net/20170712235600/115d1577f617060c314e7e32c9b32ba6/cloudmusic/JjYiICIwMCAjMCBiMCAgIA==/mv/5563801/da39af7b9ffcf70381545d264ab82d87.mp4?wshc_tag=0&amp;wsts_tag=59659e2a&amp;wsid_tag=b47633d6&amp;wsiphost=ipdbm" type="video/mp4"></video>');
	// $('html').append('<video src="http://v4.music.126.net/20170713004546/72d25ac59fc89b8cf1278bcd9ced14da/cloudmusic/ICBgMCEkNzAzZTBgMSAwIg==/mv/5566286/80c29cb6e867ab0a9f6469011c7e094c.mp4" controls="controls"></video>');
	// window.open( e );
	// $('html').append('<a href="' + e + '" target="_blank">MV</a>');
	// console.log(e);
}
//获取音乐信息
function music(e, dow) {
	$.ajax({ 
        type: mkPlayer.method, 
        url: mkPlayer.api,
        data: "types=musicInfo&id=" + e,
        dataType : "jsonp",
        success: function(jsonData){
        	// callback(jsonData.url);
        	dow(jsonData.url);
        },   //success
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            error('歌曲信息获取失败 - ' + XMLHttpRequest.status);
        }
    });
};
//加载歌词
function lyric (e, callback) {
	//歌词加载容器
	var lyricArea = $(".lyric");
	function lyricTip(str) {
	    lyricArea.html("<li class='lyric-tip'>"+str+"</li>");     // 显示内容
	};
	lyricTip('<br />&nbsp;<br />歌词努力加载中...');
	 $.ajax({
        type: mkPlayer.method,
        url: mkPlayer.api,
        data: "types=lyric&id=" + e,
        dataType : "jsonp",
        success: function(jsonData){
            if(jsonData.code == -1) {
                console.log("歌曲ID为空");
                return false;
            };
            var lyric;
            if ((jsonData.nolyric === true)||(typeof jsonData.lrc === undefined) || (typeof jsonData.lrc == "undefined")||(typeof jsonData.lrc.lyric === undefined) || (typeof jsonData.lrc.lyric == "undefined"))  //没有歌词
            {
                lyric = '';
            } else {
                lyric = jsonData.lrc.lyric;
            };
            // 调试信息输出
            if(mkPlayer.debug) {
                console.log("歌词获取成功");
            };
            callback(lyric,lyricArea);    // 回调函数
        },   //success
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           lyricTip('哇！小主很伤心，没有找到歌词！');
            callback('');    // 回调函数
        }
    });//ajax
};
//歌词显示
function lyricCallback(str, a) {
    media.lyric = parseLyric(str);    // 解析获取到的歌词    
    if (media.lyric=== '') {
       $(".lyric").html('<br />&nbsp;<br /><li>哦！悲剧勒，没有找到歌词！</li>');
        return false;
    };
    a.html('<li>&nbsp;</li>');     // 清空歌词区域的内容
    a.scrollTop(0);    // 滚动到顶部
    media.lastLyric = -1;
    // 显示全部歌词
    var i = 0;
    for (var k in media.lyric) {
        var txt = media.lyric[k];
        if(!txt) txt = "&nbsp;";
        var li = $("<li data-no='"+i+"' class='lrc-item'>"+txt+"</li>");
        $(".lyric").append(li);
        i++;
    };
    $('.lyric').append('<li>&nbsp;</li>');
};
// 解析歌词
// 这一函数来自 https://github.com/TivonJJ/html5-music-player
// 参数：原始歌词文件
function parseLyric(lrc) {
    if(lrc === '') return '';
    var lyrics = lrc.split("\n");
    var lrcObj = {};
    for(var i = 0; i < lyrics.length; i++){
        var lyric = decodeURIComponent(lyrics[i]);
        var timeReg = /\[\d*:\d*((\.|\:)\d*)*\]/g;
        var timeRegExpArr = lyric.match(timeReg);
        if (!timeRegExpArr) continue;
        var clause = lyric.replace(timeReg,'');
        for(var k=0,h=timeRegExpArr.length;k<h;k++) {
            var t = timeRegExpArr[k];
            var min = Number(String(t.match(/\[\d*/i)).slice(1)),
                sec = Number(String(t.match(/\:\d*/i)).slice(1));
            var time = min * 60 + sec;
            lrcObj[time] = clause;
        };
    };
    return lrcObj;
};
// 强制刷新当前时间点的歌词
// 参数：当前播放时间（单位：秒）
function refreshLyric(time) {
    if(media.lyric === '') return false;
    time = parseInt(time);  // 时间取整
    var i = 0;
    for (var k in media.lyric) {
        if(k >= time) break;
        i = k;      // 记录上一句的
    };

    console.log( i );
    scrollLyric(i);
};
// 滚动歌词到指定句
// 参数：当前播放时间（单位：秒）
function scrollLyric(time) {
    if(media.lyric === '') return false;
    time = parseInt(time);  // 时间取整
    if(media.lyric === undefined || media.lyric[time] === undefined) return false;  // 当前时间点没有歌词
    if(media.lastLyric == time) return true;  // 歌词没发生改变
    var i = 0;  // 获取当前歌词是在第几行

	console.log( media.lyric )
    for(var k in media.lyric){
    	console.log( k )
        if(k == time) break;
        i ++;
    };
    media.lastLyric = time;  // 记录方便下次使用
    // console.log(time);
    $(".on").removeClass("on");     // 移除其余句子的正在播放样式
    $(".lrc-item[data-no='" + i + "']").addClass("on");    // 加上正在播放样式
    var scroll = ($(".lyric").children().height() * i) - ($(".lyric").height() / 2);
    $(".lyric").stop().animate({scrollTop: scroll+50}, 1000);  // 平滑滚动到当前歌词位置(更改这个数值可以改变歌词滚动速度，单位：毫秒)
};
// 将当前歌曲加入播放历史
// 参数：要添加的音乐
function addHis(music) {
    if(media.playlist == 2) return true;  // 在播放“播放记录”列表则不作改变
	// console.log(List[1].item.push(playerReaddata("his")[0]));
    if(List[1].item.length > 300) List[1].item.length = 299; // 限定播放历史最多是 300 首
    if(music.musicId !== undefined && music.musicId !== '') {
        // 检查历史数据中是否有这首歌，如果有则提至前面
        for(var i=0; i<List[1].item.length; i++) {
            if(List[1].item[i].musicId == music.musicId) {
                List[1].item.splice(i, 1); // 先删除相同的
                i = List[1].item.length;
            };
        };
    };
    // 再放到第一位
    List[1].item.unshift(music);
    // return false;
    playerSavedata('his', List[1].item);  // 保存播放历史列表
};
// 播放器本地存储信息
// 参数：键值、数据
function playerSavedata(key, data) {
    key = 'mkPlayer_' + key;    // 添加前缀，防止串用
    data = JSON.stringify(data);
    // 存储，IE6~7 不支持HTML5本地存储
    if (window.localStorage) {
        localStorage.setItem(key, data);	
    };
};

// 播放器读取本地存储信息
// 参数：键值
// 返回：数据
function playerReaddata(key) {
    if(!window.localStorage) return '';
    key = 'mkPlayer_' + key;
    return JSON.parse(localStorage.getItem(key));
};
// MV
// 参数：ID、回调函数
function MV(e, callback) {
	$.ajax({ 
        type: mkPlayer.method, 
        url: mkPlayer.api,
        data:'id=' + e + '&types=mp4',
        dataType : "jsonp",
        complete: function(XMLHttpRequest, textStatus) {
            // if(tmpLoading) layer.close(tmpLoading);    // 关闭加载中动画
        },
        success: function(jsonData){
        	callback(jsonData.data.brs[720]);
        },   //success
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            error('MV信息获取失败 - ' + XMLHttpRequest.status);
        }
    });
};
//打开查询是否登录
$(window).one("load",function(){
	var user = playerReaddata('user');
	var ulist = playerReaddata('ulist');
	if(ulist.length > 0){
		var Fcb = $('.f-cb li').length;
		for(var i = 0; i < ulist.length; i++) {
    		var html = '<li class="sheet-item" data-no="' + (Fcb + i) +'" title="' + ulist[i].name + '">'+
					'<img src="' + ulist[i].cover +'?param=40y40" alt="' + ulist[i].name + '">' +
					ulist[i].name +'</li>';
    		$('.f-cb').append(html);
    		List.push(ulist[i]);
    	};
		if(user !== null) {
			$('.LoginBtn').remove();
			$('.login').prepend('<div class="user">你好：' + user + '</div><a class="del" href="javascript:;">退出</a>');
		};
	};
});
//退出登录
$('.del').live('click', function() {
	var ulist = playerReaddata('ulist').length;
	$('.f-cb li').slice(-ulist).remove();
	playerSavedata('ulist',"");
	$('.user,.del').remove();
	$('.login').prepend('<a class="LoginBtn" href="javascript:;">登录</a>');
});
$(window).one("load",function(){
	$("#mCSB_2_container").mCustomScrollbar({
		theme:"minimal"
	});
});
//登录
$('.LoginBtn').live('click',function () {
	$('.modal-backdrop,.LoginWrap').show();
	$('.LoginWrap').removeAttr("style");
});
$('.normal,.glyphicon-remove').live('click',function () {
	$('.LoginWrap').removeAttr("style").css({'opacity':' 0','transform':'translatey(-100%)','display': 'none'});
	$('.modal-backdrop,.HelpWrap').hide();
	return false;
});
//Esc隐藏div
$(document).keyup(function (event) {
	if(!$('.modal-backdrop').is(":hidden")){
		if(event.keyCode == 27){
		 	$('.normal').trigger('click');
		};
	};
});
//帮助
$('.help').click(function () {
	$('.LoginWrap').removeAttr("style");
	$('.LoginWrap').css({'opacity':' 0','transform':'translatey(-100%)','display': 'none'});
	$('.HelpWrap').show();
	return false;
});
$('.HelpDeter,.HelpWrap .glyphicon-remove').click(function(){
	$('.HelpWrap, .modal-backdrop').hide();
});
//同步网易云音乐
$('.LoginDeter').click(function () {
	// $('.LoginWrap').removeAttr("style").css({'opacity':' 0','transform':'translatey(-100%)','display': 'none'});
	var LoginId = $('.form-control').val();
	if(LoginId == false) return false;
	if(isNaN(LoginId)) {
		Deter('ID只能是纯数字！', 'more');
		return false;
	};
	// Deter ('加载中...', 'Load');
    $.ajax({
        type: mkPlayer.method,
        url: mkPlayer.api,
        data: "types=userlist&uid=" + LoginId,
        dataType : "jsonp",
        complete: function(XMLHttpRequest, textStatus) {
            // if(tmpLoading) layer.close(tmpLoading);    // 关闭加载中动画
        }, 
        success: function(jsonData){
        	if(jsonData.code == "-1" || jsonData.code == 400){
                Deter('用户ID输入有误','more');
                return false;
            }else if (jsonData.playlist.length === 0 || typeof(jsonData.playlist.length) === "undefined") {
                Deter('没找到用户 ' + LoginId + ' 的歌单','more');
                return false;
            }else{
            	var Fcb = $('.f-cb li').length;
            	var userList = [];
            	for(var i = 0; i < jsonData.playlist.length; i++) {
            		var ID = {
            			id: jsonData.playlist[i].id,
            			name: jsonData.playlist[i].name,
            			cover: jsonData.playlist[i].coverImgUrl
            		}
            		var html = '<li class="sheet-item" data-no="' + (Fcb + i) +'" title="' + jsonData.playlist[i].name + '">'+
        					'<img src="' + jsonData.playlist[i].coverImgUrl +'?param=40y40" alt="' + jsonData.playlist[i].name + '">' +
        					jsonData.playlist[i].name +'</li>';
            		List.push(ID);
            		$('.f-cb').append(html);
            		userList.push(ID);
            		playerSavedata('ulist',userList);
            	};
        		$('.LoginBtn').remove();
        		$('.login').prepend('<div class="user">你好：' + jsonData.playlist[0].creator.nickname + '</div><a class="del" href="javascript:;">退出</a>');
        		playerSavedata('user',jsonData.playlist[0].creator.nickname);
        		$('.normal').trigger('click');
            };
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            error('MV信息获取失败 - ' + XMLHttpRequest.msg);
        }
    });
	// console.log($('.form-control').val());
});
// 返回状态
function Deter(a, e) {
	switch(e) {
        case "more":    // 还可以加载更多
            $('.LoginWrap').append('<span class="myanimation">' + a +'</span>');
			setTimeout("$('.myanimation').remove()",1300);
        break;
        case "Load":
        	$('.LoginWrap').append('<span class="myanimation">' + a +'</span>');
    	break;
    };
};
// 拖动
$(function(){
	var Login = false;
	var X, Y, LoL, LoT;
	if(document.attachEvent) {//ie的事件监听，拖拽div时禁止选中内容，firefox与chrome已在css中设置过-moz-user-select: none; -webkit-user-select: none;
        $('html').attachEvent('onselectstart', function() {
          return false;
        });
	 };
	$('.LoginTitle').mousedown(function(e) {
		Login = true;
		X = e.clientX;
		Y = e.clientY;
		LoL = $('.LoginWrap').offset().left;
		LoT = $('.LoginWrap').offset().top;
		$('.LoginWrap').css('transition',"initial");
	});
	$('.LoginTitle').mousemove(function (e) {
		if (Login == false) return false;
		$('.LoginWrap').css({'left' : e.clientX - X + LoL, 'top' : e.clientY - Y + LoT});
		//区域内移动
		if($(window).height() <= parseInt(e.clientY - Y + LoT + $('.LoginWrap').height())) $('.LoginWrap').css('top',$(window).height() - $('.LoginWrap').height());
		if($(window).width() <= parseInt(e.clientX - X + LoL +$('.LoginWrap').width() +1)) $('.LoginWrap').css('left',$(window).width() - $('.LoginWrap').width());
		if(e.clientY - Y + LoT <= 0) $('.LoginWrap').css('top', '0');
		if(e.clientX - X + LoL <= 0) $('.LoginWrap').css('left', '0');
	});
	$('html').mouseup(function(e){
	    Login = false;
	});
});