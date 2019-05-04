@extends('admin.layouts.common')
@section('content')
<div class="padding">
        <div class="box">
            <div class="box-header b-b">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>文章管理 <i class="material-icons">&#xe315;</i> <a data-pjax href="{{ url('/admin/article/') }}"> 文章列表 </a><i class="material-icons">&#xe315;</i> 编辑</h3>
            </div>
            <div class="box-body">
                <form ui-jp="parsley" id="form" method="post" action="{{ url('admin/article/update/'. $article->id) }}">
                    @csrf
                    <div id="rootwizard">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="form-group">
                                    <label>文章标题</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control" required name="title" placeholder="请输入文章标题…" value="{{ $article->title }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>栏目</label>
                                    <div class="form-item-content">
                                        <select class="form-control c-select m-y" data-parsley-id="31" name="pid">
                                            @foreach($AClass as $k => $v )
                                                <option
                                                    @if( $v->h_layer !== 0 )
                                                        disabled
                                                    @endif
                                                    value="{{ $v->id }}"
                                                    @if( $article->pid == $v->id )
                                                    selected
                                                    @endif
                                                >
                                                    @if( $v->level == 1) 　　├ {{ $v->name }}
                                                        @elseif($v->level == 2)　　│　　├ {{ $v->name }}
                                                        @else {{ $v->name }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>缩略图</label>
                                    <div class="form-item-content">
                                        <div class="ivu-upload" style="display: inline-block; width: 58px; border-radius: 100%;">
                                            <div class="ivu-upload ivu-upload-drag">
                                                <input type="hidden" class="form-control file_img" name="pic" value="{{ $article->pic }}">
                                                <input type="file" class="file-invisible file-upload article" accept="image/jpg,image/jpeg,image/png">
                                                <div style="width: 58px; height: 58px; line-height: 58px;">
                                                    <img class="upload_img" @if( !$article->pic )style="display: none"@else src="{{ $article->pic }}" @endif>
                                                    <i class="material-icons" style="line-height: 58px;">&#xe412;</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>内容</label>
                                    <div class="form-item-content">
                                        <div id="editor">
                                            <textarea>{{ $article['editor-markdown-doc'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>属性</label>
                                    <div class="form-item-content">
                                        <label class="md-check">
                                            <input type="checkbox" class="has-value" @if( $article->flag )checked @endif name="flag" value="1">
                                            <i class="blue"></i>
                                            置顶
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label>来源</label>
                                    <div class="form-item-content">
                                        <label class="md-check">
                                            <input type="radio" name="source" @if( !$article->source )checked @endif class="has-value" value="0">
                                            <i class="green"></i>
                                            原创
                                        </label>
                                        <label class="md-check">
                                            <input type="radio" name="source" @if($article->source )checked @endif class="has-value" value="1">
                                            <i class="green"></i>
                                            转载
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label></label>
                                    <div class="form-item-content tag">
                                        @if( !empty($article->keywords))
                                        @foreach( explode(',', $article->keywords ) as $v )
                                            <span class="tag accent"><span> {{ $v }} &nbsp;&nbsp;</span><a href="javascript:;" title="Removing tag">x</a></span>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label>关键词</label>
                                    <div class="form-item-content">
                                        <input type="hidden" name="keywords" class="keywords-tag" value="{{ $article->keywords }}">
                                        <input type="text" class="form-control keywords" placeholder="关键词回车添加…" onkeydown="return keys( event )">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>作者</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control has-value" name="author" value="{{ $article->author }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>访问量</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control has-value" name="number" value="{{ $article->number }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>排序</label>
                                    <div class="form-item-content">
                                        <input type="text" class="form-control has-value" name="sorts" data-parsley-id="23" value="{{ $article->sorts }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>状态</label>
                                    <div class="form-item-content">
                                        <label class="ui-switch m-t-xs m-r">
                                            <input
                                                type="checkbox"
                                                @if( $article->status )
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
<link rel="stylesheet" href="/static/editor/css/editormd.min.css">
<script>
$(function() {
    var testEditormd;
    testEditormd =  editormd("editor", {
        width: "100%",
        height: 500,
        path :  "/static/editor/lib/",
        // watch: false,
        toolbarIcons : function() {
            return ["undo", "redo", "|", "bold", "hr", "quote", "|", "h1", "h2", "h3", "h4", "h5","|", "list-ul", "list-ol",  "hr", "|", "link", "image", "code", "emoji",  "|","datetime", "clear",  "watch", "preview"]
        },
        htmlDecode: "style,script,iframe|on*", // 开启 HTML 标签解析，为了安全性，默认不开启
        emoji : true,
        // 开启上传图片功能
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL :"{{ url('/admin/upload/editor') }}",
        unselectable:'no',
        saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
        searchReplace : true,
        flowChart : true,             // 开启流程图支持，默认关闭
        sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
        tex: true,               // 默认不解析
    })
})
</script>
@endsection