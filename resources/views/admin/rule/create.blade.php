@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>权限管理 > <a data-pjax href="/admin/rule">权限节点</a> > 添加</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/rule/create') }}">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>所属父级</label>
                                    <div class="form-item-content">
                                        <select class="form-control c-select m-y" data-parsley-id="31" name="pid">
                                            <option value="0">默认顶级</option>
                                            @foreach( $rule as $k => $v)
                                            <option
                                                value="{{ $v->id }}"
                                                @if( $v->level == 2)
                                                disabled
                                                @endif
                                            >
                                                @if( $v->level == 1) 　　├ {{ $v->title }}
                                                @elseif($v->level == 2)　　│　　├ {{ $v->title }}
                                                @else {{ $v->title }}
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>权限名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>权限节点</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>是否菜单</label>
                                    <div class="form-item-content">
                                        <select class="form-control c-select m-y" data-parsley-id="31" name="menu">
                                            <option value="0">是</option>
                                            <option value="1">否</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>节点图标</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" name="icon">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>排序</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" value="100" name="sorts">
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