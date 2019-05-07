<li class="nav-item">
    <a class='sidebar-link' href="{{ route('admin.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>

@can('roles.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('roles.index') }}">
        <span class="icon-holder">
            <i class="c-yellow-800 ti-panel"></i>
        </span>
        <span class="title">Roles</span>
    </a>
</li>
@endcan

@can('users.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('users.index') }}">
        <span class="icon-holder">
            <i class="c-red-500 ti-user"></i>
        </span>
        <span class="title">Usuarios</span>
    </a>
</li>
@endcan

@can('departments.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('departments.index') }}">
        <span class="icon-holder">
            <i class="c-blue-800 ti-map-alt"></i>
        </span>
        <span class="title">Departamentos</span>
    </a>
</li>
@endcan

@can('municipalities.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('municipalities.index') }}">
        <span class="icon-holder">
            <i class="c-green-700 ti-location-pin"></i>
        </span>
        <span class="title">Municipios</span>
    </a>
</li>
@endcan

@can('mayors.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('mayors.index') }}">
        <span class="icon-holder">
            <i class="c-brown-900 fa fa-user-o"></i>
        </span>
        <span class="title">Alcaldes</span>
    </a>
</li>
@endcan

@can('deputies.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('deputies.index') }}">
        <span class="icon-holder">
            <i class="c-red-800 fa fa-male"></i>
        </span>
        <span class="title">Diputados Distrito</span>
    </a>
</li>
@endcan

@can('tours.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('tours.index') }}">
        <span class="icon-holder">
            <i class="c-lime-900 ti-world"></i>
        </span>
        <span class="title">Capacitaciones</span>
    </a>
</li>
@endcan

@can('campaign.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('department_campaign.index') }}">
        <span class="icon-holder">
            <i class="c-indigo-a700 ti-location-pin"></i>
        </span>
        <span class="title">Campaña Departamental</span>
    </a>
</li>
@endcan

@can('campaign.index')
<li class="nav-item">
    <a class='sidebar-link' href="{{ route('campaign.index') }}">
        <span class="icon-holder">
            <i class="c-blue-900 ti-pin2"></i>
        </span>
        <span class="title">Campaña Municipios</span>
    </a>
</li>
@endcan