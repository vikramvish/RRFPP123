@if (session('userRights'))
    @php
        $hasPermission = false;
    @endphp
    @foreach (session('userRights') as $right)
        @if ($right->RightCode == 'SYSTEM_SSO_USER')
            <!DOCTYPE html>
            <html lang="en" xmlns:th="http://www.thymeleaf.org">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Donation</title>
                <link href="css3/bootstrap.min.css" rel="stylesheet">
                <link href="css3/bootstrap-icons.css" rel="stylesheet">
                <link href="css3/styles.css" rel="stylesheet" />
                <link href="css3/datatables.min.css" rel="stylesheet" />
                <link href="css3/owl.carousel.min.css" rel="stylesheet" />
                <style>
                    tr,
                    th {
                        text-align: center;
                    }

                    .input-group {
                        position: relative;
                        display: block;
                        flex-wrap: wrap;
                        align-items: stretch;
                        width: 100%;
                    }

                    .fillter {
                        display: flex;
                    }

                    .fillter form {
                        width: -webkit-fill-available;
                    }
                </style>
            </head>

            <body>
                <header>
                    <div class="top_header">
                        @include('nice-html.header')
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
                                                <a class="nav-link active" aria-current="page"
                                                    href="{{ url('dashboard') }}"><span class="nav_icon"><i
                                                            class="bi bi-house-heart-fill"></i></span> Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('addSchDept') }}"><span
                                                        class="nav_icon"><i class="bi bi-building"></i></span> CMS
                                                    Management</a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="nav_icon"><i class="bi bi-bank"></i></span>Management
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li><a class="dropdown-item"
                                                            href="{{ url('departmentshow') }}"><span class="nav_icon"><i
                                                                    class="bi bi-info-circle-fill"></i></span>
                                                            Department Management</a></li>
                                                    <li><a class="dropdown-item" href="{{ url('schemeshow') }}"><span
                                                                class="nav_icon"><i
                                                                    class="bi bi-info-circle-fill"></i></span>
                                                            Scheme Management</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ url('SchConfigration') }}"><span
                                                                class="nav_icon"><i
                                                                    class="bi bi-info-circle-fill"></i></span>Scheme
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
                                                                class="nav_icon"><i
                                                                    class="bi bi bi-geo"></i></span>SSO User</a>
                                                    </li>
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
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="addbtn filter_box">
                    <div class="container">
                        <h3 class="main_title">SSO User</h3>
                        <div class="fillter">
                            <form method="GET" action="{{ route('SSOmaping') }}" id="filter_data">
                                <div class="input-group">
                                    <div class="btnbox">
                                        <input type="text" id="search-input" name="query" class="form-control"
                                            placeholder="User SSO-ID">
                                    </div>
                                </div>
                            </form>

                            {{-- <form method="Get" action="{{ route('search') }}" id="fillter_data">
                                <div class="input-group">
                                    <div class="btnbox">
                                        <input type="text" id="search-input" name="query" class="form-control"
                                            placeholder="User SSO-ID">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                            </form> --}}
                            {{-- <a class="btn primary_btn" id="filter_btn">Filter</a> --}}
                            <a class="secondary_btn add_btn" href="{{ url('addSSOuser') }}"> <span><i
                                        class="bi bi-plus-lg"></i></span>Add New User</a>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="row">
                            <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">User SSO-ID</th>
                                        <th style="text-align: center">Name</th>
                                        <th style="text-align: center">Designation</th>
                                        <th style="text-align: center">Role</th>
                                        <th style="text-align: center">Action</th>
                                        <th style="text-align: center">Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($user as $users)
                                        <tr>
                                            <th style="text-align: center">{{ $users->id }}</th>
                                            <td class="txt-oflo">{{ $users->UserName }}</td>
                                            <td class="txt-oflo">{{ $users->displayName }}</td>
                                            <td class="txt-oflo">{{ $users->designation }}</td>
                                            <td class="txt-oflo">{{ $users->RoleName }}</td>
                                            <td class="txt-oflo">
                                                @if ($users->IsActive == 1)
                                                    <img src="" class="bi bi-patch-check-fill"
                                                        style="color: green;">
                                                    {{-- <a class="bi bi-check-circle-fill" style="color: green;" class="btn"
                                            href="">
                                        </a> --}}
                                                @elseif($users->IsActive == 0)
                                                    <img src="" class="bi bi-patch-check-fill"
                                                        style="color: red;">
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn" href="{{ url('ssoEdit/' . $users->id) }}">
                                                    <button type="button" value=""
                                                        class="btn btn-primary editbtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal">Edit</button></a>
                                            </td>                                           
                                    @endforeach
                                    {{-- <p>No results found.</p> --}}
                                </tbody>
                            </table>
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

                {{-- <script>
    $('#monthly_report').dataTable({
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
    });
    </script> --}}
    
                {{--  for live searching in laravel --}}
                <script>
                    $(document).ready(function() {
                        $("#search-input").on("keyup", function() {
                            var value = $(this).val().toLowerCase();
                            $("#table-body tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                        // Add event listener to reload page when search input is empty
                        $("#search-input").on("keyup", function() {
                            if ($(this).val().trim() == '') {
                                return false; // do nothing if input value is empty
                            }
                        });
                    });
                </script>

                <script>
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
            @php
                $hasPermission = true;
            @endphp
        @endif
    @endforeach
    @if (!$hasPermission)
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <style>
                @import url(https://fonts.googleapis.com/css?family=Raleway:700);

                *,
                *:before,
                *:after {
                    box-sizing: border-box;
                }

                html {
                    height: 100%;
                }

                body {
                    font-family: 'Raleway', sans-serif;
                    background-color: #342643;
                    height: 100%;
                    padding: 10px;
                }

                a {
                    color: #EE4B5E !important;
                    text-decoration: none;
                }

                a:hover {
                    color: #FFFFFF !important;
                    text-decoration: none;
                }

                .text-wrapper {
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .title {
                    font-size: 5em;
                    font-weight: 700;
                    color: #EE4B5E;
                }

                .subtitle {
                    font-size: 40px;
                    font-weight: 700;
                    color: #1FA9D6;
                }

                .isi {
                    font-size: 18px;
                    text-align: center;
                    margin: 30px;
                    padding: 20px;
                    color: white;
                }

                .buttons {
                    margin: 30px;
                    font-weight: 700;
                    border: 2px solid #EE4B5E;
                    text-decoration: none;
                    padding: 15px;
                    text-transform: uppercase;
                    color: #EE4B5E;
                    border-radius: 26px;
                    transition: all 0.2s ease-in-out;
                    display: inline-block;

                    .buttons:hover {
                        background-color: #EE4B5E;
                        color: white;
                        transition: all 0.2s ease-in-out;
                    }
                }
                }
            </style>
        </head>

        <body>
            {{-- <div class="alert alert-danger">You are not authorized to access this page.</div>   --}}
            <div class="text-wrapper">
                <div class="title" data-content="404">
                    403 - ACCESS DENIED
                </div>
                <div class="subtitle">
                    Oops, You don't have permission to access this page.
                </div>
                <div class="isi">
                    You have To take Permission from <span style="color: #1FA9D6;font-size: 25px;"> super admin </span>
                    to access this page.!
                </div>
                <div class="buttons">
                    <a class="button" href="{{ url('/dashboard') }}">Go to Dashboard</a>
                </div>
            </div>
        </body>

        </html>
    @endif
@endif
