<div class="app-header white box-shadow">
    <div class="navbar navbar-toggleable-sm flex-row align-items-center">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
            <i class="material-icons">&#xe5d2;</i>
        </a>

        <!-- navbar right -->
        <ul class="nav navbar-nav ml-auto flex-row">
            <li class="nav-item pos-stc-xs">
                <a href="{{ url('/') }}" class="nav-link mr-2 home">
                    <i class="material-icons">&#xe88a;</i>
                </a>
            </li>
            <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link mr-2 commentsCount" href data-toggle="dropdown">
                    <i class="material-icons">&#xe7f5;</i>
                    @if($CCS)<span class="label label-sm up warn CCS">{{ $CCS }}</span>@endif
                </a>
                <div class="dropdown-menu pull-right w-xl animated fadeInUp no-bg no-border">
                    <div class="scrollable" style="max-height: 220px">
                        <ul class="list-group list-group-gap m-a-0"></ul>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown users">
                <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="{{ \Auth::user()->pic }}" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <i></i>
                    <em></em>
                    <li><a data-pjax href="{{ url('/admin/account/infop/') }}">
                        <span class="fa fa-address-card-o pull-left"></span>个人资料</a></li>
                    <li><a data-pjax href="{{ url('admin/account/pwd') }}">
                          <span class="fa fa-key pull-left"></span>
                        修改密码</a></li>
                    <li><a data-pjax href="{{ url('/admin/logout') }}"><span class="fa fa-sign-out pull-left"></span>退出</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<style >
    .users .dropdown-menu {
        position: absolute;
        background: #fff;
        margin-top: 0;
        border: 1px solid #D9DEE4;
        -webkit-box-shadow: none;
        right: -.8rem !important;
        width: 10rem;
        top: 3.3rem;
    }
    .users ul.dropdown-menu i, ul.dropdown-menu em {
        position: absolute;
        left: 7.7rem;
        display: block;
        width: 0;
        height: 0;
        border: 10px dashed transparent;
        border-bottom: 10px solid #ccc;
    }
    .users ul.dropdown-menu i {
        top: -20px;
    }
    .users ul.dropdown-menu em {
        top: -19px;
        border-bottom-color: #fff;
    }

    span.clear.notices {
        width: 170px;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>