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