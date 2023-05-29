@if (session('userRights'))
    @php
        $hasPermission = false;
    @endphp
    @foreach (session('userRights') as $right)
        @if ($right->RightCode == 'MANAGEMENT_SCHEME_CONFIGRATION')
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                <style>
                    .btn-primary {
                        color: #fff;
                        background-color: #2f2f74;
                        border-color: #2f2f74;

                    }

                    .container {
                        margin-bottom: 20px;
                    }

                    .card {
                        border: none;
                    }

                    tr,
                    th {
                        text-align: center;
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
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="addbtn filter_box">
                    <div class="container">
                        <div class="mainheading" style="display: flex;justify-content: space-between;">
                            <h3 class="main_title">Scheme Configrations</h3>
                            <div class="btn_row" style="DISPLAY: BLOCK;MARGIN-TOP: 0PX;">
                                <a class="btn btn-primary" href="javascript:history.back()" role="button">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="fillter">
                        <form action="" method="GET" id="fillter_data">
                            <div class="filler_coll">
                                <select class="form-select" name="scheme" id="dropdown" placeholder="Select Scheme">
                                    <option value="all">All Scheme</option>
                                    @if (count($dept) > 0)
                                        @foreach ($dept as $schemes)
                                            <option value="{{ $schemes->SchemeName }}">
                                                {{ $schemes->SchemeName }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                {{-- <select class="form-select" name="scheme" 
                            placeholder="Select Scheme">
                            <option value="" >Select Scheme</option>
                            @foreach ($dept as $schemes)
                                <option value="{{ $schemes->DepartmentName }}">
                                    {{ $schemes->DepartmentName }}</option>
                            @endforeach
                        </select> --}}

                            </div>
                            {{-- <div class="btnbox">
                        <button type="submit" class="btn primary_btn">Filter</button>
                        <a class="btn primary_btn" id="filter_btn">Filter</a> 
                    </div> --}}
                        </form>
                    </div>
                </div>
                </div>
                {{-- <div class="addbtn" style="display: flex;justify-content: space-between;">
        <span style="margin-left: 67px;"><b style="font-size: 20px;">List of Scheme's</b></span>
        <a class="btn" href="{{ url('add_new_scheme') }}" style="width: 13%;">
            <button type="button" value="" class="btn btn-primary editbtn btn-sm" data-toggle="modal"
                data-target="#exampleModal"><i class="bi bi-plus"></i>Add</button></a>
    </div> --}}
                <div class="container">
                    <div class="card">
                        <div class="row">
                            <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        {{-- <th style="text-align: center">#</th> --}}
                                        <th style="text-align: center">Scheme name</th>
                                        <th style="text-align: center">Merchant Code</th>
                                        <th style="text-align: center">Bank Account Number</th>
                                        <th style="text-align: center">Bank Account IFSC</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr>
                                            {{-- <td class="txt-oflo">{{ $users->SchemeId }}</td> --}}
                                            <td class="txt-oflo">{{ $users['SchemeName'] }}</td>
                                            <td class="txt-oflo">{{ $users->MerchantCode }}</td>
                                            <td class="txt-oflo">{{ $users->BankAccountNumber }}</td>
                                            <td class="txt-oflo">{{ $users->BankAccountIFSC }}</td>
                                            <td style="text-align: center">
                                                <a class="btn" href="{{ url('addSch_config/' . $users->SchemeId) }}">
                                                    <button type="button" value=""
                                                        class="btn btn-primary editbtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal">Edit</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
                <script>
                    $(document).ready(function() {
                        $('#dropdown').change(function() {
                            var selectedValue = $(this).val();
                            if (selectedValue === 'all') {
                                $('table tbody tr').show();
                            } else {
                                $('table tbody tr').hide();
                                $('table tbody tr td:contains("' + selectedValue + '")').parent().show();
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
