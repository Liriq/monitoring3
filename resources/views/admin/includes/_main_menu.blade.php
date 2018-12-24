<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="menu-icon fa fa-home"></i> {{ _i('Home') }} </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"> <i class="menu-icon fa fa-users"></i> {{ _i('Users') }} </a>
        </li>
        <li>
            <a href="{{ route('admin.templates.index') }}"> <i class="menu-icon fab fa-wpforms"></i> {{ _i('Templates') }} </a>
        </li>
        <li>
            <a href="{{ route('admin.reports.index') }}"> <i class="menu-icon fas fa-file-alt"></i> {{ _i('Reports') }} </a>
        </li>

        <h3 class="menu-title"></h3><!-- /.menu-title -->        
        <li>
            <a href="{{ route('admin.settings.index') }}"> <i class="menu-icon fa fa-tasks"></i>{{ _i('Settings') }} </a>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->