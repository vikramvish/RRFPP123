<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="{{ asset('css3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css3/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css3/owl.carousel.min.css') }}" rel="stylesheet" />
    <style>
        .btn-primary {
            color: #fff;
            background-color: #2f2f74;
            border-color: #2f2f74;
            width: 8%;
        }
    </style>
</head>

<body>
    <header>
        <div class="top_header">
            <div class="container">
                <div class="custom_row">
                    <div class="logo"><img src="{{ asset('images/rajgov_logo.png') }}"></div>
                    <div class="menu">
                        <ul>
                            <li><a href="#" class="user"><span class="menu_icon avtar"><i
                                            class="bi bi-person"></i></span><span
                                        class="right_part"><strong>Welcome</strong><span id="user_id"
                                            class="userid">rrfpp.gov.in</span></span></a></li>
                            <li><a href="{{ url('/logout') }}"
                                    onclick="return confirm('Are you sure You Want to Logout?')" class="mobile"><span
                                        class="menu_icon logout"><i class="bi bi-power"></i></span>Logout</a></li>
                            <li><a href="{{ url('website#help') }}" class="download"><span class="menu_icon"><i
                                            class="bi bi-globe2"></i></span>Donation Portal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_header">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}"><span
                                            class="nav_icon"><i class="bi bi-house-heart-fill"></i></span> Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('addSchDept') }}"><span class="nav_icon"><i
                                                class="bi bi-building"></i></span> CMS Management</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="nav_icon"><i class="bi bi-bank"></i></span>Management
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ url('departmentshow') }}"><span
                                                    class="nav_icon"><i class="bi bi-info-circle-fill"></i></span>
                                                Department Management</a></li>
                                        <li><a class="dropdown-item" href="{{ url('schemeshow') }}"><span
                                                    class="nav_icon"><i class="bi bi-info-circle-fill"></i></span>
                                                Scheme Management</a></li>
                                        <li><a class="dropdown-item" href="{{ url('SchConfigration') }}"><span
                                                    class="nav_icon"><i class="bi bi-info-circle-fill"></i></span>Scheme
                                                Configrations</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="nav_icon"><i class="bi bi-command"></i></span> System
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ url('SSOmaping') }}"><span
                                                    class="nav_icon"><i class="bi bi bi-geo"></i></span>SSO User</a>
                                        </li>
                                        {{-- <li><a class="dropdown-item" href="#"><span class="nav_icon"><i
                                                        class="bi bi-person-lines-fill"></i></span> Contact</a></li>
                                        <li><a class="dropdown-item" href="#"><span class="nav_icon"><i
                                                        class="bi bi-chat-text-fill"></i></span> Feedback</a></li> --}}
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="main_section new_shema">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Department</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form action="{{ url('sso-Edit/' . $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form_row">
                            <div class="form_item">
                                <label>SSOID</label>
                                <input type="text" id="UserName" name="UserName" placeholder="SSOID"
                                    class="form-control" required value="{{ $user->UserName }}">
                            </div>
                            <div class="form_item">
                                <label>Name</label>
                                <input type="text" id="displayName" name="displayName"
                                    placeholder="Enter Scheme name in hindi" class="form-control" required
                                    value="{{ $user->displayName }}">
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_item">
                                <label>Designation</label>
                                <input type="text" id="designation" name="designation" placeholder="designation"
                                    class="form-control" required value="{{ $user->designation }}">
                            </div>
                            <div class="form_item">
                                <select name="RoleId" id="RoleId" class="form-select" style="margin-top: 29px;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->RoleId }}">{{ $role->RoleName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_item" style="margin-top: 28px;">
                                {{-- <input type="hidden" name="IsActive" value="0" />  --}}
                                <input data-id="{{ $user->id }}" name="IsActive" class="form-check-input"
                                    type="checkbox" value="1" id="flexCheckChecked"
                                    {{ $user->IsActive || old('IsActive', 0) === 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Status
                                </label>
                            </div>
                        </div>
                        <div class="btn_row">
                            {{-- @if (session('role') == '1')
                                <input type="submit" value="submit" class="primary_btn">
                            @elseif (session('role') == '2')
                                <input type="submit" value="submit" class="primary_btn"
                                    onclick="alert('This button is disabled')" disabled>
                            @elseif (session('role') == '3')
                                <!-- Button for condition 3 -->
                                <input type="submit" value="submit 3" class="primary_btn">
                            @elseif (session('role') == '4')
                                <!-- Button for condition 4 -->
                                <input type="submit" value="submit 4" class="primary_btn">
                            @endif --}}
                            <input type="submit" value="submit" class="primary_btn">
                            <a class="btn btn-primary" href="{{ url('SSOmaping') }}" role="button">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer_top">
            <div class="container">
                <ul class="footer_menu">
                    <li><a href="#">Refund Policy</a></li>
                    <li><a href="#">Term & Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cancellation Policy</a></li>
                    <li><a href="#">Chargeback Guidelines</a></li>
                </ul>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <p>Copyright © 2022 - All rights reserved dept of IT&C, Govt of rajasthan </p>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="{{ URL::asset('js3/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/datatables.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> --}}

    <script>
        < script >
            $(document).ready(function() {
                $('#monthly_report').dataTable({
                    searching: true,
                    paging: true,
                    dom: 'lBfrtip', //* l = length, B = button, f = fillter, r = processing, t = table, i = information, p = pagination
                    info: true,
                    buttons: [
                        //'copy',
                        'excel',
                        'csv',
                        'pdf',
                        //'print'
                    ]
                });
            });
    </script>

</body>

</html>
// </div>
