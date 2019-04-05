@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>文章分类</h3>
            </div>
            <div class="add">
                <a data-pjax href="/admin/aclass/create" class="btn btn-fw white">添加分类</a>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID </th>
                        <th> 分类名称 </th>
                        <th> 分类模型 </th>
                        <th>分类目录</th>
                        <th>排序</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( !$aclass )
                        <td colspan="8" class="text-center">
                            没有查询到相关信息
                        </td>
                    @else
                        @foreach($aclass as $key => $v)
                            @if( $key%2 == 0)
                                <tr @if($v->pid !== 0) style="display: none;" @endif class="pid_{{ $v->pid }}">
                            @else
                                <tr class="footable-odd pid_{{ $v->pid }}" @if($v->pid !== 0) style="display: none;" @endif>
                            @endif
                                    <td>
                                        @if($v->pid !== 0)
                                            @if($v->level == 2)
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @else
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                        @endif
                                           <a class="material-icons @if($v->h_layer == 0) ">&#xe15b; @else aclass-open" oid="{{ $v->id }}">&#xe145; @endif</a>
                                    </td>
                                    <td>{{ $v->id }}</td>
                                    <td>
                                        @if($v->pid !== 0)
                                            @if($v->level == 2)
                                                |--　|--　
                                            @else
                                                |-- 　
                                            @endif
                                        @endif
                                        {{ $v->name }}
                                    </td>
                                    <td>{{ acmid()[$v->mid]['name'] }}</td>
                                    <td> {{ $v->dirs }}</td>
                                    <td> {{ $v->sort }}</td>
                                    <td>
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox"
                                                   @if ($v->status)
                                                   checked
                                                   @endif
                                                   class="has-value"
                                            >
                                            <i></i>
                                        </label>
                                    </td>
                                    <td data-value="1">
                                        <a data-pjax href="{{ url("admin/aclass/create/$v->id") }}" class="btn btn-xs success"><i class="fa fa-pencil"></i> 添加子类 </a>
                                        <a data-pjax href="{{ url("admin/aclass/update/$v->id") }}" class="btn btn-xs info"><i class="fa fa-pencil"></i> 编辑 </a>
                                        <a data-pjax href="{{ url("admin/aclass/delete/$v->id") }}" class="btn btn-danger btn-xs action-delete"><i class="fa fa-trash-o"></i> 删除 </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.aclass-open').click(function () {
            var oid = $(this).attr('oid');
            if($(this).text() == ' ') {
                $(this).text(' ');
                $('.pid_'+ oid).show();
            } else {
                $(this).text(' ');
                var coid = $(".pid_"+oid + ' .aclass-open').attr('oid');
                if($(".pid_"+oid + ' .aclass-open').text() == " ") {
                    $(".pid_"+oid + ' .aclass-open').text(' ');
                }
                $('.pid_'+ coid).hide();
                $('.pid_'+ oid).hide();
            }
        });
    </script>
@endsection