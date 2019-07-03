@if(!$comment->isEmpty() )
<div class="lzl">
    @foreach( $comment as $c )
        <div class="resume-item zl_0">
            <div class="pic @if(empty( $c->name ))null @endif">
                @if($c->item_pic )
                    <img src="{{ $c->item_pic  }}" alt="">
                @else
                    <span class="w-40 r-2x _600 text-lg purple">{{ $c->item }}</span>
                @endif
            </div>
            <div class="coment">
                <div class="name">
                    @if( !empty($c->url))
                        <a href="{{ $c->url }}" target="_blank">
                            {{ empty( $c->name ) ? "匿名用户" : $c->name }}
                        </a>
                    @else
                        {{ empty( $c->name ) ? "匿名用户" : $c->name }}
                    @endif
                </div>
                <div class="date">{{ $c->created_at }}</div>
                <p>{{ $c->contents }}</p>
            </div>
            <div class="pull-right commentshare" data-id="{{ $c->id }}"><span class="icon la la-share"></span>  回复 </div>
        </div>
    @endforeach
    <div class="commentlzl">
        {{ $comment->appends(['spage' => 'votes'])->links() }}
    </div>
</div>
@endif