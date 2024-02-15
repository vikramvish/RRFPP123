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
    <div class="main_section new_shema">

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Scheme</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form id="new_shema" method="post" action="{{ url('store-form') }}">
                        @csrf
                        <div class="form_row">
                            <div class="form_item full">
                                {{-- <label>Select Department</label> --}}
                                @if(session('roleId') == 1)
                                <select class="form-select" name="department">
                                    @foreach ($department as $departments)
                                        <option value="{{ $departments->DepartmentId }}">
                                            {{ $departments->DepartmentName }}</option>
                                    @endforeach
                                </select>
                                @elseif(session('roleId') == 2 || session('roleId') == 3 || session('roleId') == 4)
                                <select class="form-select" name="department">
                                    @foreach ($department as $departments)
                                        <option value="{{ $departments->DepartmentId }}">
                                            {{ $departments->DepartmentName }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_item">
                                <label>Scheme Name (English)</label>
                                <input type="text" id="SchemeName_eng" name="SchemeName"
                                    placeholder="Enter Scheme name in english" class="form-control" required>
                                {!! $errors->first('DepartmentName', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form_item">
                                <label>Scheme Name (Hindi)</label>
                                <input type="text" id="SchemeName_hindi" name="SchemeNameHindi"
                                    placeholder="Enter Scheme name in hindi" class="form-control" required>
                                {!! $errors->first('DepartmentNameHindi', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-check">
                            <input data-onstyle="success" class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Status
                            </label>
                        </div>                       
                        <div class="btn_row">
                            {{-- @if (session('role') == '1')                            
                            <input type="submit" value="Submit" class="primary_btn">

                        @elseif (session('role') == '2')
                        <input type="submit" value="Submit" class="primary_btn" onclick="alert('This button is disabled')" disabled>
                       
                        @elseif (session('role') == '3')
                            <!-- Button for condition 3 -->
                            <input type="submit" value="Submit" class="primary_btn">
                                
                        @elseif (session('role') == '4')
                            <!-- Button for condition 4 -->
                            <input type="submit" value="Submit" class="primary_btn">
                        @endif     --}}
                        <input type="submit" value="Submit" class="primary_btn">
                            <a class="btn btn-primary" href="{{ url('schemeshow') }}" role="button">Back</a>

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
