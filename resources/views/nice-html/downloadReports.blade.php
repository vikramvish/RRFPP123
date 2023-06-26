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
        .container {
            max-width: 1342px;
        }

        table.dataTable thead .sorting_asc {
            background-image: none !important;
        }

        table.dataTable thead .sorting {
            background-image: none !important;
        }

        table.dataTable thead .sorting_desc {
            background-image: none !important;
        }

        /* Styling for the popup modal */
        .modal {
            display: none;
            /* Hide the modal by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 800px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
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
    <div class="container">
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
                        @csrf
                        <div class="form-row">
                            <div class="form_item">
                                <label for="from_date">From Date:</label>
                                <input type="date" class="form-control" id="from_date" name="from_date"
                                    value="{{ request('from_date') }}">
                            </div>
                            <div class="form_item">
                                <label for="to_date">To Date:</label>
                                <input type="date" class="form-control" id="to_date" name="to_date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form_item">
                                <label for="department">Department:</label>
                                <select id="department" class="form-select filter-select" name="department"
                                    value="{{ request('department') }}">
                                    <option value="" {{ request('department')==='' ? 'selected' : '' }}>
                                        All Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->DepartmentId }}" {{
                                        $selectedDepartmentId==$department->DepartmentId ? 'selected' : '' }}>
                                        {{ $department->DepartmentName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form_item">
                                <label for="scheme">Scheme:</label>
                                <select id="scheme" class="form-select filter-select" name="scheme"
                                    value="{{ request('scheme') }}">
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
                                <select data-column="0" class="form-select filter-select" name="count" id="dropdown"
                                    placeholder="Select Count">
                                    {{-- <select class="form-control" name="count" id="prn"> --}}
                                        <option value="all" {{ $selectedCount==='all' ? 'selected' : '' }}>All</option>
                                        <option value="100" {{ $selectedCount==='100' ? 'selected' : '' }}>Top 100
                                        </option>
                                        <option value="500" {{ $selectedCount==='500' ? 'selected' : '' }}>Top 500
                                        </option>
                                    </select>
                            </div>
                            <div class="form_item">
                                <label for="department">Status:</label>
                                <select class="form-select filter-select" name="STATUS" id="status">
                                    {{-- <option value="">All</option> --}}
                                    <option value="SUCCESS">SUCCESS</option>
                                    <option value="FAILED">FAILED</option>
                                    <option value="Pending">PENDING</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn">
                            <button type="submit" name="summary" class="btn btn-primary">Download
                                Summary</button>
                            <button type="submit" name="detailed" class="btn btn-primary">Download
                                detailed
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
                                <th>Count</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $displayedSchemes = [];
                            @endphp
                            @foreach ($results as $result)
                            @php
                            $schemeKey = $result->scheme?->SchemeName . '-' . $result->created_at->format('Y-m-d');
                            @endphp
                            @if (!in_array($schemeKey, $displayedSchemes))
                            <tr>
                                <td>{{ $result->created_at->format('d/m/Y') }}</td>
                                <td>{{ $result->department?->DepartmentName }}</td>
                                <td>{{ $result->scheme?->SchemeName }}</td>
                                <td>
                                    @php
                                    $count = \App\Models\tbl_transactiondetail::where('DepartmentId',
                                    $result->DepartmentId)
                                    ->where('SchemeId', $result->SchemeId)
                                    ->whereDate('created_at', $result->created_at->format('Y-m-d'));

                                    if ($result->STATUS == 'SUCCESS') {
                                    $count->whereHas('transactionpaymentdetails', function ($query) {
                                    $query->where('STATUS', 'SUCCESS');
                                    });
                                    } elseif ($result->STATUS == 'FAILED') {
                                    $count->whereHas('transactionpaymentdetails', function ($query) {
                                    $query->where('STATUS', 'FAILED');
                                    });
                                    } elseif ($result->STATUS == 'PENDING') {
                                    $count->whereHas('transactionpaymentdetails', function ($query) {
                                    $query->where('STATUS', 'PENDING');
                                    });
                                    }

                                    $count = $count->count();
                                    @endphp
                                    {{ $count }}
                                </td>
                                <td>
                                    @php
                                    $status = $result->STATUS;
                                    $totalAmount =
                                    \App\Models\tbl_transactiondetail::join('tbl_transactionpaymentdetails',
                                    'tbl_transactiondetails.PRN', '=', 'tbl_transactionpaymentdetails.PRN')
                                    ->where('tbl_transactiondetails.DepartmentId', $result->DepartmentId)
                                    ->where('tbl_transactiondetails.SchemeId', $result->SchemeId)
                                    ->whereDate('tbl_transactiondetails.created_at',
                                    $result->created_at->format('Y-m-d'));

                                    if ($status == 'SUCCESS') {
                                    $totalAmount->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS');
                                    } elseif ($status == 'FAILED') {
                                    $totalAmount->where('tbl_transactionpaymentdetails.STATUS', 'FAILED');
                                    } elseif ($status == 'PENDING') {
                                    $totalAmount->where('tbl_transactionpaymentdetails.STATUS', 'PENDING');
                                    }

                                    $totalAmount = $totalAmount->sum('tbl_transactiondetails.TransactionAmount');
                                    @endphp
                                    {{ $totalAmount }}
                                </td>
                                <td style="display:flex;justify-content: space-evenly;">
                                    @php
                                    $successCount =
                                    \App\Models\tbl_transactionpaymentdetail::join('tbl_transactiondetails',
                                    'tbl_transactionpaymentdetails.PRN', '=', 'tbl_transactiondetails.PRN')
                                    ->where('tbl_transactiondetails.DepartmentId', $result->DepartmentId)
                                    ->where('tbl_transactiondetails.SchemeId', $result->SchemeId)
                                    ->whereDate('tbl_transactiondetails.created_at',
                                    $result->created_at->format('Y-m-d'))
                                    ->where('tbl_transactionpaymentdetails.STATUS', 'SUCCESS')
                                    ->count();
                                    $failedCount =
                                    \App\Models\tbl_transactionpaymentdetail::join('tbl_transactiondetails',
                                    'tbl_transactionpaymentdetails.PRN', '=', 'tbl_transactiondetails.PRN')
                                    ->where('tbl_transactiondetails.DepartmentId', $result->DepartmentId)
                                    ->where('tbl_transactiondetails.SchemeId', $result->SchemeId)
                                    ->whereDate('tbl_transactiondetails.created_at',
                                    $result->created_at->format('Y-m-d'))
                                    ->where('tbl_transactionpaymentdetails.STATUS', 'FAILED')
                                    ->count();
                                    $pendingCount =
                                    \App\Models\tbl_transactionpaymentdetail::join('tbl_transactiondetails',
                                    'tbl_transactionpaymentdetails.PRN', '=', 'tbl_transactiondetails.PRN')
                                    ->where('tbl_transactiondetails.DepartmentId', $result->DepartmentId)
                                    ->where('tbl_transactiondetails.SchemeId', $result->SchemeId)
                                    ->whereDate('tbl_transactiondetails.created_at',
                                    $result->created_at->format('Y-m-d'))
                                    ->where('tbl_transactionpaymentdetails.STATUS', 'PENDING')
                                    ->count();
                                    @endphp

                                    @if ($result->STATUS == 'SUCCESS')
                                    <span style="font-weight:700" class="text-success">{{ $result->STATUS }}</span>
                                    @elseif ($result->STATUS == 'PENDING')
                                    <span style="font-weight:700" class="text-warning">{{ $result->STATUS }}</span>
                                    @else
                                    <span class="text-danger" style="font-weight:700">{{ $result->STATUS }}</span>
                                    @endif
                                </td>
                            </tr>
                            @php
                            $displayedSchemes[] = $schemeKey;
                            @endphp
                            @endif
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
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>Scheme</th>

                                <th>Amount</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                <td>{{ $result->created_at->format('d/m/Y') }}</td>
                                <td>{{ $result->PRN }}</td>
                                <td>{{ $result->RPPTxnId }}</td>
                                <td>{{ $result->RemitterName }}</td>
                                <td>{{ $result->RemitterMobile }}</td>
                                <td>{{ $result->department?->DepartmentName }}</td>
                                <td>{{ $result->scheme?->SchemeName }}</td>

                                <td>{{ $result->AMOUNT }}</td>
                                <td>
                                    @if ($result->STATUS == 'SUCCESS')
                                    <span style="font-weight: 700;">{{ $result->STATUS }}</span>
                                    <a href="{{ url('Pdf_Format?prn=' . $result->PRN) }}" target="_blank">
                                        <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"
                                            style="color: #2f2f74; font-size: larger;" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Download PDF"></i>
                                    </a>
                                    @elseif ($result->STATUS == 'FAILED')
                                    <span style="color: red; font-weight: 700;">{{ $result->STATUS }}</span>
                                    @else
                                    {{ $result->STATUS }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                        data-date="{{ $result->created_at->format('d/m/Y') }}"
                                        data-prn="{{ $result->PRN }}" data-rpp-txn-id="{{ $result->RPPTxnId }}"
                                        data-department="{{ $result->department?->DepartmentName }}"
                                        data-scheme="{{ $result->scheme?->SchemeName }}"
                                        data-mobile="{{ $result->RemitterMobile }}" data-pgName="{{ $result->PGName }}"
                                        data-reqtimestamp="{{ $result->REQTIMESTAMP }}"
                                        data-rpptime="{{ $result->RPPTIMESTAMP }}"
                                        data-paybankname="{{ $result->PayModeBankName }}"
                                        data-paytime="{{ $result->PaymentTimeStamp }}"
                                        data-msg="{{ $result->RESPONSEMESSAGE }}"
                                        data-pgmodebid="{{ $result->PGModeBID }}"
                                        data-paymodebank="{{ $result->PayModeBankBID }}"
                                        data-stus="{{ $result->STATUS }}" data-amt="{{ $result->AMOUNT }}">More</button>
                                    {{-- <a href="{{ route('userDetails', ['prn' => $result->PRN]) }}"
                                        class="btn btn-primary">More</a> --}}
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

    <!-- Modal -->
    <div class="modal fade custom-modal" style="z-index: 1050;" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">More Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prn-field-1" class="col-form-label">Date:</label>
                                    <input type="text" class="form-control" id="prn-field-1" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">PRN:</label>
                                    <input type="text" class="form-control" id="prn-field-2" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">RPP Transaction
                                        ID:</label>
                                    <input type="text" class="form-control" id="prn-field-3" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Department:</label>
                                    <input type="text" class="form-control" id="prn-field-4" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Scheme:</label>
                                    <input type="text" class="form-control" id="prn-field-5" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Mobile:</label>
                                    <input type="text" class="form-control" id="prn-field-6" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">PG Name:</label>
                                    <input type="text" class="form-control" id="prn-field-7" readonly
                                        value="{{ $pgNames[$result->PGName] ?? '' }}">
                                </div>
                            </div> --}}
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Request
                                        Timestamp:</label>
                                    <input type="text" class="form-control" id="prn-field-8" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">RPP
                                        Timestamp:</label>
                                    <input type="text" class="form-control" id="prn-field-9" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Paymode Bank
                                        name:</label>
                                    <input type="text" class="form-control" id="prn-field-10" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Payment
                                        Timestamp:</label>
                                    <input type="text" class="form-control" id="prn-field-11" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Message:</label>
                                    <input type="text" class="form-control" id="prn-field-12" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Paymode
                                        Bid:</label>
                                    <input type="text" class="form-control" id="prn-field-13" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Paymode Bank
                                        Bid:</label>
                                    <input type="text" class="form-control" id="prn-field-14" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Status:</label>
                                    <input type="text" class="form-control" id="prn-field-15" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Amount:</label>
                                    <input type="text" class="form-control" name="AMOUNT" id="prn-field-16" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                        $('#exampleModal').on('show.bs.modal', function(event) {
                            var button = $(event.relatedTarget); // Button that triggered the modal

                            // Retrieve the data attributes from the clicked button
                            var date = button.data('date');
                            var prn = button.data('prn');
                            var rppTxnId = button.data('rpp-txn-id');
                            var department = button.data('department');
                            var scheme = button.data('scheme');
                            var mobile = button.data('mobile');
                            var pgName = button.data('pgName');
                            var reqtimestamp = button.data('reqtimestamp')
                            var rppstamp = button.data('rpptime')
                            var paybanknam = button.data('paybankname')
                            var Paytimestamp = button.data('paytime')
                            var message = button.data('msg')
                            var pgmode = button.data('pgmodebid')
                            var paymodebankbid = button.data('paymodebank')
                            var status = button.data('stus')
                            var Amount = button.data('amt')

                       
                            // Update the modal fields with the retrieved values
                            $('#prn-field-1').val(date);
                            $('#prn-field-2').val(prn);
                            $('#prn-field-3').val(rppTxnId);
                            $('#prn-field-4').val(department);
                            $('#prn-field-5').val(scheme);
                            $('#prn-field-6').val(mobile);
                            $('#prn-field-7').val(pgName);
                            $('#prn-field-8').val(reqtimestamp);
                            $('#prn-field-9').val(rppstamp);
                            $('#prn-field-10').val(paybanknam);
                            $('#prn-field-11').val(Paytimestamp);
                            $('#prn-field-12').val(message);
                            $('#prn-field-13').val(pgmode);
                            $('#prn-field-14').val(paymodebankbid);
                            $('#prn-field-15').val(status);
                            $('#prn-field-16').val(Amount);

                            // Update other fields as needed
                        });
                    });
    </script>
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
    </div>

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

    {{-- For count in datatable --}}
    <script>
        document.getElementById('dropdown').addEventListener('change', function() {
                        var selectedCount = this.value;
                        var datatable = $('#monthly_report').DataTable();

                        if (selectedCount === 'all') {
                            datatable.page.len(-1).draw();
                        } else {
                            datatable.page.len(selectedCount).draw();
                        }
                    });
    </script>
    <script>
        // Initialize Bootstrap Tooltip
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    })
    </script>

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
                            dom: 'Bfrtip', // Show length, buttons, filter, processing, table, information
                            buttons: [
                                'copy',
                                'excel',
                                'pdf',
                                'print'
                            ]
                        });
                    });
    </script>
    <script>
        $(document).ready(function() {
                        $('.more-btn').click(function() {
                            // Get the data for the popup (replace with your own data)
                            var data1 = 'Data 1';
                            var data2 = 'Data 2';

                            // Set the data in the input fields inside the modal (replace with your own input field IDs)
                            $('#input1').val(data1);
                            $('#input2').val(data2);

                            // Show the modal popup
                            $('#myModal').css('display', 'block');
                        });

                        // Close the modal when the close button is clicked
                        $('.close').click(function() {
                            $('#myModal').css('display', 'none');
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