@extends('admin.layouts.common')
@section('content')
<div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>系统设置</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form">
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>网站地址</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <small class="text-muted">网站域名（如：http://www.google.com）,后面不带斜线</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>网站名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <small class="text-muted">网站标题</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>网站LOGO</label>
                                    <div class="form-item-content">
                                        <div class="input-group">
                                                <input type="text" class="form-control">
                                                <span class="input-group-btn">
                                                <button class="btn white" type="button">Go!</button>
                                              </span>
                                        </div>
                                        <small class="text-muted">网站LOGO，一般用于导航或底部的LOGO图片</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>网站关键字</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <small class="text-muted">网站关键字，网站首页的【keywords】</small>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>网站描述</label>
                                    <div class="form-item-content">
                                        <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                        <small class="text-muted">网站描述，网站首页的【description】</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>版权信息</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <small class="text-muted">您网站的版权信息</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>备案号</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <small class="text-muted">域名备案号</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-item-content">
                        <button type="submit" class="btn info">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection