<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('admin')->user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="{{ isset($menuModel['Home']) ? $menuModel['Home'] : '' }}">
        <a href="/setAdmin/home">
            <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
    </li>
    <li class="treeview {{ isset($menuModel['system']) ? $menuModel['system'] : '' }}">
        <a href="#">
            <i class="fa fa-gears"></i> <span>System Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ isset($serverMenu) ? $serverMenu : '' }}">
                <a href="/setAdmin/system/server"><i class="fa fa-circle-o {{ isset($serverMenu) ? 'text-aqua' : '' }}"></i>伺服器</a>
            </li>
            <li class="{{ isset($sysActive) ? $sysActive : '' }}">
                <a href="/setAdmin/system"><i class="fa fa-circle-o {{ isset($sysActive) ? 'text-aqua' : '' }}"></i>系統設置</a>
            </li>
        </ul>
    </li>
    <li class="treeview {{ isset($menuModel['video']) ? $menuModel['video'] : '' }}">
        <a href="#">
            <i class="fa fa-video-camera"></i>
            <span>視頻管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ isset($listVideoMenu) ? $listVideoMenu : '' }}">
                <a href="/setAdmin/video/1"><i class="fa fa-circle-o {{ (isset($listVideoMenu) && $listVideoMenu == 'active') ? 'text-aqua' : '' }}"></i>列表</a>
            </li>
            <li class="{{ isset($createVideoMenu) ? $createVideoMenu : '' }}">
                <a href="/setAdmin/video/create"><i class="fa fa-circle-o {{ isset($createVideoMenu) ? 'text-aqua' : '' }}"></i>添加</a>
            </li>
            <li class="{{ isset($noVideoMenu) ? $noVideoMenu : '' }}">
                <a href="/setAdmin/video/0"><i class="fa fa-circle-o {{ (isset($noVideoMenu) && $noVideoMenu == 'active') ? 'text-aqua' : '' }}"></i>待審核</a>
            </li>
            <li class="{{ isset($sortMenu) ? $sortMenu : '' }}">
                <a href="/setAdmin/video/sort"><i class="fa fa-circle-o {{ isset($sortMenu) ? 'text-aqua' : '' }}"></i>分類</a>
            </li><li class="{{ isset($tagMenu) ? $tagMenu : '' }}">
                <a href="/setAdmin/video/tags"><i class="fa fa-circle-o {{ isset($tagMenu) ? 'text-aqua' : '' }}"></i>標籤</a>
            </li>
        </ul>
    </li>
    <li class="{{ isset($menuModel['links']) ? $menuModel['links'] : '' }}">
        <a href="/setAdmin/links">
            <i class="fa fa-unlink"></i> <span>Links</span>
        </a>
    </li>
</ul>
    </section>
    <!-- /.sidebar -->
</aside>