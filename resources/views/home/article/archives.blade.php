@extends('home.layouts.base')
@section('contents')
  <div class="card-inner active" id="about-card">
        <div class="row card-container">
            <div class="card-wrap col col-m-12 col-t-12 col-d-12 col-d-lg-12" data-simplebar="init">
                <div class="content services">
                    <div class="row service-items">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                            <div class="box-item article_info">
                                <div class="desc">
                                    <div class="category" id="testeditormdview">
                                        <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
                                        <link rel="stylesheet" href="/static/home/css/archives.css">
                                        <div class="demo">
                                            <div class="history">
                                                @foreach($arr as $k => $v)
                                                    <div class="history-date">
                                                        <ul class="cbp_tmtimeline">
                                                            <h2 class="@if($loop->first )first" style="position: relative;"@else date02"@endif>
                                                                <a href="javascript:;" class="nogo">
                                                                    {{ $k }}
                                                                    <i class="fa fa-sort-down"></i>
                                                                </a>
                                                                @if($loop->first)<span class="glyphicon glyphicon-time"></span> <span class="first">文章归档</span> @endif  </h2>
                                                            @foreach($v as $so)
                                                                <li>
                                                                    <h3>{{ $so->created_at->format('m-d') }}<span>{{ $so['stime'] }}</span></h3>
                                                                     <div class="cbp_tmlabel">
                                                                        <h2>
                                                                            <a data-url="{{ url("/article/". $so['id']) }}" href="javascript:;" class="contents">{{$so['title']}}</a>
                                                                        </h2>
                                                                        <p>
                                                                            {{ str_limit( trimall(strip_tags( $so['content']) ) , 130, '……') }}
                                                                        </p>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection