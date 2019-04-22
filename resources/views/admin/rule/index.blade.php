@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>权限节点</h3>
            </div>
            <div class="add">
                <a data-pjax href="{{ url('/admin/rule/create') }}" class="btn btn-icon btn-social white btn-social-colored light-blue">
                    <i class="material-icons">&#xe145;</i>
                    <i class="create_i">添加</i>
                </a>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th> 权限名称 </th>
                        <th> 权限节点 </th>
                        <th>节点图标</th>
                        <th>是否菜单</th>
                        <th>状态</th>
                        <th>添加时间</th>
                        <th>最后更新</th>
                        <th>排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( $rule->isEmpty() )
                        <td colspan="8" class="text-center">
                            没有查询到相关信息
                        </td>
                    @else
                        @foreach($rule['items'] as $key => $v)
                        @if( $key%2 == 0)
                            <tr>
                        @else
                            <tr class="footable-odd">
                                @endif

                                <td>
                                    @if( $v->level == 1) 　　├ {{ $v->title }}
                                    @elseif($v->level == 2)　　│　　├ {{ $v->title }}
                                    @else {{ $v->title }}
                                    @endif
                                </td>
                                <td>{{ $v->name }}</td>
                                <td> <i class="material-icons">{!! $v->icon !!}</i></td>
                                <td>
                                    @if ($v->menu)
                                        <span class="label red">否</span>
                                    @else
                                        <span class="label green">是</span>
                                    @endif
                                </td>
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
                                <td> {{ $v->sorts }}</td>
                                <td data-value="1">
                                    <a data-pjax href="{{ url("admin/rule/update/$v->id") }}" class="btn btn-icon btn-social white btn-sm info"><i class="fa fa-pencil"></i><i class="create_i"> 编辑 </i></a>
                                    <a data-pjax href="{{ url("admin/rule/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                </td>
                            </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection