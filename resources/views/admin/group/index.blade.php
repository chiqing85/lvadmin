@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>角色列表</h3>
            </div>
            <div class="add">
                <a data-pjax href="{{ url('/admin/group/create') }}" class="btn btn-icon btn-social white btn-social-colored light-blue">
                    <i class="material-icons">&#xe145;</i>
                    <i class="create_i">添加</i>
                </a>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th> 角色名称 </th>
                        <th> 角色描述 </th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>最后更新</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group as $key => $v)
                        @if( $key%2 == 0)
                            <tr>
                        @else
                            <tr class="footable-odd">
                                @endif
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->title }}</td>
                                <td>{{ $v->describe }}</td>
                                <td>
                                    <label class="ui-switch m-t-xs m-r">
                                        <input type="checkbox"
                                               @if ($v->status)
                                               checked
                                               @endif
                                               class="has-value">
                                        <i></i>
                                    </label>
                                </td>
                                <td data-value="78025368997">{{ $v->created_at }}</td>
                                <td>{{ $v->updated_at }}</td>
                                <td data-value="1">
                                    <a data-pjax href="{{ url("admin/group/update/$v->id") }}" class="btn btn-icon btn-social white btn-sm info"><i class="fa fa-pencil"></i><i class="create_i"> 编辑 </i></a>
                                    <a data-pjax href="{{ url("admin/group/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                </td>
                            </tr>
                            @endforeach
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