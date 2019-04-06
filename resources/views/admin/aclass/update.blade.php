@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>文章管理 > <a data-pjax href="{{ url('/admin/aclass') }}">分类列表</a> >　添加分类</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/aclass/update/'.$aclass->id) }}">
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>分类模型</label>
                                    <div class="form-item-content">
                                        <select class="form-control c-select m-y" data-parsley-id="31" name="mid">
                                            @foreach(acmid() as $m)
                                                <option value="{{ $m['id'] }}">{{ $m['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>栏目名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="name" value="{{ $aclass->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>跳转链接</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" name="dirs" value="{{ $aclass->dirs }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>排序</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" value="{{ $aclass->sort }}" name="sort">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="form-item-content">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input
                                                    type="checkbox"
                                                    @if($aclass->status == 1)
                                                    checked
                                                    @endif
                                                    value="1"
                                                    class="has-value"
                                                    name="status"
                                            >
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    @csrf
                                    <input type="hidden" name="pid" value="{{ $aclass->pid }}">
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