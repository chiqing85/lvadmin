@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>友情链接</h3>
            </div>
            <div class="add">
                <a data-pjax href="{{url('/admin/links/create')}}" class="btn btn-icon btn-social white btn-social-colored light-blue">
                    <i class="material-icons">&#xe145;</i>
                    <i class="create_i">添加</i>
                </a>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th> 中文域名 </th>
                        <th> 域名 </th>
                        <th>是否显示</th>
                        <th>排序</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( $link->isEmpty() )
                        <td colspan="7" class="text-center">
                            没有查询到相关信息
                        </td>
                    @else
                        @foreach($link as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                                    @endif
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->link_name }}</td>
                                    <td><a href="{{ $v->link_url }}" target="_blank">{{ $v->link_url }}</a></td>
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
                                    <td>{{ $v->sorts }}</td>
                                    <td> {{ $v->created_at }}</td>
                                    <td data-value="1">
                                        <a data-pjax href="{{ url("admin/links/update/$v->id") }}" class="btn btn-icon btn-social white btn-sm info"><i class="fa fa-pencil"></i><i class="create_i"> 编辑 </i></a>
                                        <a data-pjax href="{{ url("admin/links/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="7" class="text-center">
                            {{ $link->links() }}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection