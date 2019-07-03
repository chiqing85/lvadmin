@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>反馈列表</h3>
            </div>
            <div class="row p-a">
                <div class="add col-sm-5">
                    <a data-url="{{ url('/admin/comments/delete') }}" class="btn btn-icon btn-social btn-social-colored btn-danger deletec">
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
                    <th>昵称</th>
                    <th>反馈内容</th>
                    <th>邮箱</th>
                    <th>状态</th>
                    <th>IP</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @if( empty($contacts) )
                    <td colspan="9" class="text-center">
                        没有查询到相关信息
                    </td>
                @else
                    @foreach($contacts as $key => $v)
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
                                <td>{{  $v->name ? $v->name : 'NULL' }} </td>
                                <td> {{ $v->contents }}</td>
                                <td>
                                    {{ $v->email }}
                                </td>
                                <td>
                                    <span class="label
                                    @if( $v->status == -1)
                                            dark">已拉黑
                                        @elseif( $v->status == 0)
                                            warn"> 未审
                                        @elseif($v->status == -2 )
                                            ">待审核
                                        @elseif($v->status ==1 )
                                            success"> 通过
                                        @endif
                                    </span>
                                </td>
                                <td> {{ $v->ip }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td data-value="1">
                                    <a data-pjax href="{{ url("admin/contacts/info/$v->id")}}" target="_blank" class="btn btn-icon btn-social white btn-sm info"><i class="fa fa-share"></i><i class="create_i">  回复 </i></a>
                                    <a data-pjax href="javascript:;" data-url="{{ url("admin/comments/review/$v->id") }}" class="btn btn-icon btn-social white btn-sm accent edit"><i class="fa fa-dot-circle-o"></i><i class="create_i">  审核 </i></a>
                                    <a data-pjax href="{{ url("admin/contacts/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                </tbody>
                <tfoot class="hide-if-no-paging">
                <tr>
                    <td colspan="10" class="text-center">
                        {{ $contacts->links() }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection