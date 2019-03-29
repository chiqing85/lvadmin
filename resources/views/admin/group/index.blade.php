@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>用户列表</h3>
            </div>
            <div class="add">
                <button class="btn btn-fw white">添加用户</button>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th> 用户名 </th>
                        <th> 用户头像 </th>
                        <th>用户角色</th>
                        <th>注册时间</th>
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
                                <td></td>
                                <td></td>
                                <td data-value="78025368997">{{ $v->created_at }}</td>
                                <td data-value="1">
                                    <a class="btn btn-xs info"><i class="fa fa-pencil"></i> 编辑 </a>
                                    <a data-url="" class="btn btn-danger btn-xs action-delete"><i class="fa fa-trash-o"></i> 删除 </a>
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