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
                            <li class="nav-item inline">
                                <a class="nav-link">
                                    <i class="material-icons md-18">&#xe863;</i>
                                </a>
                            </li>
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
                        {{--<div class="text-center m-b">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-sm white">
                                    <input type="radio" name="options" autocomplete="off"> Month
                                </label>
                                <label class="btn btn-sm white">
                                    <input type="radio" name="options" autocomplete="off"> Day
                                </label>
                            </div>
                        </div>--}}
                        <div ui-jp="plot" ui-refresh="app.setting.color" ui-options='
                        [
                            {
                                name: "PV",
                                label: "PV",
                                data:[
                                        ["15",311],["14",230],["13",92],["12",78],["11",109],["10",77],["09",126],["08",154],
                                        ["07",201],["06",167],["05",179],["04",208],["03",218],["02",192],["01",225]
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
                                    ["15",5],["14",25],["13",4],["12",3],["11",3],["10",7],["09",3],
                                    ["08",4],["07",5],["06",4],["05",5],["04",5],["03",3],["02",5],["01",2]
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
                                    ["15",5],["14",19],["13",4],["12",4],["11",5],["10",7],["09",3],
                                    ["08",3],["07",3],["06",3],["05",4],["04",5],["03",4],["02",5],["01",2]
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
            <div class="col-sm-12 col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3>Stats</h3>
                        <small>Your data status</small>
                    </div>
                    <div class="box-tool">
                        <ul class="nav">
                            <li class="nav-item inline">
                                <a class="nav-link">
                                    <i class="material-icons md-18">&#xe863;</i>
                                </a>
                            </li>
                            <li class="nav-item inline dropdown">
                                <a class="nav-link" data-toggle="dropdown">
                                    <i class="material-icons md-18">&#xe5d4;</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-scale pull-right">
                                    <a class="dropdown-item" href>This week</a>
                                    <a class="dropdown-item" href>This month</a>
                                    <a class="dropdown-item" href>This week</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item">Today</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width:60px;" class="text-center">Graph</th>
                            <th>Item</th>
                            <th style="width:70px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 16,15,15,14,17,18,16,15,16 ], {type:'bar', height:19, barWidth:4, barSpacing:2, barColor:'#0cc2aa'}" class="sparkline inline">loading...</div>
                            </td>
                            <td>App downloads</td>
                            <td class="text-success">
                                <i class="fa fa-level-up"></i> 40%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 60,30,10 ], {type:'pie', height:19, sliceColors:['#fcc100','#fff','#0cc2aa']}" class="sparkline inline">loading...</div>
                            </td>
                            <td>Social connection</td>
                            <td class="text-success">
                                <i class="fa fa-level-up"></i> 20%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 16,15,15,14,17,18,16,15,16 ], {type:'line', height:19, width:60, lineColor:'#0cc2aa', fillColor:'transparent'}" class="sparkline inline">loading...</div>
                            </td>
                            <td>Revenue</td>
                            <td class="text-warning">
                                <i class="fa fa-level-down"></i> 5%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 16,15,15,14,17,18,16,15,16 ], {type:'discrete', height:19, width:60, lineColor:'#6cc788'}" class="sparkline inline">loading...</div>
                            </td>
                            <td>Customer increase</td>
                            <td class="text-danger">
                                <i class="fa fa-level-down"></i> 20%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 16,15,15,14,17,18,16,15,16 ], {type:'line', height:19, width:60, lineColor:'#fcc100', fillColor:'#fcc100'}" class="sparkline inline">loading...</div>
                            </td>
                            <td>Order placed</td>
                            <td class="text-warning">
                                <i class="fa fa-level-down"></i> 5%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div ui-jp="sparkline" ui-refresh="app.setting.color" ui-options="[ 16,15,15,16,15,16,14,17,18 ], {type:'line', height:19, width:60, lineColor:'#fcc100', fillColor:'transparent'}" class="sparkline inline">loading...</div>
                            </td>
                            <td>Visitors</td>
                            <td class="text-warning">
                                <i class="fa fa-level-down"></i> 8%
                            </td>
                        </tr>
                        </tbody>
                    </table>
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

@section('script')
<script>
    $.get('/admin/tongji')
    .then( (res) => {
        let options = JSON.parse( res)['items']
        let pv = [],
            uv = [],
            ip = []
        for( let i = 0; i < options[0].length; i++) {
            let date = options[0][ i ][0]   // 时间
            let d = date.split('/')
            let m = d[2]
            let pv_count = options[1][ i ][0]   // pv
            let visitor_count = options[1][i][1]    // 访客
            let ip_count = options[1][i][2]     // ip
            pv.push([m, pv_count])
            uv.push([m, visitor_count])
            ip.push([m, ip_count])
        }
        let baidu = "[{data:" + JSON.stringify( pv ) + ",points:{show:true,radius:0},splines:{show:true,tension:0.45,lineWidth:2,fill:1}}," +
            "{data:" + JSON.stringify( uv ) + ",points:{show:true,radius:0},splines:{show:true,tension:0.45,lineWidth:2,fill:1}}," +
            "{data:"+ JSON.stringify( ip ) + ",points:{show:true,radius:0},splines:{show:true,tension:0.45,lineWidth:2,fill:1}}],{colors:['#a88add','#0cc2aa','#fcc100'],series:{shadowSize:3},xaxis:{show:true,font:{color:'#ccc'},position:'bottom'},yaxis:{show:true,font:{color:'#ccc'}},grid:{hoverable:true,clickable:true,borderWidth:0,color:'rgba(120,120,120,0.5)'},tooltip:true,tooltipOpts:{content:'%x.0 is %y.4',defaultTheme:false,shifts:{x:0,y:-40}}}"

        $('.baidutongji').attr('ui-options', baidu )
    });
</script>
@endsection