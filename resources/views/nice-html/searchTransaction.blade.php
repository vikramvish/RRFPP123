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
                <title>search_Transaction</title>
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
                <script>
                    window.onload = function() {
                        document.getElementById("preloader").style.display = "none";
                    }
                </script>
                <style>
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
                    <div class="card">
                        <div class="row">
                            <div class="card-header">
                                <h4 class="card-title">Search Transaction</h4>
                            </div>
                            <div id="searchResults">
                                <form action="{{ route('search') }}" method="GET">
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
                                            <label for="prn_number">PRN:</label>
                                            <input type="text" class="form-control" id="prn_number"
                                                name="prn_number">
                                        </div>
                                        <div class="form_item">
                                            <label for="prn_number">RPP Transaction Id:</label>
                                            <input type="text" class="form-control" id="txn_id" name="RPPTxnId">
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
                                                    {{-- Show a default option if no schemes are available --}}
                                                    <option value="">No Schemes Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form_item">
                                            <label for="prn_number">PG Bid:</label>
                                            <input type="text" class="form-control" id="prn_number" name="PGModeBID">
                                        </div>
                                        <div class="form_item">
                                            <label for="prn_number">PG Bank bid:</label>
                                            <input type="text" class="form-control" id="txn_id"
                                                name="PayModeBankBID">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form_item">
                                            <label for="prn">Count</label>
                                            @if ($results->isNotEmpty() && isset($searched))
                                                <input type="text" class="form-control" name="count" id="prn" value="{{ $count }}" readonly>
                                            @else
                                                <input type="text" class="form-control" name="count" id="prn" value="" readonly>
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
                                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                                        <button type="button" class="btn btn-primary">
                                            <a href="{{ url('search_transaction') }}">Reset</span>
                                            </a></button>
                                        {{-- <button type="button" class="btn btn-primary"
                                        onclick="clearCacheAndRefresh()">Reset</button> --}}
                                    </div>
                                </form>
                            </div>
                            {{-- @if ($results->isNotEmpty() && isset($searched)) --}}
                            @if ($searched)
                              @if ($results->isNotEmpty())
                            <table id="monthly_report" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>PRN</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Scheme</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->created_at }}</td>
                                            <td>{{ $result->PRN }}</td>
                                            <td>{{ $result->RemitterName }}</td>
                                            <td>{{ $result->RemitterMobile }}</td>
                                            <td>{{ $result->scheme?->SchemeName }}</td>
                                            <td style="display:flex;justify-content: space-evenly;">
                                                @if ($result->STATUS == 'SUCCESS')
                                                    <span style="font-weight:700" class="text-success">{{ $result->STATUS }}</span>
                                                    {{-- <button type="button" class="print" onclick="printTable()">Print PDF</button> --}}
                                                    <a href="{{ url('Pdf_Format?prn='.$result->PRN) }}" class="btn btn-primary">Print PDF</a>
                                                @else
                                                    <span class="text-danger" style="font-weight:700">{{ $result->STATUS }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{-- @elseif ($results->isEmpty() && isset($searched))
                            <p>No data found.</p>
                        @endif --}}
                        @else
                        <p>No data found.</p>
                    @endif
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

                <script>
                    < script src = "https://code.jquery.com/jquery-3.6.0.min.js" >
                </script>
                <script>
                    function clearCacheAndRefresh() {
                        // Clear cache
                        window.location.reload(true);
                    }
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#resetButton").click(function() {
                            localStorage.removeItem("searchData");
                            location.reload(true);
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#department').on('change', function() {
                            var departmentId = $(this).val();
                            if (departmentId) {
                                $.ajax({
                                    url: '/get-schemes',
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
