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
    <title>{{ config('config.title') }}</title>
    <link href="{{ URL::asset('css3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css3/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css3/styles.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css3/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css3/owl.carousel.min.css') }}" rel="stylesheet" />
    <style>
        .dropup,
        .dropdown {
            position: relative;
            width: 50%;
        }

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

        .btn {

            width: auto;
            margin: 0px auto;
            display: block;

        }

        .checkbox-menu li label {
            display: block;
            padding: 3px 10px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
            margin: 0;
            transition: background-color .4s ease;
        }

        .checkbox-menu li input {
            margin: 0px 5px;
            top: 2px;
            position: relative;
        }

        .checkbox-menu li.active label {
            background-color: #cbcbff;
            font-weight: bold;
        }

        .checkbox-menu li label:hover,
        .checkbox-menu li label:focus {
            background-color: #f5f5f5;
        }

        .checkbox-menu li.active label:hover,
        .checkbox-menu li.active label:focus {
            background-color: #b8b8ff;
        }

        .checkbox-menu {
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .btn-primary {
            color: #fff;
            background-color: #2f2f74 !important;
            border-color: #2f2f74 !important;
        }

        .btn {
            display: block !important;
        }

        .bottom_header {
            height: 35px;
        }

        .container {
            width: 1320px !important;
        }

        .menu ul li a {
            font-weight: bolder;
        }

        .bottom_header a.nav-link {
            padding: 0px 0px 14px 0px !important;
        }

        div#navbarSupportedContent {
            padding-left: 0px;
        }

        .bottom_header a.nav-link {
            font-size: 15px;
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

    <div class="addbtn filter_box">
        <div class="container">
            @if (Session::has('success'))
            <div class="alert alert-success" style="margin-top: 25px;">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
            <div class="alert alert-danger" style="margin-top: 25px;">{{ Session::get('fail') }}</div>
            @endif
            <div class="mainheading" style="display: flex;justify-content: space-between;">
                <h3 class="main_title">Search User</h3>
                <div class="btn_row" style="DISPLAY: BLOCK;">
                    <a class="btn btn-primary" href="{{ url('SSOmaping') }}" role="button">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('deptmapping.update', ['UserName' => $user->UserName]) }}"
            id="filter_data">
            @csrf
            <div class="form_row">
                <div class="form_item">
                    <label>SSO-ID</label>
                    <input type="text" readonly id="search-input" name="query" class="form-control"
                        placeholder="Search SSO-ID" value="{{ $user->UserName }}">
                </div>
                {{-- <div class="form_item">
                    <label for="department">Department:</label>
                    <div class="checkbox-dropdown">
                        <input type="text" class="form-control" id="department-dropdown" readonly>
                        <div class="checkbox-dropdown-menu">
                            @foreach ($departments as $department)
                            @if ($department->IsActive == 1)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                    id="department_{{ $department->DepartmentId }}" name="department[]"
                                    value="{{ $department->DepartmentId }}" {{ in_array($department->DepartmentId,
                                $user->departments->pluck('DepartmentId')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="department_{{ $department->DepartmentId }}">{{
                                    $department->DepartmentName }}</label>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div> --}}
                <div class="form_item">
                    <label>Assign Department</label>
                    <div class="dropdown" style="width: 88%;">
                        <button class="form-control" type="button" id="department-dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: left; display: -webkit-inline-box;">
                            Select Department
                            <span class="caret" style="margin-left: 40rem;"></span>
                        </button>
                        <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="department-dropdown-button"
                            style="width: 100%;">
                            <li>
                                <label>
                                    <input type="checkbox" class="form-check-input" id="check-all-checkbox">
                                    Select All
                                </label>
                            </li>
                            @foreach ($departments as $department)
                            @if ($department->IsActive == 1)
                            <li>
                                <label>
                                    <input type="checkbox" class="form-check-input"
                                        id="department_{{ $department->DepartmentId }}" name="department[]"
                                        value="{{ $department->DepartmentId }}" {{ in_array($department->DepartmentId,
                                    $user->departments->pluck('DepartmentId')->toArray()) ? 'checked' : '' }}>
                                    {{ $department->DepartmentName }}
                                </label>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="btn">
                <button type="submit" name="search" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="card">
            <div class="row">
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


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>

    {{-- <script>
        $(".checkbox-menu").on("change", "input[type='checkbox']", function() {
   $(this).closest("li").toggleClass("active", this.checked);
});

$(document).on('click', '.allow-focus', function (e) {
  e.stopPropagation();
});
    </script> --}}


    <!-- Add this script after including jQuery -->
    <script type="text/javascript" src="{{ URL::asset('js3/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
        const checkboxDropdown = document.querySelector('.checkbox-menu');
        const departmentDropdown = document.getElementById('department-dropdown-button');
        const checkboxes = checkboxDropdown.querySelectorAll('input[type="checkbox"]');

        // Function to update the input field with selected department names
        function updateSelectedDepartments() {
            const selectedDepartments = Array.from(checkboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.nextElementSibling.innerText);

            departmentDropdown.innerText = (selectedDepartments.length > 0) ? selectedDepartments.join(', ') : 'Select Department';
        }

        // Function to handle the "Select All" checkbox
        document.getElementById('check-all-checkbox').addEventListener('click', function () {
            const isChecked = this.checked;
            checkboxes.forEach((checkbox) => checkbox.checked = isChecked);
            updateSelectedDepartments();
        });

        // Attach event listener to the checkboxes
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', updateSelectedDepartments);
        });

        // Update the input field on page load
        updateSelectedDepartments();
    });
    </script>
    <script type="text/javascript" src="{{ URL::asset('js3/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/datatables.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> --}}


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