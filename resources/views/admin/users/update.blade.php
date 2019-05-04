@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>权限管理 <i class="material-icons">&#xe315;</i><a data-pjax href="{{ url('/admin/users/') }}"> 用户列表 </a><i class="material-icons">&#xe315;</i> 添加</h3>
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
                                        <input type="text" class="form-control" required name="username" placeholder="请输入用户名…" value="{{ $Users->username }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="form-item-content">
                                        <input type="email" class="form-control" name="email" placeholder="邮箱…" value="{{ $Users->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>用户头像</label>
                                    <div class="form-item-content">
                                        <div class="ivu-upload" style="display: inline-block; width: 58px; border-radius: 100%;">
                                            <div class="ivu-upload ivu-upload-drag users">
                                                <input type="hidden" class="form-control file_img" name="pic" value="{{ $Users->pic }}">
                                                <input type="file" class="file-invisible file-users" accept="image/jpg,image/jpeg,image/png">
                                                <div style="width: 58px; height: 58px; line-height: 58px;">
                                                    @if( $Users->pic )
                                                    <img src="{{ $Users->pic }}" class="upload_img">
                                                    @else
                                                    <img src="" class="upload_img" style="display: none">
                                                    <i class="material-icons" style="line-height: 58px;">&#xe412;</i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection