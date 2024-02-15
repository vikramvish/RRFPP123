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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('config.title') }}</title>
    <link href="{{ URL::asset('css3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css3/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css3/styles.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css3/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css3/owl.carousel.min.css') }}" rel="stylesheet" />
    <style>
        .form-control {
            width: 906px;
        }

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
            /* display: block; */
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

        .card-header {
            display: flex;
            justify-content: space-between;
        }

        /* .btn {
            display: block !important;
        } */

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

        h3.main_title {
            margin-top: 36px;
        }

        form#filter_data {
            width: auto;
            margin: 20px auto;
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
        </div>
    </div>

    <div class="container">

        <div class="card">
            <div class="row">
                <div class="card-header">
                    <h4 class="card-title" style="margin-top: 11px;">Search User</h4>
                    <div class="mainheading">
                        <div class="btn">
                            <a class="btn btn-primary" href="{{ url('SSOmaping') }}" role="button">Back</a>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('refundlog') }}" id="filter_data" style="margin-top: 21px;">
                    @csrf
                    <div class="form_row">
                        <div class="form_item">
                            <label>PRN</label>
                            <input type="text" id="search-input" name="query" class="form-control"
                                placeholder="Search PRN" value="{{ old('query', isset($prn) ? $prn : '') }}">
                        </div>
                        <div class="btn" style="margin-top: 22px;margin-right: 0px;">
                            <button type="submit" name="search" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                @if(isset($data) && !$data->isEmpty())
                <!-- Display the datatable with the 5 fields here -->
                <!-- Example: -->
                <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>PRN</th>
                            <th>RPPTxnId</th>
                            <th>RemitterName</th>
                            <th>REQTIMESTAMP</th>
                            <th>AMOUNT</th>
                            <th>PayModeBankName</th>
                            <th>RESPONSEMESSAGE</th>
                            <th>created_at</th>
                            <th>Action</th>
                            <!-- Add other fields here -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = session('refund_data');
                        @endphp
                        @if (isset($data) && !$data->isEmpty())
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->PRN }}</td>
                            <td>{{ $item->RPPTxnId }}</td>
                            <td>{{ $item->RemitterName }}</td>
                            <td>{{ $item->REQTIMESTAMP }}</td>
                            <td>{{ $item->AMOUNT }}</td>
                            <td>{{ $item->PayModeBankName }}</td>
                            <td>{{ $item->RESPONSEMESSAGE }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td style="text-align: center">
                                <!-- Include a hidden input with class "refund-amount" to store the amount in decimal format -->
                                <input type="hidden" class="refund-amount"
                                    value="{{ number_format($item->AMOUNT, 2, '.', '') }}">                               
                                    <button type="button" class="btn btn-primary refund-initiate-btn"
                                        data-prn="{{ $item->PRN }}"
                                        data-rpptxnid="{{ $item->RPPTxnId }}"
                                        data-amount="{{ $item->AMOUNT }}"
                                        style="width: max-content;">Refund Initiate</button>
                            </td>
                            <!-- Display other fields here -->
                        </tr>
                        @endforeach
                        @else
                        <!-- Display an error message row when no data is available or when PRN is not found -->
                        <tr>
                            <td colspan="8" class="text-center alert alert-danger">
                                Data not available for the given PRN.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9">
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                @elseif(isset($error))
                <!-- Display an error message when no data is available or when PRN is not found -->
                <div role="alert">
                    {{ $error }}
                </div>
                @endif
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    <script>
        $(document).on('click', '.refund-initiate-btn', function () {
            const prn = $(this).data('prn');
            const rpptxnid = $(this).data('rpptxnid');
            const amount = $(this).siblings('.refund-amount').val(); // Use the hidden input value
    
            // Make an AJAX request to the refund_response route with the parameters
            $.ajax({
                url: "{{ route('refund.response') }}",
                method: "GET",
                data: {
                    prn: prn,
                    rpptxnid: rpptxnid,
                    amount: amount
                },
                success: function (response) {
                    // Redirect to the refund_response page with the response data
                    window.location.href = "{{ route('refund.response') }}" + "?prn=" + prn + "&rpptxnid=" + rpptxnid + "&amount=" + amount;
                },
                error: function (xhr, status, error) {
                    console.error(error);
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