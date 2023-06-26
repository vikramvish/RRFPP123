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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        window.onload = function() {
                            document.getElementById("preloader").style.display = "none";
                        }
    </script>
    <style>
        tr.even {
            text-align: left;
        }

        tr.odd {
            text-align: left;
        }

        div#searchResults {
            MARGIN-TOP: 20PX;
        }

        .fillter {
            display: flex;
            justify-content: end;
        }

        tr,
        th {
            text-align: center;
        }

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

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            display: revert;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: white;
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

    <div class="container">
        <div class="row">
            <div class="card-header" style="display: flex;justify-content: space-between;">
                <h4 class="card-title">Verification Details</h4>
                <a class="btn btn-primary" href="javascript:history.back()" role="button">Back</a>
            </div>
            <div class="col-sm-12">

                <table id="monthly_report" class="display dataTable no-footer" style="width: 100%;"
                    aria-describedby="monthly_report_info">
                    @php
                    if (is_string($jsonData)) {
                    $data = json_decode($jsonData, true);
                    } else {
                    $data = $jsonData;
                    }
                    @endphp
                    <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>MERCHANTCODE</td>
                            <td>{{ $data['MERCHANTCODE'] }}</td>
                        </tr>
                        <tr>
                            <td>REQTIMESTAMP</td>
                            <td>{{ $data['REQTIMESTAMP'] }}</td>
                        </tr>
                        <tr>
                            <td>PRN</td>
                            <td>{{ $data['PRN'] }}</td>
                        </tr>
                        <tr>
                            <td>RPPTXNID</td>
                            <td>{{ $data['RPPTXNID'] }}</td>
                        </tr>
                        <tr>
                            <td>AMOUNT</td>
                            <td>{{ $data['AMOUNT'] }}</td>
                        </tr>
                        <tr>
                            <td>RPPTIMESTAMP</td>
                            <td>{{ $data['RPPTIMESTAMP'] }}</td>
                        </tr>
                        <tr>
                            <td>STATUS</td>
                            <td>{{ $data['STATUS'] }}</td>
                        </tr>
                        <tr>
                            <td>RESPONSECODE</td>
                            <td>{{ $data['RESPONSECODE'] }}</td>
                        </tr>
                        <tr>
                            <td>RESPONSEMESSAGE</td>
                            <td>{{ $data['RESPONSEMESSAGE'] }}</td>
                        </tr>
                        <tr>
                            <td>PAYMENTMODE</td>
                            <td>{{ $data['PAYMENTMODE'] }}</td>
                        </tr>
                        <tr>
                            <td>PAYMENTMODEBID</td>
                            <td>{{ $data['PAYMENTMODEBID'] }}</td>
                        </tr>
                        <tr>
                            <td>PAYMENTMODETIMESTAMP</td>
                            <td>{{ $data['PAYMENTMODETIMESTAMP'] }}</td>
                        </tr>
                        <tr>
                            <td>PAYMENTAMOUNT</td>
                            <td>{{ $data['PAYMENTAMOUNT'] }}</td>
                        </tr>
                        <tr>
                            <td>CURRENCY</td>
                            <td>{{ $data['CURRENCY'] }}</td>
                        </tr>
                        <tr>
                            <td>UDF1</td>
                            <td>{{ $data['UDF1'] }}</td>
                        </tr>
                        <tr>
                            <td>UDF2</td>
                            <td>{{ $data['UDF2'] }}</td>
                        </tr>
                        <tr>
                            <td>UDF3</td>
                            <td>{{ $data['UDF3'] }}</td>
                        </tr>
                        <tr>
                            <td>CHECKSUM</td>
                            <td>{{ $data['CHECKSUM'] }}</td>
                        </tr>
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
                            $('#monthly_report').DataTable({
                                dom: 'lBfrtip', // Show length, buttons, filter, processing, table, information
                                buttons: [
                                    'copy',
                                    'excel',
                                    'pdf',
                                    'print'
                                ]
                            });
                        });
    </script>

</body>

</html>