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
                        <h4 class="m-0 text-lg _300"><a href>125 <span class="text-sm"></span></a></h4>
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
                        <h4 class="m-0 text-lg _300"><a href>2</a></h4>
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
                        <h4 class="m-0 text-lg _300"><a href>30 </a></h4>
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
                        <h4 class="m-0 text-lg _300"><a href>2 </a></h4>
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
                        <small>30 days</small>
                    </div>
                    <div class="box-tool">
                        <ul class="nav">
                            <li class="nav-item inline dropdown">
                                <a class="nav-link" data-toggle="dropdown">
                                    <i class="material-icons md-18">&#xe5d4;</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-scale pull-right">
                                    <a class="dropdown-item" href>日</a>
                                    <a class="dropdown-item" href>月</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div ui-jp="plot" ui-refresh="app.setting.color" ui-options='
                        [
                            {
                                name: "PV",
                                label: "PV",
                                data:[
                                       {{ $bdtj['pv'] }}
                                    ],
                                points:{
                                 show:true,
                                 radius:0,
                                },
                                splines:{
                                    show:true,
                                    tension:0.45,
                                    lineWidth:2,
                                    fill:1
                                }
                            },
                            {
                                label: "UV",
                                data:[
                                    {{ $bdtj['uv'] }}
                                ],
                                points:{ show:true,radius:0 },
                                splines:{
                                    show:true,
                                    tension:0.45,
                                    lineWidth:2,
                                    fill:1
                                }
                            },
                            {
                                name: "IP",
                                label: "IP",
                                data:[
                                    {{ $bdtj['ip'] }}
                                ],
                                points:{
                                    legend: {
                                        align: "center",
                                        verticalAlign: "top",
                                        x: 0,
                                        y: 0
                                    },
                                    show:true,
                                    radius: 0,
                                     responsive: true,
                                    scaleBeginAtZero: true
                                },
                                splines:{
                                    show:true,
                                    tension:0.45,
                                    lineWidth:2,
                                    fill:1
                                },
                            }
                        ],
                        {
                            colors: [ "#a88add", "#0cc2aa", "#fcc100" ],
                            legend: {
                               position: "absolute",
                               spacingX: 20,
                               align: "center",
                               verticalAlign: "top",
                               x: 0,
                               y: 0
                            },
                            series: {
                                shadowSize: 3,
                            },

                            xaxis:{
                                font:{
                                    color:"#ccc"
                                },
                                position:"bottom"
                            }
                            ,yaxis:{
                                show:true,
                                font:{
                                    color:"#ccc"
                                 }
                            }
                            ,grid:{
                                hoverable:true,
                                clickable:true,
                                borderWidth:0,
                                color:"rgba(120,120,120,0.5)"
                            },
                            tooltip:true,
                            tooltipOpts: {
                                content:"%s: %y",
                                defaultTheme:true,
                                shifts:{x:0,y:-30}
                            }
                        }'
                 style="height:188px" >
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
                            <td>位置</td>
                            <th>时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $loginlog as $v)
                            <tr>
                                <td> {{ $v->ip }} </td>
                                <td>{{ $v->user['username'] }}</td>
                                <td> {{ $v->location }}</td>
                                <td class="text-warning">
                                    <i class="fa fa-level-up"></i>
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
                        <h3>Open Projects <span class="label warning">9</span></h3>
                        <small>Your data status</small>
                    </div>
                    <ul class="list inset">
                        <li class="list-item">
                            <a herf class="list-left">
                                <span class="w-40 r-2x _600 text-lg accent">
                                B
                            </span>
                            </a>
                            <div class="list-body">
                                <div class="m-y-sm pull-right">
                                    <a href class="btn btn-xs white">Manage</a>
                                    <a href class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div><a href>Broadcast web app mockup</a></div>
                                <div class="text-sm">
                                    <span class="text-muted"><strong>5</strong> tasks, <strong>3</strong> issues</span>
                                    <span class="label"></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                                <span class="w-40 r-2x _600 text-lg success">
                                    G
                                 </span>
                            </a>
                            <div class="list-body">
                                <div class="m-y-sm pull-right">
                                    <a href class="btn btn-xs white">Manage</a>
                                    <a href class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div><a href>GoodDesign Bootstrap 4 migration</a></div>
                                <div class="text-sm">
                                    <span class="text-muted"><strong>35</strong> tasks, <strong>6</strong> issues</span>
                                    <span class="label"></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                            <span class="w-40 r-2x _600 text-lg purple">
                                #
                            </span>
                            </a>
                            <div class="list-body">
                                <div class="m-y-sm pull-right">
                                    <a href class="btn btn-xs white">Manage</a>
                                    <a href class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div><a href>#Hashtag android app develop</a></div>
                                <div class="text-sm">
                                    <span class="text-muted"><strong>52</strong> tasks, <strong>13</strong> issues</span>
                                    <span class="label"></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                                <span class="w-40 r-2x _600 blue">
                                    <i class="fa fa-lg fa-google"></i>
                                </span>
                            </a>
                            <div class="list-body">
                                <div class="m-y-sm pull-right">
                                    <a href class="btn btn-xs white">Manage</a>
                                    <a href class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div><a href>Google material design application</a></div>
                                <div class="text-sm">
                                    <span class="text-muted"><strong>15</strong> tasks, <strong>3</strong> issues</span>
                                    <span class="label"></span>
                                </div>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                            <span class="w-40 r-2x _600 blue-800">
                                <i class="fa fa-lg fa-facebook"></i>
                                </span>
                            </a>
                            <div class="list-body">
                                <div class="m-y-sm pull-right">
                                    <a href class="btn btn-xs white">Manage</a>
                                    <a href class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div><a href>Facebook connection web application</a></div>
                                <div class="text-sm">
                                    <span class="text-muted"><strong>30</strong> tasks, <strong>5</strong> issues</span>
                                    <span class="label"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3>Members</h3>
                    </div>
                    <ul class="list no-border p-b">
                        <li class="list-item">
                            <a herf class="list-left">
                            <span class="w-40 avatar">
                              <img src="/static/admin/images/a4.jpg" alt="...">
                              <i class="on b-white bottom"></i>
                            </span>
                            </a>
                            <div class="list-body">
                                <div><a href>Chris Fox</a></div>
                                <small class="text-muted text-ellipsis">Designer, Blogger</small>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                          <span class="w-40 avatar">
                              <img src="/static/admin/images/a5.jpg" alt="...">
                              <i class="on b-white bottom"></i>
                          </span>
                            </a>
                            <div class="list-body">
                                <div><a href>Mogen Polish</a></div>
                                <small class="text-muted text-ellipsis">Writter, Mag Editor</small>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                          <span class="w-40 avatar">
                              <img src="/static/admin/images/a6.jpg" alt="...">
                              <i class="away b-white bottom"></i>
                          </span>
                            </a>
                            <div class="list-body">
                                <div><a href>Joge Lucky</a></div>
                                <small class="text-muted text-ellipsis">Art director, Movie Cut</small>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                          <span class="w-40 avatar">
                              <img src="/static/admin/images/a7.jpg" alt="...">
                              <i class="busy b-white bottom"></i>
                          </span>
                            </a>
                            <div class="list-body">
                                <div><a href>Folisise Chosielie</a></div>
                                <small class="text-muted text-ellipsis">Musician, Player</small>
                            </div>
                        </li>
                        <li class="list-item">
                            <a herf class="list-left">
                            <span class="w-40 avatar success">
                              <span>P</span>
                              <i class="away b-white bottom"></i>
                            </span>
                            </a>
                            <div class="list-body">
                                <div><a href>Peter</a></div>
                                <small class="text-muted text-ellipsis">Musician, Player</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3>Tasks</h3>
                        <small>20 finished, 5 remaining</small>
                    </div>
                    <div class="box-tool">
                        <ul class="nav">
                            <li class="nav-item inline dropdown">
                                <a class="nav-link text-muted p-x-xs" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-scale pull-right">
                                    <a class="dropdown-item" href>New task</a>
                                    <a class="dropdown-item" href>Make all finished</a>
                                    <a class="dropdown-item" href>Make all unfinished</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item">Settings</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="streamline b-l m-l">
                            <div class="sl-item b-success">
                                <div class="sl-icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="sl-content">
                                    <div class="sl-date text-muted">8:30</div>
                                    <div>Call to customer <a href class="text-info">Jacob</a> and discuss the detail about the AP project.</div>
                                </div>
                            </div>
                            <div class="sl-item b-info">
                                <div class="sl-content">
                                    <div class="sl-date text-muted">Sat, 5 Mar</div>
                                    <div>Prepare for presentation</div>
                                </div>
                            </div>
                            <div class="sl-item b-warning">
                                <div class="sl-content">
                                    <div class="sl-date text-muted">Sun, 11 Feb</div>
                                    <div><a href class="text-info">Jessi</a> assign you a task <a href class="text-info">Mockup Design</a>.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href class="btn btn-sm warn text-u-c pull-right">Add one</a>
                        <a href class="btn btn-sm white text-u-c">More</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="box">
                    <div class="box-header">
                        <span class="label success pull-right">5</span>
                        <h3>Activity</h3>
                        <small>10 members update their activies.</small>
                    </div>
                    <div class="box-body">
                        <div class="streamline b-l m-b m-l">
                            <div class="sl-item">
                                <div class="sl-left">
                                    <img src="/static/admin/images/a2.jpg" class="img-circle">
                                </div>
                                <div class="sl-content">
                                    <a href class="text-info">Louis Elliott</a><span class="m-l-sm sl-date">5 min ago</span>
                                    <div>assign you a task <a href class="text-info">Mockup Design</a>.</div>
                                </div>
                            </div>
                            <div class="sl-item">
                                <div class="sl-left">
                                    <img src="/static/admin/images/a5.jpg" class="img-circle">
                                </div>
                                <div class="sl-content">
                                    <a href class="text-info">Terry Moore</a><span class="m-l-sm sl-date">10 min ago</span>
                                    <div>Follow up to close deal</div>
                                </div>
                            </div>
                            <div class="sl-item">
                                <div class="sl-left">
                                    <img src="/static/admin/images/a8.jpg" class="img-circle">
                                </div>
                                <div class="sl-content">
                                    <a href class="text-info">Walter Paler</a><span class="m-l-sm sl-date">1 hour ago</span>
                                    <div>was added to Repo</div>
                                </div>
                            </div>
                        </div>
                        <a href class="btn btn-sm white text-u-c m-y-xs">Load More</a>
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
</style>
@endsection