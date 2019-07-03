@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>文章列表</h3>
            </div>
            <div class="row p-a">
                <div class="add col-sm-5">
                    <a data-pjax href="{{ url('/admin/article/create') }}" class="btn btn-icon btn-social white btn-social-colored light-blue">
                        <i class="material-icons">&#xe145;</i>
                        <i class="create_i">添加</i>
                    </a>

                    <a data-url="{{ url('/admin/article/delete') }}" class="btn btn-icon btn-social btn-social-colored btn-danger deletec">
                        <i class="fa fa-trash-o"></i>
                        <i class="create_i">删除</i>
                    </a>
                </div>
                <div class="col-sm-4"> </div>
                <div class="col-sm-3">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                        <span class="input-group-btn">
                        <button class="btn b-a white" type="button">
                            <i class="material-icons">&#xe8b6;</i>
                        </button>
                    </span>
                    </div>
                </div>
            </div>
            <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th width="35">
                            <label class="md-check active">
                                <input type="checkbox" class="has-value" id="ACheck">
                                <i class="blue"></i>
                            </label>
                        </th>
                        <th> ID </th>
                        <th>标题</th>
                        <th>栏目</th>
                        <th>作者</th>
                        <th>状态</th>
                        <th>点击量</th>
                        <th>排序</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( empty($artic) )
                        <td colspan="9" class="text-center">
                            没有查询到相关信息
                        </td>
                    @else
                        @foreach($artic as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                            @endif
                                    <td>
                                        <label class="md-check active">
                                            <input type="checkbox" class="has-value checkbox_all" value="{{ $v->id }}" name="id[]">
                                            <i class="blue"></i>
                                        </label>
                                    </td>
                                    <td> {{ $v->id }}</td>
                                    <td>{{ $v->title }}</td>
                                    <td>{{ $v->aclass->name }}</td>
                                    <td> {{ $v->author }}</td>
                                    <td>
                                        <label class="ui-switch m-t-xs m-r">
                                            <input type="checkbox"
                                               @if ($v->status)
                                               checked
                                               @endif
                                               class="has-value change"
                                               data-value="{status: {{ $v->status ? 0 : 1 }} }"
                                               data-url="{{ url("admin/article/edit/$v->id") }}"
                                            >
                                            <i></i>
                                        </label>
                                    </td>
                                   <td>{{ $v->number }}</td>
                                    <td> {{ $v->sorts }}</td>
                                    <td data-value="78025368997">{{ $v->created_at }}</td>
                                    <td data-value="1">
                                        <a href="{{ url("/article/$v->id") }}" class="btn btn-icon btn-social white btn-sm success" target="_blank"><i class="fa fa-eye"></i><i class="create_i"> 预览 </i></a>
                                        <a data-pjax href="{{ url("admin/article/update/$v->id") }}" class="btn btn-icon btn-social white btn-sm info"><i class="fa fa-pencil"></i><i class="create_i"> 编辑 </i></a>
                                        <a data-pjax href="javascript:;" data-value="{flag: {{ $v->flag ? 0 : 1 }} }" data-url="{{ url("admin/article/edit/$v->id") }}" class="btn btn-icon btn-social white btn-sm edit
                                            @if ($v->flag == 0)
                                                accent"> <i class="fa fa-arrow-circle-up"></i><i class="create_i"> 置顶 </i>
                                            @else
                                               warn"> <i class="fa fa-arrow-circle-down"></i><i class="create_i"> 取消 </i>
                                            @endif
                                        </a>
                                        <a data-pjax href="{{ url("admin/article/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                        <tr>
                            <td colspan="10" class="text-center">
                                {{ $artic->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
@endsection