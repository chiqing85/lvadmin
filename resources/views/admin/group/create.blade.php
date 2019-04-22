@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>权限管理 > <a data-pjax href="{{ url('/admin/group/') }}">角色列表</a> > 添加</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/group/create') }}">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>角色名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="title" placeholder="请输入角色名称…">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>角色描述</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="describe" placeholder="请输入法角色描述…">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>分配权限</label>
                                    <div class="form-item-content">
                                        <span class="form-check">
                                            @foreach( $rule as $k => $v)
                                                <div class="md-check left_{{ $v->level }}">
                                                    <input type="checkbox" class="has-value" name="rules[]" value="{{ $v->id }}">
                                                    <i class="blue"></i> {{ $v->title }}
                                                </div>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="form-item-content">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox" checked value="1" class="has-value" name="status">
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