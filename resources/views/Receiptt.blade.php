<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="css2/bootstrap.min.css" rel="stylesheet">
    <link href="css2/bootstrap-icons.css" rel="stylesheet">
    <link href="css2/styles.css" rel="stylesheet" />
    <link href="css2/owl.carousel.min.css" rel="stylesheet" />

    <script type="text/javascript" src="{{ URL::asset('js2/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/datatables.min.js') }}"></script>
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
        <div class="container">
            <div class="custom_row">
                <div class="logo"><img src="images/rajgov_logo.png"></div>
                <div class="menu">
                    <ul>
                        <li><a href="{{ url('/website') }}" class="home"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                    data-bs-original-title="Home" aria-label="Home"><i
                                        class="bi bi-house-heart"></i></span>Home</a></li>
                        <li><a href="#" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="rajGov@gmail.com"><i
                                        class="bi bi-envelope"></i></span>rajGov@gmail.com</a></li>
                        <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact-Us"><i
                                        class="bi bi-phone"></i></span>Contact-Us</a></li>
                        <li><a href="{{ url('website#help') }}" class="donate"><span class="menu_icon"><i
                                        class="bi bi-heart-fill"></i></span>Donate Now</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="main_section">
        <section class="inner-banner">
            <img src="images/banner.jpg" alt="banner" class="banner_img">
            <div class="bannercontent">
                <div class="container">
                    <div class="banner_content">
                        <h2>Receipt Download</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="payment_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="receipt_section">
                            <div class="card">
                                <div class="card-header">
                                    <p>Get Receipt</p>
                                </div>
                                <div class="card-body">
                                    <form action="/Receiptt" id="submit_form" method="GET"
                                        class="receipt_form">
                                        <div class="form_coll">
                                            <label>Search Based On Mobile No./ PRN</label>
                                            <input type="text" maxlength="10" name="PRN-Number"
                                                placeholder="Enter Mobile Number or PRN Number">
                                        </div>
                                        <div class="receipt_btn_box">
                                            <button type="submit" id="link" value="Search"
                                                class="reset">Search</button>
                                            <a href="{{ url('Receiptt') }}"
                                                style="background: #2f2f74;
											border-radius: 50px;
											color: #fff;
											padding: 0px 25px;
											border: none;
											height: 40px;
											min-width: 150px;
											display: block;
											font-size: 18px;
											text-align: center;
										    text-decoration: none;">
                                                <span style="display: block;margin-top: 8px;"> Reset </span>
                                            </a>
                                            <a href="{{ url('/website') }}"
                                                style="background: #2f2f74;
											border-radius: 50px;
											color: #fff;
											padding: 0px 25px;
											border: none;
											height: 40px;
											min-width: 150px;
											display: block;
											font-size: 18px;
											text-align: center;
										    text-decoration: none;">
                                                <span style="display: block;margin-top: 8px;"> Back </span>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data_section">
                    <div class="container">
                        @if (isset($countries))
                            <table id="monthly_report" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Prn</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>RPP Txn Id</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Amount</th>
                                        <th>Transaction Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($countries) > 0)
                                        @foreach ($countries as $contry)
                                            <tr>
                                                <td>{{ $contry->PRN }}</td>
                                                <td>{{ $contry->RemitterName }}</td>
                                                <td>{{ $contry->RemitterMobile }}</td>
                                                <td>{{ $contry->RPPTxnId }}</td>
                                                <td>{{ $contry->PGModeBID }}</td>
                                                <td>{{ $contry->PaidAmount }}</td>
                                                <td>{{ $contry->RESPONSEMESSAGE }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <br>
                                        <tr>
                                            <td>No Result Found!</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                                {{-- <span style="color: red"> <b>Note:- * Keep PRN For further Reference</b> </span> --}}
                                <br>
                                <br>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
    </div>
    </section>
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
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        $('.recentcausesSlider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>

    {{-- script to show all data in datatable --}}
    {{-- <script>
        $(document).ready(function() {
            $('#monthly_report').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
            });
        });
    </script> --}}
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
        $(document).ready(function() {

            $(".qa").click(function() {
                var qa = $(this).text();
                var qanum = parseInt(qa);
                $('#amount').val(qanum);
            });
            $(".qa1").click(function() {
                var qa1 = $(this).text();
                var qanum1 = parseInt(qa1);
                $('#amount1').val(qanum1);
            });

        });
    </script>
</body>

</html>
