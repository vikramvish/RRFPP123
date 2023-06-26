@if (session('userRights'))
    @php
        $hasPermission = false;
    @endphp
    @foreach (session('userRights') as $right)
        @if ($right->RightCode == 'MANAGEMENT_CMS')
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
                    button.btn.btn-primary {
                        background: #2f2f74;
                        border-color: #2f2f74 !important;
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
                <div id="preloader">
                    <div id="loader"></div>
                </div>
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

                <div class="data_section" style="margin-top: 35px;">
                    <div class="container">
                        <div class="fillter">
                            <form action="" method="GET" id="fillter_data">
                                <div class="filler_coll">
                                    <select data-column="0" class="form-select filter-select" name="scheme"
                                        id="dropdown" placeholder="Select Scheme">
                                        <option value="all">All Department</option>
                                        @foreach ($user as $schemes)
                                            <option value="{{ $schemes->DepartmentName }}">
                                                {{ $schemes->DepartmentName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </form>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        <div class="addbtn filter_box">
                            <div class="container">
                                <div class="fillter">
                                    <form id="fillter_data" style="justify-content: end;">
                                        <div class="btnbox">
                                            {{-- <a class="btn primary_btn" id="filter_btn">Filter</a> --}}
                                            <a class="secondary_btn add_btn" href="{{ url('add_dept_content') }}"> <span><i
                                                        class="bi bi-plus-lg"></i></span> Add Department Content</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Department</th>
                                    <th>Slug</th>
                                    <th>Heading</th>
                                    <th>Short Description</th>
                                    <th>Long Description</th>
                                    <th>Images</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    <tr>
                                        <td>{{ $users->DepartmentId }}</td>
                                        <td>{{ $users->DepartmentName }}</td>
                                        <td>{{ $users->Slug }}</td>
                                        <td>{{ $users->Heading }}</td>
                                        <td>{{ $users->ShortDescription }}</td>
                                        <td>{{ $users->LongDescription }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/department/' . $users->Images) }}"
                                                width="70px" height="70" alt="Image" </td>
                                        </td>
                                        <td>
                                            <a class="btn"
                                                href="{{ url('updateDepartment/' . $users->DepartmentId) }}">
                                                <button type="button" value=""
                                                    class="btn btn-primary editbtn btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal">Update</button></a>
                                        </td>
                                        <td>
                                            <a class="btn"
                                                href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                                onclick="return confirm('Are you sure You Want to Delete?')">
                                                <button type="button" value=""
                                                    class="btn btn-danger deletebtn btn-sm" data-toggle="modal"
                                                    data-target="#exampleModal">Delete</button></a>
                                        </td>
                                        {{-- @if (session('role') == '1')
                                            <td>
                                                <a class="btn"
                                                    href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                                    onclick="return confirm('Are you sure You Want to Delete?')">
                                                    <button type="button" value=""
                                                        class="btn btn-danger deletebtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal">Delete</button></a>
                                            </td>
                                        @elseif (session('role') == '2')
                                            <td>
                                                <a class="btn"
                                                    href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                                    onclick="return confirm('Are you sure You Want to Delete?')"
                                                    style="pointer-events: none;">
                                                    <button type="button" value=""
                                                        class="btn btn-danger deletebtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal" disabled>Delete</button></a>
                                            </td> --}}

                                        {{-- <input type="submit" value="Submit" class="primary_btn"
                                    onclick="alert('This button is disabled')" disabled> --}}
                                        {{-- @elseif (session('role') == '3') --}}
                                        <!-- Button for condition 3 -->
                                        {{-- <td>
                                                <a class="btn"
                                                    href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                                    onclick="return confirm('Are you sure You Want to Delete?')">
                                                    <button type="button" value=""
                                                        class="btn btn-danger deletebtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal">Delete</button></a>
                                            </td>
                                        @elseif (session('role') == '4') --}}
                                        <!-- Button for condition 4 -->
                                        {{-- <td>
                                                <a class="btn"
                                                    href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                                    onclick="return confirm('Are you sure You Want to Delete?')">
                                                    <button type="button" value=""
                                                        class="btn btn-danger deletebtn btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal">Delete</button></a>
                                            </td>
                                        @endif --}}


                                        {{-- <td>
                                <a class="btn" href="{{ url('deletedepartment/' . $users->DepartmentId) }}"
                                    onclick="return confirm('Are you sure You Want to Delete?')">
                                    <button type="button" value="" class="btn btn-danger deletebtn btn-sm"
                                        data-toggle="modal" data-target="#exampleModal">Delete</button></a>
                            </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

                {{-- <script type="text/javascript" src="{{ URL::asset('js3/bootstrap.bundle.min.js') }}"></script> --}}
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
                    const ctx = document.getElementById('yearly_donation_bar');
                    var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    var count = [100, 150, 90, 120, 70, 95, 110, 80, 120, 85, 140, 105];
                    var amount = [10000, 15000, 9000, 12000, 7000, 9500, 11000, 8000, 12000, 8500, 14000, 10500];
                    var barColors = ['rgba(248, 218, 189, 0.5)',
                        'rgba(222, 240, 250, 0.5)',
                        'rgba(232, 214, 240, 0.5)',
                        'rgba(197, 240, 231, 0.5)'
                    ];

                    const yearly_donation_chart = new Chart(ctx, {
                        type: 'bar',

                        data: {
                            labels: xValues,
                            datasets: [{ //[0]
                                    label: 'Total Count',
                                    data: count,
                                    borderWidth: 1,
                                    backgroundColor: barColors
                                },
                                { //[1]
                                    label: 'Total Amount',
                                    data: amount,
                                    borderWidth: 1,
                                    backgroundColor: barColors,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'top'
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });

                    //Call Default
                    yearly_donation_chart.show(0);
                    yearly_donation_chart.hide(1);

                    $('.graph_radio_box input:radio[name="yearly_donation"]').change(function() {
                        if ($(this).val() == 'donation_count') {
                            yearly_donation_chart.show(0);
                            yearly_donation_chart.hide(1);
                        } else {
                            yearly_donation_chart.show(1);
                            yearly_donation_chart.hide(0);
                        }
                    });
                </script>

                <script>
                    var xValues = ["CMRF", "GMRF", "Gaushala", "Devasthan"];
                    var count = [100, 25, 20, 35];
                    var amount = [5000, 2500, 2000, 3500];
                    var barColors = [
                        "#f8dabd",
                        "#def0fa",
                        "#e8d6f0",
                        "#c5f0e7"
                    ];

                    const department_donation_chart = new Chart("department_donation_bar", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                    backgroundColor: barColors,
                                    data: count
                                },
                                {
                                    backgroundColor: barColors,
                                    data: amount
                                }
                            ]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: "top",
                                }
                            }
                        }
                    });

                    //Call Default
                    department_donation_chart.show(0);
                    department_donation_chart.hide(1);

                    $('.graph_radio_box input:radio[name="department_donation"]').change(function() {
                        if ($(this).val() == 'donation_count') {
                            department_donation_chart.show(0);
                            department_donation_chart.hide(1);
                        } else {
                            department_donation_chart.show(1);
                            department_donation_chart.hide(0);
                        }
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
                    You have To take Permission from super admin to access this page.!
                </div>

                <div class="buttons">
                    <a class="button" href="{{ url('/dashboard') }}">Go to Dashboard</a>
                </div>
            </div>
        </body>

        </html>
    @endif
@endif
