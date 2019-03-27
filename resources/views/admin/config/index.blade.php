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
                                        <div style="color: rgb(170, 170, 170); font-size: 12px;">网站域名（如：http://www.google.com）,后面不带斜线</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>网站名称</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required>
                                        <div style="color: rgb(170, 170, 170); font-size: 12px;">网站标题</div>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label class="ui-check">
                                        <input type="checkbox" name="check" checked required="true">
                                        <i></i> I agree to the <a href="#" class="text-info">Terms of Service</a>
                                    </label>
                                </div>
                            </div>
                            <ul class="pager wizard">
                                <li class="previous first" style="display:none;"><a href="#">First</a></li>
                                <li class="previous"><a href="#">Previous</a></li>
                                <li class="next last" style="display:none;"><a href="#">Last</a></li>
                                <li class="next"><a href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-a col-md-2 col-md-offset-2">
                            <button type="submit" class="btn info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--<div data-v-3afddb59="" class="content-wrapper ivu-layout-content" style="height: calc(100%); overflow: auto; padding: 15px;">
    <div data-v-3afddb59="">
        <div class="ivu-card ivu-card-dis-hover ivu-card-shadow">
            <!----> <!---->
            <div class="ivu-card-body">
                <div class="form-wrapper">
                    <form autocomplete="off" class="ivu-form ivu-form-label-right"><div>
                            <div class="ivu-form-item">
                                <label class="ivu-form-item-label" style="width: 100px;">项目名称</label>
                                <div class="ivu-form-item-content" style="margin-left: 100px;">
                                    <!----><!---->
                                    <div class="ivu-input-wrapper ivu-input-wrapper-default ivu-input-type">
                                        <!----> <!---->
                                        <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                        <input autocomplete="off" spellcheck="false" type="text" placeholder="请输入项目名称" class="ivu-input ivu-input-default">
                                        <!---->
                                    </div>
                                    <div style="color: rgb(170, 170, 170); font-size: 12px;">请输入项目名称</div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ivu-form-item">
                                <label class="ivu-form-item-label" style="width: 100px;">项目口号</label>
                                <div class="ivu-form-item-content" style="margin-left: 100px;">
                                    <!----><!---->
                                    <div class="ivu-input-wrapper ivu-input-wrapper-default ivu-input-type">
                                        <!----> <!---->
                                        <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                        <input autocomplete="off" spellcheck="false" type="text" placeholder="请输入您的项目口号" class="ivu-input ivu-input-default"> <!----></div><div style="color: rgb(170, 170, 170); font-size: 12px;">请输入您的项目口号</div> <!----></div></div></div><div><div class="ivu-form-item"><label class="ivu-form-item-label" style="width: 100px;">项目logo</label> <div class="ivu-form-item-content" style="margin-left: 100px;"><!----><!----><!----><div style="color: rgb(170, 170, 170); font-size: 12px;">请上传系统logo</div> <!----></div></div></div><div><div class="ivu-form-item"><label class="ivu-form-item-label" style="width: 100px;">ICO图标</label> <div class="ivu-form-item-content" style="margin-left: 100px;"><!----><!----><!----><div style="color: rgb(170, 170, 170); font-size: 12px;">请上传ICO图标</div> <!----></div></div></div><div><div class="ivu-form-item"><label class="ivu-form-item-label" style="width: 100px;">版权信息</label> <div class="ivu-form-item-content" style="margin-left: 100px;"><!----><!----><div class="ivu-input-wrapper ivu-input-wrapper-default ivu-input-type"><!----> <!----> <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i> <input autocomplete="off" spellcheck="false" type="text" placeholder="请输入您的版权信息" class="ivu-input ivu-input-default"> <!----></div><div style="color: rgb(170, 170, 170); font-size: 12px;">请输入您的版权信息</div> <!----></div></div></div><div><div class="ivu-form-item"><label class="ivu-form-item-label" style="width: 100px;">备案号</label> <div class="ivu-form-item-content" style="margin-left: 100px;"><!----><!----><div class="ivu-input-wrapper ivu-input-wrapper-default ivu-input-type"><!----> <!----> <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i> <input autocomplete="off" spellcheck="false" type="text" placeholder="请输入您的域名备案号" class="ivu-input ivu-input-default"> <!----></div><div style="color: rgb(170, 170, 170); font-size: 12px;">请输入您的域名备案号</div> <!----></div></div></div><div><div class="ivu-form-item"><label class="ivu-form-item-label" style="width: 100px;">配置分组</label> <div class="ivu-form-item-content" style="margin-left: 100px;"><!----><!----><div class="ivu-input-wrapper ivu-input-wrapper-default ivu-input-type"><textarea wrap="soft" autocomplete="off" spellcheck="false" placeholder="请输入配置分组信息" rows="2" class="ivu-input" style="height: 73px; min-height: 52px; max-height: 115px; overflow-y: hidden;"></textarea></div><div style="color: rgb(170, 170, 170); font-size: 12px;">请输入配置分组信息</div> <!----></div></div></div><div><div class="ivu-divider ivu-divider-horizontal ivu-divider-default"><!----></div><div class="ivu-form-item" style="text-align: left;"><!----> <div class="ivu-form-item-content" style="margin-left: 100px;"><button type="button" class="ivu-btn ivu-btn-primary ivu-btn-large" style="margin-right: 15px;"><!----> <!----> <span>确认提交</span></button><button type="button" class="ivu-btn ivu-btn-text ivu-btn-large"><!----> <!----> <span>取消操作</span></button> <!----></div></div></div></form></div><div style="text-align: right; font-size: 12px; color: rgb(128, 134, 149); transform: scale(0.8);">via ibuilder</div></div></div></div></div>--}}
@endsection