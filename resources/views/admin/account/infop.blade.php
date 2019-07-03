@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>个人资料</h3>
            </div>
            <div class="box-body">
                <div class="clearfix">
                    <div class="userpic form-item-content form-group">
                        <a href="javascript:;" class="adimgUp">
                            @if( $user->pic )
                            <img src="{{ $user->pic }}" class="upload_img">
                            @else
                            <img src="" class="upload_img" style="display: none">
                            <i class="material-icons" style="line-height: 80px;font-size: 35px;">&#xe412;</i>
                            @endif
                            <div class="backdrop"></div>
                            <span>更换头像</span>
                            <input type="file" class="file-invisible file-users hidden" accept="image/jpg,image/jpeg,image/png">
                        </a>
                    </div>
                    <div class="form-group">
                        <label> 用户名：</label>
                        <div class="form-item-content info_p">
                            <user class="info_p_i"> <span class="usSpan p_text">{{ $user->username }}</span><input type="text" class="form-control cName" name="username" value="{{ $user->username }}" data-parsley-id="20" style="display: none;"> </user>
                            <a href="javascript:;" class="penbtn editName">修改</a>
                            <a href="javascript:;" class="penbtns changeUserName" style="display: none;">保存</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="member-index-account">
                        <h4>账号安全</h4>
                        <div class="bodyWrap">
                            <div class="form-group">
                                <label> 登录密码：</label>
                                <div class="form-item-content info_p">
                                    <div>
                                        <b class="ge_02"> {{ $user->password ? '已设置' : '未设置' }}</b>
                                        <a data-pjax href="{{ url('admin/account/pwd') }}" class="modify">修改</a>
                                    </div>
                                    <small class="text-muted"> 安全性高的密码可以使账号更安全。建议您设置一个包含数字和字母，并长度超过6位以上的密码。</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> 邮箱：</label>
                            <div class="form-item-content info_p">
                                <div>
                                    <b class="ge_02 p_text">{{ $user->email ? $user->email : '未绑定'}}</b>
                                    <input type="text" class="form-control" name="email" value="@if( $user->email ){{ $user->email }}@endif" data-parsley-id="20" style="display: none;">
                                    <a href="javascript:;" class="penbtn modify">修改</a>
                                    <a href="javascript:;" class="penbtns changeUserName" style="display: none;">保存</a>
                                </div>
                                <small class="text-muted"> 绑定后可通过邮箱找回密码、消息回复提醒！</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .adimgUp {
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            outline: none;
            position: relative;
            border: 1px dashed #dcdee2;
            text-align: center;
            overflow: hidden;
        }
        .backdrop {
            width: 80px;
            height: 80px;
            background: black;
            position: absolute;
            top: 0;
            border-radius: 50%;
            opacity: 0;
        }
        a.adimgUp span {
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            color: #ffffff;
            display: none;
        }
        a.adimgUp:hover .backdrop {
            opacity: .4;
        }
        a.adimgUp>img {
            vertical-align: sub;
        }
        a.adimgUp:hover span {
            display: inline;
        }
        .info_p {
            line-height: 38px;
        }
        .info_p_i {
            display: inline
        }
        .info_p a {
            color: #61a6d6;
        }
        input.form-control {
            display: inline-block;
            margin-right: 15px;
            width: 180px;
        }

        .member-index-account>h4 {
            font-size: 18px;
            padding-left: 15px;
            border-left: 4px solid #3eb5f6;
        }
    </style>
@endsection