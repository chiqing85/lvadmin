<?php
use \App\Http\Controllers\admin\CommentsController as Com;
?>
@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="row">
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="box p-a">
                    <div class="pull-left m-r">
                    <span class="w-48 rounded  accent">
                      <i class="material-icons">&#xe151;</i>
                    </span>
                    </div>
                    <div class="clear">
                        <h4 class="m-0 text-lg _300"><a data-pjax href="/admin/article">{{ $acount }} <span class="text-sm"></span></a></h4>
                        <small class="text-muted">文章总数</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="box p-a">
                    <div class="pull-left m-r">
                    <span class="w-48 rounded primary">
                      <i class="material-icons">&#xe54f;</i>
                    </span>
                    </div>
                    <div class="clear">
                        <h4 class="m-0 text-lg _300"><a href="javascript:;">{{ $acountd }}</a></h4>
                        <small class="text-muted">日新增文章</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="box p-a">
                    <div class="pull-left m-r">
                    <span class="w-48 rounded warn">
                      <i class="material-icons">&#xe8d3;</i>
                    </span>
                    </div>
                    <div class="clear">
                        <h4 class="m-0 text-lg _300"><a data-pjax href="/admin/comments">{{ $ccount }} </a></h4>
                        <small class="text-muted">留言</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="box p-a">
                    <div class="pull-left m-r">
                    <span class="w-48 rounded blue">
                      <i class="material-icons">&#xe8d3;</i>
                    </span>
                    </div>
                    <div class="clear">
                        <h4 class="m-0 text-lg _300"><a href="javascript:;">{{ $ccountd }} </a></h4>
                        <small class="text-muted">今日留言</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bdtongji">
            <div class="col-sm-12 col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3>最近访问</h3>
                        <small class="block text-muted">PV/月</small>
                    </div>
                    <div class="box-body">
                        <div ui-jp="chart" ui-options="{tooltip:{trigger:'axis',backgroundColor:'rgba(255,255,255,0.5)',borderWidth:1,borderColor:'rgba(255,255,255,0.7)',textStyle:{color:'#2196f3'}},legend:{data:['{{  date('m') }}月','{{ date('m', strtotime( date('Y').'-'.( date('m') - 1). '-01') ) }}月']},calculable:true,xAxis:[{type:'category',boundaryGap:false,splitLine:{show:false},data:[{{$bdtj['xAxis']}}]}],yAxis:[{type:'value'}],series:[{name:'{{  date('m') }}月',type:'line',smooth:true,symbol:'none',connectNulls:true,itemStyle:{normal:{areaStyle:{type:'default'},lineStyle:{width:1}}},data:[{{$bdtj['pv'][date('m')]}}]},{name:'{{ date('m', strtotime( date('Y').'-'.( date('m') - 1). '-01') ) }}月',type:'line',symbol:'none',smooth:true,itemStyle:{normal:{areaStyle:{type:'default'},lineStyle:{width:1}}},data:[{{$bdtj['pv'][date('m',strtotime(date('Y').'-'.(date('m')-1).'-01'))]}}]},]}" style="height:300px" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-sign-in"></i>
                        <h3>登录日志</h3>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width:60px;" class="text-center">IP</th>
                            <th>用户</th>
                            <td class="location">位置</td>
                            <th>时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $loginlog as $v)
                            <tr>
                                <td> {{ $v->ip }} </td>
                                <td>{{ $v->user['username'] }}</td>
                                <td class="location"> {{ $v->location }}</td>
                                <td class="text-warning">
                                    {{ time_lin( $v->created_at ) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="box">
                    <div class="box-header">
                        <span class="label success pull-right">5</span>
                        <i class="fa  fa-comments"></i>
                        <h3>最新留言</h3>
                    </div>
                    <div class="box-body">
                        <div class="streamline b-l m-b m-l">
                            @foreach( $CNew as $v)
                            <div class="sl-item">
                                <div class="sl-left">
                                    @if( $v->item_pic)
                                    <img src="{{ $v->item_pic }}" class="img-circle">
                                    @else
                                        <span class="w-40 _400 rounded @if($v->name) blue @else null @endif ">{{ $v->item }}</span>
                                    @endif
                                </div>
                                <div class="sl-content">
                                    <div class="pull-right text-muted">{{ $v->created_at->format('m-d H:i:s') }}</div>
                                    <span class="m-l-sm sl-date">{{ $v->name ? $v->name : '匿名用户' }}</span>
                                    <div><a href="@if($v->modelid){{ url("/article/$v->articleid")}}{{Com::page( $v ) > 1 ? '?page='.Com::page( $v ) : ''}}#{{ $v->parentid ? $v->parentid : $v->id}}@else {{ url("admin/contacts/$v->id") }}@endif" class="text-info" target="_blank">{{ $v->contents }}</a>.</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-copyright"></i>
                        <h3> 版权信息</h3>
                    </div>
                    <table class="table table-bordered m-0">
                        <tbody>
                        @foreach($copy as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                                    @endif
                                    <td>{{ $v['name'] }}</td>
                                    <td>{!! $v['value'] !!} </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-cogs"></i>
                        <h3>系统配置 </h3>
                    </div>
                    <table class="table table-bordered m-0">
                        <tbody>
                        @foreach($system as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                            @endif
                                    <td>{{ $v['name'] }}</td>
                                    <td>{{ $v['value'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <span class="label success pull-right">
                            <div class="box-tool">
                                    <ul class="nav">
                                        <li class="nav-item inline dropdown">
                                            <a class="nav-link" data-toggle="dropdown" aria-expanded="true">
                                                <i class="material-icons md-18"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-scale pull-right jAudio-radio"></div>
                                        </li>
                                    </ul>
                                </div>
                        </span>
                        <h3>电台</h3>
                        <small class="music">QQ | 在线电台</small>
                    </div>
                    <div class="box-header">
                        <div class="jAudio--ui">
                            <div class="jAudio--thumb">
                                <div class="img-cover">
                                    <img src="data:image/png;base64,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" alt="" class="round_icon play-tx">
                                </div>
                                <div class="center_list">
                                    <div class="u-music-title">
                                        <h2></h2>
                                        <small></small>
                                    </div>
                                    <div class="jAudio-lyric"><div class="lyric" style></div></div>
                                </div>
                            </div>
                            <div class="jAudio--progress-bar">
                                <div class="jAudio--progress-bar-wrapper">
                                    <div class="jAudio--progress-bar-played" style="width: 0%">
                                        <span class="jAudio--progress-bar-pointer"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="jAudio--time">
                                <span class="jAudio--time-elapsed">0:00</span>
                                <span class="jAudio--time-total"></span>
                            </div>
                            <div class="jAudio--controls">
                                <i class="material-icons jAudio_play">&#xe039;</i>
                                <i class="material-icons playnext">&#xe01f;</i>
                                <div class="jAudio_volume">
                                    <i class="material-icons">&#xe050;</i>
                                    <div class="aplayer-volume-bar-wrap"><div class="aplayer-volume-bar"><div class="aplayer-volume" style="height: 0%;"></div></div></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    .bdtongji .legend {
        width: 125px;
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
    }
    .bdtongji tr {
        float: left;
    }
    small.music {
        display: inline-block;
    }
    .u-music-title * {
        max-width: 350px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .jAudio--ui {
        min-height: 213px;
    }
    .jAudio--thumb {
        display: inline-flex;
        padding: 10px;
        /*background: #f9f9f9;*/
    }
    .img-cover {
        position: relative;
        width: 121px;
        height: 121px;
        overflow: hidden;
        border-radius: 50%;
        box-shadow: 2px 1px 10px 0 #00000024;
        border: 2px solid #fff;
    }
    .img-cover:after, .img-cover:before {
        position: absolute;
        top: 50%;
        left: 50%;
        display: block;
        content: '';
        background: #fff;
        border-radius: 50%;
        transform: translate(-50%,-50%);
    }
    .img-cover:after {
        width: 30px;
        height: 30px;
    }
    .img-cover:before {
        width: 26px;
        height: 26px;
        background-color: #ffffff;
        opacity: 0.93;
        border: 1px solid #adadad;
        z-index: 10;
    }
    img.round_icon.play-tx {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 50%;
        animation: rotate 20s linear infinite;
        animation-play-state: paused;
    }
    img.play-tx.pause {
        animation-play-state: inherit;
    }
    .jAudio-radio>a.dropdown-item{
        padding: 5px 1.5rem;
    }
    .center_list {
        text-align: left;
        margin-left: 20px;
    }
    .jAudio--progress-bar {
        margin: .5rem 0;
    }
    .jAudio--progress-bar .jAudio--progress-bar-wrapper {
        width: 100%;
        position: relative;
        background: #f9f9f9;
        cursor: pointer;
        border-radius: 10px;
    }
    .jAudio--progress-bar .jAudio--progress-bar-played {
        min-width: 10px;
        height: 10px;
        background: #f66;
        position: relative;
        border-radius: 10px;
    }
    .jAudio--progress-bar .jAudio--progress-bar-played {
        -webkit-transition: all .2s ease 0s;
        transition: all .2s ease 0s;
    }
    .jAudio--progress-bar .jAudio--progress-bar-pointer {
        height: 12px;
        width: 12px;
        border-radius: 50%;
        position: absolute;
        right: -1px;
        top: -1px;
        border: 3px solid #fff;
        box-shadow: 0 0 4px 3px #00000025;
        border-width: 6px;
        border-style: solid;
        border-color: #efefef #fff #efefef #fff;
        transform: rotate(45deg);
    }
    .jAudio--time {
        display: table;
        width: 100%;
    }
    .jAudio--time:after {
        content: " ";
        display: block;
        width: 100%;
        clear: both;
    }
     .jAudio--time * {
        width: 50%;
        display: block;
        float: left;
        color: #78787880;
        font-size: .9rem;
    }
    .jAudio--time .jAudio--time-elapsed {
        text-align: left;
    }
    .jAudio--time .jAudio--time-total {
        text-align: right;
    }
    .jAudio--controls {
        width: 100%;
        display: flex;
    }
    .jAudio--controls * {
        position: relative;
        width: 33.333%;
        height: 2rem;
        line-height: 2rem;
        font-size: 30px;
        text-align: center;
        color: #ddd;
        cursor: pointer;
    }
    .jAudio_volume {
        display: inline-block;
    }
    .jAudio_play.play-off {
        color: #f66;
    }
    .portal {
        min-width: 150px !important;
    }
    .jAudio-lyric {
        margin-top: .5rem;
        height: 85px;
        overflow: hidden;
    }
    @-webkit-keyframes rotate{
        0%{-webkit-transform:rotate(0deg);}
        100%{-webkit-transform:rotate(360deg);}
    }
    .jAudio-lyric p.on {
        color: #6cc788;
        font-size: 14px;
        -webkit-transition: All 1s ease;
        -o-transition: All 1s ease;
        transition: All 1s ease;
    }
    .lyric {
        -webkit-transition: All 1s ease;
        -o-transition: All 1s ease;
        transition: All 1s ease;
    }
    .jAudio-lyric * {
        margin-bottom: .5rem;
        max-width: 350px;
        white-space: nowrap;
        font-size: 13px;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .aplayer-volume-bar-wrap {
         display: none;
        position: absolute;
        bottom: 25px;
        left: 43%;
        width: 25px;
        height: 65px;
        z-index: 99;
    }
    .aplayer-volume-bar {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 5px;
        height: 50px;
        background: #f0f0f0;
    }
    .aplayer-volume {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 5px;
        background: #ff7474;
    }
    .jAudio_volume:hover .aplayer-volume-bar-wrap {
        display: block;
    }
    .aplayer-volume:after {
        content: '';
    }
    @media (max-width: 991px) {
        .jAudio--thumb { display: block }
        .img-cover { display: none }
    }
    @media (max-width: 767px){
        .jAudio--thumb { display: block }
        .img-cover { margin: 0 auto 10px; display: block }
        .location { display: none }
    }
</style>
@endsection