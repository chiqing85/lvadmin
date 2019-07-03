<div id="aside" class="app-aside modal nav-dropdown">
    <div class="left navside dark dk" data-layout="column">
        <div class="navbar no-radius">
            <a class="navbar-brand">
                <div ui-include="'/static/admin/images/logo.svg'"></div>
                <img src="/static/admin/images/logo.png" alt="." class="hide">
                <span class="hidden-folded inline">后台管理</span>
            </a>
        </div>
        <div class="hide-scroll" data-flex>
            <nav class="scroll nav-light">
                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Main</small>
                    </li>
                    @foreach( $aside as $k => $vo)
                    <li>
                        <a href="{{ $vo->name ? : 'javascript:;' }}" >
                            @if( count( $vo->level ) )
                            <span class="nav-caret">
                              <i class="fa fa-caret-down"></i>
                            </span>
                            @endif
                            <span class="nav-icon">
                              <i class="material-icons">{!! $vo->icon !!}</i>
                            </span>
                            <span class="nav-text">{{ $vo->title }}</span>
                        </a>
                        @if( count( $vo->level ) )
                            <ul class="nav-sub nav-mega nav-mega-3">
                                @foreach( $vo->level as $lv)
                                <li>
                                    <a href="{{ $lv->name ? : 'javascript:;' }}" >
                                        <span class="nav-text">{{ $lv->title }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="b-t">
            <div class="nav-fold">
                <a data-pjax href="{{ url('/admin/account/infop') }}">
        	    <span class="pull-left">
        	      <img src="{{ \Auth::user()->pic }}" alt="..." class="w-40 img-circle">
        	    </span>
                    <span class="clear hidden-folded p-x">
        	      <span class="block _500">{{ \Auth::user()->username }}</span>
        	      <small class="block text-muted">
                      <i class="fa fa-circle text-success m-r-sm"></i>
                      {{ \Auth::user()->group[0]['title'] }}
                  </small>
        	    </span>
                </a>
            </div>
        </div>
    </div>
</div>