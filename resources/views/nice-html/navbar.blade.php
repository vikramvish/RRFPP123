@php
$userRights = session('userRights'); // Get user rights from session
@endphp

<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}"><span class="nav_icon"><i
                    class="bi bi-house-heart-fill"></i></span> Dashboard</a>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="nav_icon"><i class="bi bi-wallet2"></i></span>Donation Transaction
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('search') }}"><span class="nav_icon"><i
                            class="bi bi-search"></i></span>
                    Search Transaction</a></li>
            <li><a class="dropdown-item" href="{{ url('download_reports') }}"><span class="nav_icon"><i
                            class="bi bi-file-earmark-arrow-down-fill"></i></span>
                    Download Reports</a></li>
            <li><a class="dropdown-item" href="{{ url('txn_log') }}"><span class="nav_icon"><i
                            class="bi bi-box-arrow-in-left"></i></span>
                    View Transaction Logs</a></li>
            <li><a class="dropdown-item" href="{{ url('refund') }}"><span class="nav_icon"><i
                            class="bi bi-arrow-clockwise"></i></span>
                    Refund Initilise</a></li>
        </ul>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
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
    </li>
</ul>
@endif
</li>
<li class="nav-item">
    <a class="nav-link" href="#"></a>
</li>
</ul>