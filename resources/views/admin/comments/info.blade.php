@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>留言管理<i class="material-icons">&#xe315;</i> <a data-pjax href="{{ url('/admin/contacts/') }}"> 反馈列表 </a><i class="material-icons">&#xe315;</i> 预览</h3>
            </div>
            <div class="row p-a">
                <div class="add col-sm-5"></div>
                <div class="col-sm-4"> </div>
                <div class="col-sm-3">
                    <div class="pull-right">
                        <a data-pjax href="{{ url('/admin/contacts/') }}">
                            <i class="fa fa-reply"></i>
                            &nbsp;返回
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box row-col" style="min-height:450px">
                    <div class="box-header b-b">
                        <strong>反馈内容</strong>
                    </div>
                    <div class="row-row dker">
                        <div class="row-body">
                            <div class="row-inner">
                                <div class="p-a-md">
                                    @if($contacts)
                                    <div class="m-b">
                                        <a href class="pull-left w-40 m-r-sm">
                                            @if( $contacts->item_pic)
                                                <img src="{{ $contacts->item_pic }}" class="w-full img-circle">
                                            @else
                                                <span class="w-40 _400 rounded @if($contacts->name) blue @else null @endif ">{{ $contacts->item }}</span>
                                            @endif
                                        </a>
                                        <div class="clear">
                                            <div class="text-muted text-xs m-t-xs"> {{ $contacts->name ? $contacts->name : '匿名用户' }} {{ $contacts->created_at->format('m-d H:i') }}</div>
                                            <div class="m-t-xs">
                                                <div class="p-a p-y-sm dark-white inline r">
                                                    {{ $contacts->contents }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(!$Feedback->isEmpty())
                                        @foreach( $Feedback as $k => $v)
                                            <div class="m-b">
                                                <a href class="pull-right w-40 m-l-sm">
                                                    @if( $v->item_pic)
                                                        <img src="{{ $v->item_pic }}" class="w-full img-circle">
                                                    @else
                                                        <span class="w-40 _400 rounded @if($v->name) blue @else null @endif ">{{ $v->item }}</span>
                                                    @endif
                                                </a>
                                                <div class="clear text-right">
                                                    <div class="text-muted text-xs m-t-xs">{{ $v->created_at->format('m-d H:i') }} {{ $v->name ? $v->name : '匿名用户' }} </div>
                                                    <div class="p-a p-y-sm info inline text-left r">
                                                        {!! $v->contents !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer b-t">
                        <form data-action="{{ url('admin/contacts/reply') }}" id="contacts">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="contents" class="form-control" placeholder="您可以在此输入信息进行回复……">
                                <input type="hidden" name="parentid" value="{{ $contacts->id }}">
                                <span class="input-group-btn">
                                    <button class="btn white b-a no-shadow info contacts" type="button"><i class="fa fa-paper-plane"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection