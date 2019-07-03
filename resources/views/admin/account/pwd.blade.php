@extends('admin.layouts.common');
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3><a data-pjax href="{{ url('/admin/account/infop') }}"> 个人资料 </a> <i class="material-icons">&#xe315;</i> 修改密码</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" action="{{ url('/admin/account/uppwd') }}" method="post">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label> 原始密码：</label>
                                    <div class="form-item-content">
                                        <input type="password" class="form-control" required="原始密码不能为空…" name="ipas">
                                        <small class="text-muted"> </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> 新密码：</label>
                                    <div class="form-item-content">
                                        <input type="password" class="form-control" required name="password">
                                        <small class="text-muted"> </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> 确认密码：</label>
                                    <div class="form-item-content">
                                        <input type="password" class="form-control" required name="passwords">
                                        <small class="text-muted"> </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-item-content">
                        <button type="submit" class="btn info">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection