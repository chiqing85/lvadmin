//默认配置
var mkPlayer = {
    api: "api.php", // api地址
    loadcount: 20,  // 搜索结果一次加载多少条
    method: "POST",     // 数据传输方式(POST/GET)
    defaultlist: 3,    // 默认要显示的播放列表编号
    volume: .5,        // 默认音量值(0~1之间)
    debug: false   // 是否开启调试模式(true/false)
};
//时间转换
var secondsToTime = function( secs ) {
	var hours = Math.floor( secs / 3600 ),
		minutes = Math.floor( secs % 3600 / 60 ),
		seconds = Math.ceil( secs % 3600 % 60 );
		if(seconds==60){
			minutes+=1;
			seconds=00;
		};
	return ( hours == 0 ? '' : hours > 0 && hours.toString().length < 2 ? '0'+hours+':' : hours+':' ) + ( minutes.toString().length < 2 ? '0'+minutes : minutes ) + ':' + ( seconds.toString().length < 2 ? '0'+seconds : seconds );
};
//sheet-item配置
var List=[
	{
        name: "正在播放",   // 播放列表名字
        cover: "",          // 播放列表封面
        creatorName: "",        // 列表创建者名字
        creatorAvatar: "",      // 列表创建者头像
        item: []
    },
    // 预留列表：播放历史
    {
        name: "播放历史",   // 播放列表名字
        cover: "",          // 播放列表封面
        creatorName: "",        // 列表创建者名字
        creatorAvatar: "",      // 列表创建者头像
        item: []
    },
	{
	    id: 3778678     // 云音乐热歌榜
	},
	{
	    id: 3779629     // 云音乐新歌榜
	},
	{
	    id: 19723756     // 云音乐飙升榜
	},
	{
	    id: 4395559     // 华语金曲榜
	},
	{
		id:2884035		//网易原创歌曲榜
	},
	{
	    id: 64016     // 中国TOP排行榜（内地榜）
	},
	{
	    id: 112504     // 中国TOP排行榜（港台榜）
	},
	{
		id:60198	//美国Billboard周榜
	},
	{
		id: 745956260	//云音乐韩语榜
	},
	{
	    id: 60131     // 日本Oricon周榜
	},
];