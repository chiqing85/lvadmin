@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>权限管理 <i class="material-icons">&#xe315;</i><a data-pjax href="{{ url('/admin/users/') }}"> 用户列表 </a><i class="material-icons">&#xe315;</i> 编辑</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/users/update/'. $Users->id) }}">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>用户名</label>
                                    <div class="form-item-content">
                                        <p class="Uup">{{ $Users->username }}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label>所属角色</label>
                                    <div class="form-item-content">
                                        <span class="form-check users">
                                            @foreach( $group as $k => $v)
                                            <label class="md-check">
                                                <input
                                                    type="checkbox"
                                                    class="has-value"
                                                    @foreach ($Users->group as $role )
                                                         @if($role->pivot->group_id === $v->id )
                                                            checked
                                                        @endif
                                                    @endforeach
                                                    name="group[]"
                                                    value="{{ $v->id }}"
                                                >
                                                <i class="blue"></i> {{ $v->title }}
                                            </label>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="form-item-content">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input
                                                type="checkbox"
                                                @if( $Users->status == 1)
                                                checked
                                                @endif
                                                value="1"
                                                class="has-value"
                                                name="status">
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="form-item-content">
                                        <button type="submit" class="btn info">提交</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .Uup {
            padding: 10px 9pt 10px 0;
        }
    </style>
@endsection