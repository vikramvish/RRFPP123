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
                <title>download_reports</title>
                <link href="css3/bootstrap.min.css" rel="stylesheet">
                <link href="css3/bootstrap-icons.css" rel="stylesheet">
                <link href="css3/styles.css" rel="stylesheet" />
                <link href="css3/datatables.min.css" rel="stylesheet" />
                <link href="css3/owl.carousel.min.css" rel="stylesheet" />
                <!-- DataTables CSS -->
                <link rel="stylesheet" type="text/css"
                    href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

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
                <style>
                    .fillter {
                        display: flex;
                        justify-content: end;
                    }

                    tr,
                    th {
                        text-align: center;
                    }

                    .btn {
                        display: revert;
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

                    .form-row {
                        display: flex;
                        justify-content: space-between;
                    }

                    th {
                        text-align: center !important;
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
                <div class="addbtn filter_box">
                    <div class="container">
                        <div class="card-header">
                            <h4 class="card-title">Download Report</h4>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="row">

                            <form action="{{ route('downloadReports') }}" method="GET">

                                <div class="form-row">
                                    <div class="form_item">
                                        <label for="from_date">From Date:</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date">
                                    </div>

                                    <div class="form_item">
                                        <label for="to_date">To Date:</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form_item">
                                        <label for="department">Department:</label>
                                        <select id="department" class="form-control" name="department">
                                            <option value="">All Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->DepartmentId }}"
                                                    {{ $selectedDepartmentId == $department->DepartmentId ? 'selected' : '' }}>
                                                    {{ $department->DepartmentName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form_item">
                                        <label for="scheme">Scheme:</label>
                                        <select id="scheme" class="form-control" name="scheme">
                                            <option value="">All Scheme</option>
                                            @forelse ($schemes as $scheme)
                                                <option value="{{ $scheme->SchemeId }}">{{ $scheme->SchemeName }}
                                                </option>
                                            @empty
                                                <option value="">No Schemes Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form_item">
                                        <label for="prn">Count</label>
                                        @if (
                                            ($results->isNotEmpty() && $request->filled('from_date')) ||
                                                $request->filled('to_date') ||
                                                $request->filled('department') ||
                                                $request->filled('STATUS') ||
                                                $request->filled('scheme'))
                                            <input type="text" class="form-control" name="count" id="prn"
                                                value="{{ $results->count() }}" readonly>
                                        @else
                                            <input type="text" class="form-control" name="count" id="prn"
                                                value="0" readonly>
                                        @endif
                                    </div>
                                    <div class="form_item">
                                        <label for="department">Status:</label>
                                        <select class="form-control" name="STATUS" id="status">
                                            <option value="">All</option>
                                            <option value="SUCCESS">SUCCESS</option>
                                            <option value="FAILED">FAILED</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="btn">
                                    <button type="submit" name="summary" class="btn btn-primary">Download
                                        Summary</button>
                                    <button type="submit" name="detailed" class="btn btn-primary">Download detailed
                                        data</button>
                                    <button type="button" class="btn btn-primary">
                                        <a href="{{ url('download_reports') }}">Reset</span>
                                        </a></button>
                                </div>
                            </form>
                          
                            @if ($results->isNotEmpty())
                                @if (isset($_GET['summary']))
                                    <table id="monthly_report" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Department</th>
                                                <th>Scheme</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $result->created_at }}</td>
                                                    <td>{{ $result->department?->DepartmentName }}</td>
                                                    <td>{{ $result->scheme?->SchemeName }}</td>
                                                    <td>{{ $result->AMOUNT }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @elseif (isset($_GET['detailed']))
                                    <table id="monthly_report" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>PRN</th>
                                                <th>RPP Transaction ID</th>                                                
                                                <th>Name</th>
                                                <th>number</th>                                                
                                                <th>Scheme</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $result->created_at }}</td>
                                                    <td>{{ $result->PRN }}</td>
                                                    <td>{{ $result->RPPTxnId }}</td>
                                                    <td>{{ $result->RemitterName }}</td>
                                                    
                                                    <td>{{ $result->RemitterMobile }}</td>
                                                    <td>{{ $result->scheme?->SchemeName }}</td>
                                                    <td>
                                                        @if ($result->STATUS == 'SUCCESS')
                                                            <span style="color: green;font-weight:700;">{{ $result->STATUS }}</span>
                                                        @elseif ($result->STATUS == 'FAILED')
                                                            <span style="color: red;font-weight:700;">{{ $result->STATUS }}</span>
                                                        @else
                                                            {{ $result->STATUS }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            @else
                                <p>No data found.</p>
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
                <script>
                    document.getElementById('fromDate').value = (new Date()).toISOString().split('T')[0];
                </script>

                {{-- <script>
    $('#monthly_report').dataTable({
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
    });
    </script> --}}

                <script>
                    $(document).ready(function() {
                        $('#department').on('change', function() {
                            var departmentId = $(this).val();
                            if (departmentId) {
                                $.ajax({
                                    url: '/get-report',
                                    type: 'GET',
                                    data: {
                                        departmentId: departmentId
                                    },
                                    success: function(response) {
                                        $('#scheme').html(response);
                                    }
                                });
                            } else {
                                $('#scheme').html('<option value="">All Scheme</option>');
                            }
                        });
                    });
                </script>
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
