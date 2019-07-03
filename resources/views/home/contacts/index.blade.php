@extends('home.layouts.base')
@section('contents')
  <div class="card-inner active" id="about-card">
        <div class="row card-container">
            <div class="card-wrap col col-m-12 col-t-12 col-d-12 col-d-lg-12" data-simplebar="init">
                <div class="content services">
                    <div class="row">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                            <div class="title">
                                <a href="/" class="top-menu"> 首页 </a>
                                <span> / </span>
                                <a data-url="{{ url('/contacts/') }}" href="javascript:;" class="contents">联系博主</a>
                            </div>
                        </div>
                    </div>
                    {{--<div class="resume-items card-box comments">
                        <div class="resume-item">
                            <div class="pull-right">
                                <span class="icon la la-pencil"></span>&nbsp;评论
                            </div>
                        </div>
                        <!-- resume item -->
                        @if(  $comment->isEmpty() )
                            <div class="comment_null">没有评论，快来抢沙发吧…</div>
                        @else
                            <div class="comment_item">
                                @foreach($comment as $v)
                                    <div class="resume-item parent" data-parent="{{ $v->id }}" id="{{ $v->id }}">
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
                                                        {{ empty( $v->name ) ? "匿名用户" : $v->name }}
                                                    </a>
                                                @else
                                                    {{ empty( $v->name ) ? "匿名用户" : $v->name }}
                                                @endif
                                            </div>
                                            <div class="date">{{ $v->created_at }}</div>
                                            <p>{{ $v->contents }}</p>
                                        </div>
                                        <div class="pull-right commentshare" data-id="{{ $v->id }}"><span class="icon la la-share"></span>  回复 </div>
                                        {!! Article::lzl( $v->id ) !!}
                                    </div>
                                @endforeach
                                @if( $comment->lastPage() > 1)
                                    <div class="comment">
                                        {{ $comment->links() }}
                                    </div>
                                @endif
                            </div>
                    @endif
                    <!-- resume item -->
                        <div class="resume-item">
                            <form id="cform" novalidate="novalidate" data-action="{{url('/comments/article')}}">
                                <div class="row">
                                    <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-4">
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
                    </div>--}}
                    <div class="row service-items">
                        <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">

                            <div class="box-item article_info">
                                <div class="resume-item">
                                    <form id="cform" novalidate="novalidate" data-action="{{url('/comments/contacts')}}">
                                        <div class="row">
                                            <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-4">
                                                <div class="group-val">
                                                    <input type="text" name="name" placeholder="昵称" required>
                                                </div>
                                            </div>
                                            <div class="col col-m-12 col-t-6 col-d-6 col-d-lg-4">
                                                <div class="group-val">
                                                    <input type="text" name="email" placeholder="邮箱" required>
                                                </div>
                                            </div>
                                            <div class="col col-m-12 col-t-6 col-d-6 col-d-lg-4">
                                                <div class="group-val">
                                                    <input type="text" name="url" placeholder="站点（*）">
                                                </div>
                                            </div>
                                            <div class="col col-m-12 col-t-12 col-d-12 col-d-lg-12">
                                                <div class="group-val">
                                                    <textarea name="contents" placeholder="内容……" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="align-right">
                                            <input type="hidden" name="modelid" value="0">
                                            <input type="hidden" name="articleid" value="0">
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