@php
    $userRights = session('userRights'); // Get user rights from session
@endphp

<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}"><span class="nav_icon"><i
                    class="bi bi-house-heart-fill"></i></span> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('addSchDept') }}"><span class="nav_icon"><i class="bi bi-building"></i></span>
            CMS
            Management</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="nav_icon"><i class="bi bi-bank"></i></span>Management
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('departmentshow') }}"><span class="nav_icon"><i
                            class="bi bi-info-circle-fill"></i></span>
                    Department Management</a></li>
            <li><a class="dropdown-item" href="{{ url('schemeshow') }}"><span class="nav_icon"><i
                            class="bi bi-info-circle-fill"></i></span>
                    Scheme Management</a></li>

            {{-- @if (
                $userRights &&
                    (in_array('SYSTEM_SSO_USER', array_column($userRights, 'RightCode')) ||
                        in_array('MANAGEMENT_DEPARTMENT', array_column($userRights, 'RightCode'))))
                <li><a class="dropdown-item" href="{{ url('SchConfigration') }}"><span class="nav_icon"><i
                                class="bi bi-info-circle-fill"></i></span>Scheme
                        Configrations</a>
                </li>
            @endif --}}
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="nav_icon"><i class="bi bi-command"></i></span> System
        </a>
        @if ($userRights && in_array('SYSTEM_SSO_USER', array_column($userRights, 'RightCode')))
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('SSOmaping') }}">
                        <span class="nav_icon"><i class="bi bi bi-geo"></i></span>
                        SSO User
                    </a>
                </li>
            </ul>
        @endif
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"></a>
    </li>
</ul>
