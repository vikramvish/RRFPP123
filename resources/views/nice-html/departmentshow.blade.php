@if (session('userRights'))
@php
$hasPermission = false;
@endphp
@foreach (session('userRights') as $right)
@if ($right->RightCode == 'MANAGEMENT_DEPARTMENT')

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>
    <link href="css3/bootstrap.min.css" rel="stylesheet">
    <link href="css3/bootstrap-icons.css" rel="stylesheet">
    <link href="css3/styles.css" rel="stylesheet" />
    <link href="css3/datatables.min.css" rel="stylesheet" />
    <link href="css3/owl.carousel.min.css" rel="stylesheet" />
    <style>
        .fillter {
            display: flex;
            justify-content: end;
        }

        tr,
        th {
            text-align: center;
        }
    </style>
    <script>
        window.onload = function() {
                        document.getElementById("preloader").style.display = "none";
                    }
    </script>
    <style>
        .causes-grid ul li:nth-child(3n+1) {
            clear: both;
        }

        .blog_discription a.read_more {
            text-decoration: none;
            float: right;
            border-radius: 50px;
            padding: 0px 0px;
            color: #dea500;
            text-transform: capitalize;
            position: relative;
            cursor: pointer;
        }

        /* preloader css */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 9999;
        }

        #loader {
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            border: 10px solid #f3f3f3;
            border-top: 10px solid #3498db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
                            @include('nice-html.navbar')
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    @if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
    @endif
    <div class="addbtn filter_box">
        <div class="container">
            <h3 class="main_title">List of Department</h3>

            <div class="fillter">
                <form id="fillter_data">
                    <div class="btnbox">
                        {{-- <a class="btn primary_btn" id="filter_btn">Filter</a> --}}
                        <a class="secondary_btn add_btn" href="{{ url('add_new_dept') }}"> <span><i
                                    class="bi bi-plus-lg"></i></span> Add New Department</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="row">
                <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align: center">#</th>
                            <th style="text-align: center">Department Name</th>
                            <th style="text-align: center">Department Name(Hindi)</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(session('roleId') == 1)
                        @foreach ($user as $users)
                        <tr>
                            <td class="txt-oflo">{{ $users->DepartmentId }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentName }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentNameHindi }}</td>
                            <td class="txt-oflo">

                                @if ($users->IsActive == 1)
                                <img src="" class="bi bi-patch-check-fill" style="color: green;">
                                @elseif($users->IsActive == 0)
                                <img src="" class="bi bi-patch-check-fill" style="color: red;">
                                @endif
                            </td>
                            <td style="text-align: center">
                                <a class="btn" href="{{ url('DeptEdit/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Edit</button></a>
                                <a class="btn" href="{{ url('updateDepartment/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Update Meta
                                        Content</button></a>

                            </td>
                        </tr>
                        @endforeach
                        {{-- @else --}}
                        @elseif(session('roleId') == 2 || session('roleId') == 3 || session('roleId') == 4)
                        @foreach ($user as $users)
                        <tr>
                            <td class="txt-oflo">{{ $users->DepartmentId }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentName }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentNameHindi }}</td>
                            <td class="txt-oflo">

                                @if ($users->IsActive == 1)
                                <img src="" class="bi bi-patch-check-fill" style="color: green;">
                                @elseif($users->IsActive == 0)
                                <img src="" class="bi bi-patch-check-fill" style="color: red;">
                                @endif
                            </td>
                            <td style="text-align: center">
                                <a class="btn" href="{{ url('DeptEdit/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Edit</button></a>
                                <a class="btn" href="{{ url('updateDepartment/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Update Meta
                                        Content</button></a>

                            </td>
                        </tr>
                        @endforeach

                        @endif

                        {{-- @foreach ($user as $users)
                        <tr>
                            <td class="txt-oflo">{{ $users->DepartmentId }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentName }}</td>
                            <td class="txt-oflo">{{ $users->DepartmentNameHindi }}</td>
                            <td class="txt-oflo">

                                @if ($users->IsActive == 1)
                                <img src="" class="bi bi-patch-check-fill" style="color: green;">
                                @elseif($users->IsActive == 0)
                                <img src="" class="bi bi-patch-check-fill" style="color: red;">
                                @endif
                            </td>
                            <td style="text-align: center">
                                <a class="btn" href="{{ url('DeptEdit/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Edit</button></a>
                                <a class="btn" href="{{ url('updateDepartment/' . $users->DepartmentId) }}">
                                    <button type="button" value="" class="btn btn-primary editbtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Update Meta
                                        Content</button></a>

                            </td>
                        </tr>
                        @endforeach --}}
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
    {{-- <div class="alert alert-danger">You are not authorized to access this page.</div> --}}

    <div class="text-wrapper">
        <div class="title" data-content="404">
            403 - ACCESS DENIED
        </div>

        <div class="subtitle">
            Oops, You don't have permission to access this page.
        </div>
        <div class="isi">
            You have take Permission from super admin to access this page.!
        </div>

        <div class="buttons">
            <a class="button" href="{{ url('/dashboard') }}">Go to Dashboard</a>
        </div>
    </div>
</body>

</html>
@endif
@endif