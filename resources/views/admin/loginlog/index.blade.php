@extends('admin.layouts.common')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-fw fa-circle text-info"></i>
                <h3>登录日志</h3>
            </div>
            <div>
                <table class="table table-bordered m-0">
                    <thead>
                    <tr>
                        <th>ID </th>
                        <th> 用户 </th>
                        <th> IP </th>
                        <th>位置</th>
                        <th>登录时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( $loginlog->isEmpty() )
                        <td colspan="5" class="text-center">
                            没有查询到相关信息
                        </td>

                    @else
                        @foreach($loginlog as $key => $v)
                            @if( $key%2 == 0)
                                <tr>
                            @else
                                <tr class="footable-odd">
                                    @endif
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->user->username }}</td>
                                    <td>{{ $v->ip }}</td>
                                    <td>{{ $v->location }}</td>
                                    <td> {{ $v->created_at }}</td>
                                </tr>
                                @endforeach
                            @endif
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                        <tr>
                            <td colspan="6" class="text-center">
                                {{ $loginlog->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection