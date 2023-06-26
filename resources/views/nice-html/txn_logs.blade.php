<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>

    <link href="{{ asset('css3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css3/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css3/owl.carousel.min.css') }}" rel="stylesheet" />
    <!-- Add the DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">


    <style>
        .btn-primary {
            color: #fff;
            background-color: #2f2f74;
            border-color: #2f2f74;
            width: 8%;
        }

        .datatable-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .table {
            table-layout: fixed;
        }

        .table .wrap-cell {
            max-height: 200px;
            overflow: auto;
        }

        table#monthly_report td span.wrapData {
            width: calc(1300px - 210px);
            /* display: inline-block; */
            max-width: 100%;
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

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: white;
        }

        .datatable-container {
            max-width: 100%;
            overflow-x: auto;
        }

        #monthly_report {
            width: 100%;
            table-layout: fixed;
        }

        #monthly_report th,
        #monthly_report td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
                    <h3 class="card-title">View Logs</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form action="{{ route('txnlog') }}" method="get">
                        @csrf
                        <div class="form_row">
                            <div class="form_item">
                                <label>Search with PRN</label>
                                <input type="text" id="SchemeName_eng" name="prn" placeholder="Enter PRN" class="form-control" required value="{{ request('prn') }}">
                            </div>
                            <div class="form_item">
                                <label for="Service">Service Type</label>
                                <select id="department" class="form-select filter-select" name="department" value="">
                                    <option value="">All</option>
                                    <option value="Payment" {{ request('department')==='Payment' ? 'selected' : '' }}>
                                        Payment</option>
                                    <option value="PENDING" {{ request('department')==='PENDING' ? 'selected' : '' }}>
                                        Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn_row">
                            <input type="submit" value="Submit" class="primary_btn">
                            <button type="button" class="primary_btn">
                                <a href="{{ url('txn_log') }}">Reset</a>
                            </button>
                        </div>
                    </form>

                    @if($logsJson && request('prn'))
                    <div class="datatable-container">
                        <table id="monthly_report">
                            <thead>
                                <tr>
                                    <th style="width: 40.625px;">View</th>
                                    <th>Date</th>
                                    <th>Encrypted Request</th>
                                    <th>Decrypted Request</th>
                                    <th>Encrypted Response</th>
                                    <th>Decrypted Response</th>
                                    <th style="width: 60.625px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logsJson as $log)
                                <tr>
                                    <td>
                                        <span class="wrapData">
                                            <a href="#" class="showPopup" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-created="{{ $log->created_at }}"
                                                data-encrypted-request="{{ $log->EncryptedRequest }}"
                                                data-decrypted-request="{{ $log->DecryptedRequest }}"
                                                data-encrypted-response="{{ $log->EncryptedResponse }}"
                                                data-decrypted-response="{{ $log->DecryptedResponse }}">
                                                <i class="bi bi-eye-fill" style="color: #423aa3;"></i>
                                            </a>
                                        </span>
                                    </td>
                                    <td><span class="wrapData" style="display: contents;">{{ $log->created_at }}</span>
                                    </td>
                                    <td><span class="wrapData">{{ $log->EncryptedRequest }}</span></td>
                                    <td><span class="wrapData">{{ $log->DecryptedRequest }}</span></td>
                                    <td><span class="wrapData">{{ $log->EncryptedResponse }}</span></td>
                                    <td><span class="wrapData">{{ $log->DecryptedResponse }}</span></td>
                                    <td>
                                        @if ($log->STATUS == 'SUCCESS')
                                        <span class="wrapData text-success" style="font-weight: 700;">{{ $log->STATUS
                                            }}</span>
                                        @elseif ($log->STATUS == 'FAILED')
                                        <span class="wrapData text-danger" style="font-weight: 700;">FAILED</span>
                                        @elseif ($log->STATUS == 'PENDING')
                                        <span class="wrapData text-info" style="font-weight: 700;">{{ $log->STATUS
                                            }}</span>
                                        @else
                                        <span class="wrapData">{{ $log->STATUS }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal start -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logs Details</h5>
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
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prn-field-2" class="col-form-label">Encrypted Request:</label>
                                    <textarea class="form-control" id="prn-field-2" rows="8" readonly></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prn-field-3" class="col-form-label">Decrypted Request:</label>
                                    <textarea class="form-control" id="prn-field-3" rows="9" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prn-field-4" class="col-form-label">Encrypted Response:</label>
                                    <textarea class="form-control" id="prn-field-4" rows="7" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="prn-field-5" class="col-form-label">Decrypted Response:</label>
                                    <textarea class="form-control" id="prn-field-5" rows="6" readonly></textarea>
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
    <!-- Modal end -->

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
        document.querySelectorAll('.showPopup').forEach(function(element) {
    element.addEventListener('click', function(event) {
        event.preventDefault();

        var created = this.getAttribute('data-created');
        var encryptedRequest = this.getAttribute('data-encrypted-request');
        var decryptedRequest = this.getAttribute('data-decrypted-request');
        var encryptedResponse = this.getAttribute('data-encrypted-response');
        var decryptedResponse = this.getAttribute('data-decrypted-response');

        document.getElementById('prn-field-1').value = created;
        document.getElementById('prn-field-2').value = encryptedRequest;
        document.getElementById('prn-field-3').value = decryptedRequest;
        document.getElementById('prn-field-4').value = encryptedResponse;
        document.getElementById('prn-field-5').value = decryptedResponse;

        $('#exampleModal').modal('show');
    });
});

    </script>
    <script>
        $(document).ready(function() {
                        $('#monthly_report').DataTable({
                            dom: 'Bfrt', // Show length, buttons, filter, processing, table, information
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