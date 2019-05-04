@extends('home.layouts.base')
@section('contents')
<div class="row card-container">
    <div class="card-wrap col col-m-12 col-t-12 col-d-8 col-d-lg-12 container" data-simplebar>
        <div class="content blog">
            <!-- blog items -->
            <div class="containers">
                <style>
                    .links {
                        padding: 16px 28px;
                        text-align: right;
                    }
                    .links>.card-box {
                        padding: 5px 30px;
                    }
                    .pagination {
                        display: inline-block;
                        margin: 10px 0;
                        padding-left: 0;
                        border-radius: 4px;
                    }
                    .pagination>li {
                        display: inline;
                    }
                    .pagination>li>a, .pagination>li>span {
                        position: relative;
                        float: left;
                        padding: 6px 12px;
                        line-height: 1.6;
                        text-decoration: none;
                        color: #777777;
                        border: 1px solid #ffffff0d;
                        margin-left: -1px;
                    }
                    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
                        color: #777;
                        cursor: not-allowed;
                    }
                    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                        z-index: 3;
                        color: #fff;
                        background: #5ac24e;
                        cursor: default;
                    }
                    .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
                        z-index: 2;
                        color: #5ac24e;
                    }
                </style>
                @foreach($article as $v)
                    <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                        <div class="box-item card-box">
                            @if( $v->pic)
                            <div class="image">
                                <a data-url="{{url('/article/'.$v->id) }}" href="javascript:;" class="contents">
                                        <img src="{{ $v->pic }}" alt="" />
                                    <span class="info">
                                    <span class="icon la la-eye"></span>
                                </span>
                                    <span class="date">
                                        <strong>{{ $v->created_at->format('d') }}</strong>{{ $v->created_at->format('y-m') }}
                                    </span>
                                </a>
                            </div>
                            @endif
                            <div class="desc">
                                <a data-url="{{url('/article/'.$v->id) }}" href="javascript:;" class="name contents">
                                    <h1> {{ $v->title }}
                                        @if($v->flag) <span class="icon la la-leaf"></span> @endif
                                    </h1>
                                </a>
                                <div class="category">
                                    <p>
                                        {{ str_limit( trimall(strip_tags( $v->content) ) , 200, '……') }}
                                    </p>
                                </div>
                                <div class="post-meta">
                                    <i class="icon la la-user"> {{ $v->author }} </i>
                                    &nbsp; |&nbsp;
                                    <i class="icon la la-eye">&nbsp; {{ $v->number  }}</i>
                                    @if( empty($v->pic))
                                        <div class="pull-right"> {{ $v->created_at->format('y-m-d') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($article->lastPage() > 1)
                    <div class="links">
                        <div class="card-box">{{ $article->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection