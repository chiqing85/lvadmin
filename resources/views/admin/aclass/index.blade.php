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
                    @if( $aclass->isEmpty() )
                        <td colspan="8" class="text-center">
                            没有查询到相关信息
                        </td>
                    @else
                        @foreach($rule as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                                    @endif
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->title }}</td>
                                    <td>{{ $v->name }}</td>
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
                                    <td data-value="78025368997">{{ $v->created_at }}</td>
                                    <td>{{ $v->updated_at }}</td>
                                    <td> {{ $v->sort }}</td>
                                    <td data-value="1">
                                        <a data-pjax href="{{ url("admin/rule/update/$v->id") }}" class="btn btn-xs info"><i class="fa fa-pencil"></i> 编辑 </a>
                                        <a data-pjax href="{{ url("admin/rule/delete/$v->id") }}" class="btn btn-danger btn-xs action-delete"><i class="fa fa-trash-o"></i> 删除 </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="6" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection