@extends('home.layouts.base')
@section('contents')
<div class="row card-container">
    <div class="card-wrap col col-m-12 col-t-12 col-d-12 col-d-lg-12 container" data-simplebar>
        <div class="content blog">
            <!-- blog items -->
            <div class="containers">
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
                                    &nbsp; |&nbsp;
                                    <i class="icon la la-comment-o"> {{ $v->comment_count }}</i>
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