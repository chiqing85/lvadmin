@extends('home.layouts.base')
@section('contents')
<div class="card-inner active" id="about-card">
    <div class="row card-container">
        <link rel="stylesheet" href="/static/editor/css/editormd.min.css">
        <div class="card-wrap col col-m-12 col-t-12 col-d-8 col-d-lg-12" data-simplebar="init">
            <div class="content services post">
                <div class="row">
                    <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                        <div class="title">
                            <a href="/" class="top-menu"> 首页 </a>
                            <span> / </span>
                            <a data-url="{{ url('/categories/' . $article->aclass->dirs) }}" href="javascript:;" class="contents">{{ $article->aclass->name }}</a>
                            <span> / </span>
                            {{ $article->title }}
                        </div>
                    </div>
                </div>
                <div class="row service-items">
                    <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                        <div class="box-item article_info">
                            <h1>{{ $article->title }} </h1>
                            <div class="post-meta">
                                <i class="icon la la-user"> {{ $article->author }} </i>
                                &nbsp; |&nbsp;
                                <i class="icon la la-anchor"> {{ $article->source ? '转载' : '原创' }}</i>
                                &nbsp; |&nbsp;
                                <i class="icon la la-eye">&nbsp; {{ $article->number  }}</i>
                            </div>
                            <div class="desc">
                                <div class="category" id="testeditormdview">
                                    {!! $article->content  !!}
                                </div>
                                <div class="pull-left">
                                    <i class="icon la la-tag"></i>
                                    @foreach($article->keywords as $k => $v )
                                    <a href="/tag/{{ $v }}"> {{ $v }} </a>
                                    @endforeach
                                </div>
                                <div class="timeline pull-right">{{ $article->created_at }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                        <div class="resume-items card-box comments">
                            <div class="resume-item">
                                <div class="pull-right">
                                    <span class="icon la la-pencil"></span>&nbsp;评论
                                </div>
                            </div>
                            <!-- resume item -->
                            @if( empty( $comment ) )
                                <div class="comment_null">没有评论，快来抢沙发吧…</div>
                            @else
                                @foreach($comment as $v)
                                    <div class="resume-item @if($v->level )zl_0 @endif ">
                                        <div class="pic @if(empty( $v->name ))null @endif">
                                            @if($v->item_pic )
                                                <img src="{{ $v->item_pic  }}" alt="">
                                            @else
                                                <span class="w-40 r-2x _600 text-lg purple">
                                                {{ $v->item }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="coment">
                                            <div class="name">
                                                @if( !empty($v->url))
                                                    <a href="{{ $v->url }}" target="_blank">
                                                        {{ empty( $v->name ) ? "null" : $v->name }}
                                                    </a>
                                                @else
                                                    {{ empty( $v->name ) ? "null" : $v->name }}
                                                @endif
                                            </div>
                                            <div class="date">{{ $v->created_at }}</div>
                                            <p>{{ $v->contents }}</p>
                                        </div>
                                        <div class="comment_right">
                                            <div class="pull-right commentshare" data-id="{{ $v->id }}"><span class="icon la la-share"></span>  回复 </div>
                                        </div>
                                    </div>
                            @endforeach
                            @endif
                            <!-- resume item -->
                            <div class="resume-item">
                                <form id="cform" novalidate="novalidate" data-action="{{url('/comments/article')}}">
                                    <div class="row">
                                        <div class="col col-m-12 col-t-6 col-d-6 col-d-lg-4">
                                            <div class="group-val">
                                                <input type="text" name="name" placeholder="昵称（*）">
                                            </div>
                                        </div>
                                        <div class="col col-m-12 col-t-6 col-d-6 col-d-lg-4">
                                            <div class="group-val">
                                                <input type="text" name="email" placeholder="邮箱（*）">
                                            </div>
                                        </div>
                                        <div class="col col-m-12 col-t-6 col-d-6 col-d-lg-4">
                                            <div class="group-val">
                                                <input type="text" name="url" placeholder="站点（*）">
                                            </div>
                                        </div>
                                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                                            <div class="group-val">
                                                <textarea name="contents" placeholder="写点什么吧！" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="align-right">
                                        <input type="hidden" name="modelid" value="1">
                                        <input type="hidden" name="articleid" value="{{  $article->id }}">
                                        <a href="javascript:;" class="article_button">
                                            <span class="text">
                                                提交
                                            </span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection