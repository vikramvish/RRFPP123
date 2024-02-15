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
        tr {
            text-align: center;
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

        footer {
            margin-top: 224px;
        }
    </style>
</head>

<body>

    <header>
        <div id="preloader">
            <div id="loader"></div>
        </div>
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
                        {{-- navigation bar included from navbar.blade.php --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            @include('nice-html.navbar')
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="main_section dashboard">

        <div class="top_bar">
            <div class="container">
                <div class="custom_row">
                    @if(session('roleId') == 1)
                    <!-- Show data for RoleId 1 -->
                    <div class="topbar_box">
                        <div class="card td">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="bi bi-building"></i></span>
                                    Department</div>
                                <span class="value">{{ $countDepartment }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card ts">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="charity-love_hearts"></i></span>
                                    Schemes</div>
                                <span class="value">{{ $countScheme }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card na">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i
                                            class="charity-volunteer_people"></i></span> Newly Added</div>
                                <span class="value">0</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card ta">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="bi bi-bar-chart-line"></i></span>
                                    Total Transaction</div>
                                <span class="value">{{ $transactionCount }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card tdo">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="charity-gift_box"></i></span> Total
                                    Donation</div>
                                <span class="value">{{ $transactionAmount }}</span>
                            </button>
                        </div>
                    </div>
                    @elseif(session('roleId') == 2 || session('roleId') == 3 || session('roleId') == 4)
                    <!-- Show data for RoleId 2, 3, or 4 -->
                    <div class="topbar_box">
                        <div class="card td">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="bi bi-building"></i></span>
                                    Department</div>
                                <span class="value">{{ $countDepartment }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card ts">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="charity-love_hearts"></i></span>
                                    Schemes</div>
                                <span class="value">{{ $countScheme }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card na">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i
                                            class="charity-volunteer_people"></i></span> Newly Added</div>
                                <span class="value">0</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card ta">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="bi bi-bar-chart-line"></i></span>
                                    Total Transaction</div>
                                <span class="value">{{ $transactionCount }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="topbar_box">
                        <div class="card tdo">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="charity-gift_box"></i></span> Total
                                    Donation</div>
                                <span class="value">{{ $transactionAmount }}</span>
                            </button>
                        </div>
                    </div>
                    @else
                    <!-- Invalid RoleId -->
                    <div class="topbar_box">
                        <div class="card td">
                            <button type="button">
                                <div class="card_title"><span class="icon"><i class="bi bi-building"></i></span>
                                    Department</div>
                                <span class="value">0</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- {!! $chart->container() !!}

        {!! $chart->script() !!} --}}
        {{-- <div class="chart_section">
            <div class="container">
                <div class="custom_row">
                    <div class="left_chart">
                        <div class="chart_box">
                            <div class="chart_header">
                                <h4>Year wise</h4>
                                <div class="right_part">
                                    <div class="graph_radio_box">
                                        <label><input type="radio" id="yearly_donation" name="yearly_donation"
                                                value="donation_count" checked="">
                                            <span>Count</span></label>
                                        <label><input type="radio" id="yearly_donation" name="yearly_donation"
                                                value="donation_amount">
                                            <span>Amount</span></label>
                                    </div>
                                    <select>
                                        <option>2022</option>
                                        <option>2021</option>
                                        <option>2020</option>
                                        <option>2019</option>
                                        <option>2018</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart_body"><canvas id="yearly_donation_bar" style="width:100%"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="right_chart">
                        <div class="chart_box">
                            <div class="chart_header">
                                <h4>Department wise</h4>
                                <div class="right_part">
                                    <div class="graph_radio_box">
                                        <label><input type="radio" id="department_donation" name="department_donation"
                                                value="donation_count" checked="">
                                            <span>Count</span></label>
                                        <label><input type="radio" id="department_donation" name="department_donation"
                                                value="donation_amount">
                                            <span>Amount</span></label>
                                    </div>
                                    <select>
                                        <option>2022</option>
                                        <option>2021</option>
                                        <option>2020</option>
                                        <option>2019</option>
                                        <option>2018</option>
                                    </select>
                                </div>
                            </div>
                            <div class="chart_body"><canvas id="department_donation_bar" style="width:100%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
        const dropdown = document.querySelector("#filter_department");
        const tableRows = document.querySelectorAll("table tr");

        dropdown.addEventListener("change", function() {
            const selectedValue = this.value;
            tableRows.forEach(function(row) {
                if (selectedValue === "all") {
                    row.style.display = "";
                } else {
                    const cells = row.querySelectorAll("td");
                    let match = false;
                    cells.forEach(function(cell) {
                        if (cell.textContent === selectedValue) {
                            match = true;
                        }
                    });
                    if (match) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        });
    </script>
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script>
        function logout() {
            // clear the session cookie
            document.cookie = "session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

            // redirect the user to the login page
            window.location.href = "/login";
        }
    </script>

</body>

</html>