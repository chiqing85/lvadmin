@extends('admin.layouts.common')
@section('content')
<div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>系统设置</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" action="{{ url("/admin/config/update") }}">
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                @foreach ( $config as $k => $v)
                                    <div class="form-group">
                                        <label> {{ $v->desc }}</label>
                                        <div class="form-item-content">
                                            @if( $v->texttype == 'text')
                                                <input type="text" class="form-control" name="{{ $v->k }}" placeholder="{{ $v->v }}">
                                            @elseif($v->texttype == "file")
                                                <div class="input-group">
                                                    <div class="ivu-upload" style="display: inline-block; width: 58px;">
                                                        <div class="ivu-upload ivu-upload-drag">
                                                            <input type="hidden" class="form-control file_img" name="{{ $v->k }}" placeholder="{{ $v->v }}">
                                                            <input type="file" class="file-invisible file-config upload" accept="image/jpg,image/jpeg,image/png">
                                                            <div style="width: 58px; height: 58px; line-height: 58px;">
                                                                @if( $v->v )
                                                                    <img src="{{ $v->v }}" class="upload_img">
                                                                @else
                                                                <img src="" class="upload_img" style="display: none">
                                                                <i class="material-icons" style="line-height: 58px;">&#xe412;</i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                     </div>
                                                </div>
                                            @elseif( $v->texttype == "textarea")
                                                <textarea name="{{ $v->k }}" id="" cols="30" rows="3" class="form-control" placeholder="{{ $v->v }}"></textarea>
                                            @endif
                                                <small class="text-muted"> {{ $v->prompt }}</small>
                                        </div>
                                    </div>
                                @endforeach
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