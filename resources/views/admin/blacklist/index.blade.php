@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>黑名单</h3>
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
                    <th>IP</th>
                    <th>拉黑时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @if( empty($black) )
                    <td colspan="9" class="text-center">
                        没有查询到相关信息
                    </td>
                @else
                    @foreach($black as $key => $v)
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
                                <td> {{ $v->ip }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td data-value="1">
                                    <a data-pjax href="{{ url("admin/blacklist/delete/$v->id") }}" class="btn btn-danger btn-icon btn-social btn-sm action-delete"><i class="fa fa-trash-o"></i><i class="create_i"> 删除 </i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                </tbody>
                <tfoot class="hide-if-no-paging">
                <tr>
                    <td colspan="5" class="text-center">
                        {{ $black->links() }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection