<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('dashboard.index') }}"> <i class="menu-icon fa fa-home"></i> {{ _i('Home') }} </a>
        </li>
        <li>
            <a href="{{ route('dashboard.reports.index') }}"> <i class="menu-icon fas fa-file-alt"></i> {{ _i('Reports') }} </a>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->