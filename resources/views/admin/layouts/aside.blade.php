<div id="aside" class="app-aside modal nav-dropdown">
    <!-- fluid app aside -->
    <div class="left navside dark dk" data-layout="column">
        <div class="navbar no-radius">
            <!-- brand -->
            <a class="navbar-brand">
                <div ui-include="'/static/admin/images/logo.svg'"></div>
                <img src="/static/admin/images/logo.png" alt="." class="hide">
                <span class="hidden-folded inline">后台管理</span>
            </a>
            <!-- / brand -->
        </div>
        <div class="hide-scroll" data-flex>
            <nav class="scroll nav-light">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Main</small>
                    </li>
                    <li>
                        <a href="/admin" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe3fc;
                        <span ui-include="'/static/admin/images/i_0.svg'"></span>
                      </i>
                    </span>
                            <span class="nav-text">后台首页</span>
                        </a>
                    </li>

                    <li>
                        <a>
                            <span class="nav-caret">
                              <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                              <i class="material-icons">
                                  &#xe5c3;
                                  <span ui-include="'/static/admin/images/i_1.svg'"></span>
                              </i>
                            </span>
                            <span class="nav-text">系统</span>
                        </a>
                        <ul class="nav-sub config">
                            <li class="active">
                                <a href="/admin/config">
                                    <span class="nav-text">系统设置</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/links">
                                    <span class="nav-text">友情链接</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/login_log">
                                    <span class="nav-text">登录日志</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/cache">
                                    <span class="nav-text">清除缓存</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <span class="nav-caret">
                              <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-icon">
                              <i class="material-icons">&#xe8d2;
                                <span ui-include="'/static/admin/images/i_3.svg'"></span>
                              </i>
                            </span>
                            <span class="nav-text">权限管理</span>
                        </a>
                        <ul class="nav-sub nav-mega nav-mega-3">
                            <li>
                                <a href="/admin/users" >
                                    <span class="nav-text">用户列表</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/group" >
                                    <span class="nav-text">角色列表</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/rule" >
                                    <span class="nav-text">权限节点</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a>
                            <span class="nav-caret">
                              <i class="fa fa-caret-down"></i>
                            </span>
                            <span class="nav-label">
                              <b class="label label-sm accent">8</b>
                            </span>
                            <span class="nav-icon">
                              <i class="material-icons">&#xe429;
                                <span ui-include="'/static/admin/images/i_4.svg'"></span>
                              </i>
                            </span>
                            <span class="nav-text">文章管理</span>
                        </a>
                        <ul class="nav-sub nav-mega nav-mega-3">
                            <li>
                                <a href="/admin/article" >
                                    <span class="nav-text">文章列表</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/common" >
                                    <span class="nav-text">文章评论</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/aclass" >
                                    <span class="nav-text">文章分类</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                            <span class="nav-icon">
                      <i class="material-icons">&#xe39e;
                        <span ui-include="'/static/admin/images/i_6.svg'"></span>
                      </i>
                    </span>
                            <span class="nav-text">数据库</span>
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <a href="form.layout.html" >
                                    <span class="nav-text">Form Layout</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.element.html" >
                                    <span class="nav-text">Form Element</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.validation.html" >
                                    <span class="nav-text">Form Validation</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.select.html" >
                                    <span class="nav-text">Select</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.editor.html" >
                                    <span class="nav-text">Editor</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.picker.html">
                                    <span class="nav-text">Picker</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.wizard.html">
                                    <span class="nav-text">Wizard</span>
                                </a>
                            </li>
                            <li>
                                <a href="form.dropzone.html" class="no-ajax" >
                                    <span class="nav-text">File Upload</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="b-t">
            <div class="nav-fold">
                <a href="profile.html">
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