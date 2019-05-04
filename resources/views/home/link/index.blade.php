@extends('home.layouts.base')
@section('contents')
    <div class="card-inner active" id="about-card">
        <div class="row card-container">
            <style>
               .links {
                   text-align: left;
               }
                .link a:link, .link a:visited {
                    opacity: 1;
                    transition: all .15s linear;
                }
               .title {
                   padding-bottom: 1rem;
                   border-bottom: 1px solid #ffffff0d;
               }
                .friends {
                    line-height: normal;
                    padding: 8px 10px 8px 45px;
                    display: inline-block;
                    background: #fafafa;
                    border: 1px solid #f0f0f0;
                    margin: 0 18px 18px 0;
                    border-radius: 3px;
                    color: rgba(0,0,0,.54);
                    font-size: 14px;
                    position: relative;
                }
                .post .post-content img {
                    max-width: 100%;
                    height: auto;
                    vertical-align: middle;
                }

               .link_pic {
                    width: 36px;
                    height: 36px;
                    line-height: 36px;
                    position: absolute;
                    left: 0;
                    top: 0;
                    padding: 0!important;
                   overflow: hidden;
                }
            </style>
            <div class="card-wrap col col-m-12 col-t-12 col-d-8 col-d-lg-12" data-simplebar="init">
                <div class="content services post">
                    <div class="row">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                            <div class="title">
                                <a href="/" class="top-menu"> 首页 </a>
                                <span> / </span>
                                <a data-url="{{ url('/link/') }}" href="javascript:;" class="contents">我的邻居</a>
                            </div>
                        </div>
                    </div>
                    <div class="row service-items">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                            <div class="box-item article_info link">
                                <div class="post-content markdown-body" itemprop="articleBody">
                                    <div class="links">
                                        @foreach($link as $v)
                                        <a href="{{ $v->link_url }}" title="{{ $v->link_name }}" target="_blank" class="friends">
                                            <div class="link_pic">
                                                <img src="@if(!empty( $v->logo) ){{$v->logo}}@else/static/images/visitor.png @endif">
                                            </div>
                                            {{ $v->link_name }}
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection