<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>
    <link href="{{ URL::asset('css1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/styles1.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/owl.carousel.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ URL::asset('js2/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/datatables.min.js') }}"></script>

    {{-- <script>
        window.onload = function() {
            document.getElementById("preloader").style.display = "none";
        }
    </script> --}}
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

        .print {
            background: #2f2f74;
            border-radius: 50px;
            color: #fff;
            padding: 0px 25px;

            height: 40px;
            min-width: 200px;
            margin: 0px auto;
            display: block;
            font-size: 18px;
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

        td {
            width: 40%;
        }

        @media print {

            header,
            footer,
            img,
            a,
            .print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            @include('website.header')
        </div>
    </header>
    <div class="main_section">
        <section class="inner-banner">
            <img src="{{ asset('images/banner.jpg') }}" alt="banner" class="banner_img">
            <div class="bannercontent">
                <div class="container">
                    <div class="banner_content">
                        <h2>Payment Response</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="payment_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="response_section">
                            @if (Request::is('data/*'))
                                <div class="message cancel"
                                    style="background-color: indianred;color:#ffffff;text-align:center;font-size:18px">
                                    Transaction is failed
                                </div>
                            @elseif(Request::is('successdata/*'))
                                <div class="message success"
                                    style="text-align:center;font-size:18px;background: #4b994b;">
                                    Transaction is successful
                                </div>
                            @endif
                            <div class="container">
                                <h3> <span style="font-size: 22px;">Transaction Details</span></h3>
                                @if ($collection)
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th>PRN (Unique Id)</th>
                                                <td>{{ $collection->PRN ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Amount</th>
                                                <td>{{ $collection->AMOUNT ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $collection->RemitterName ?? 'Not provided' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile Number</th>
                                                <td>{{ $collection->RemitterMobile ?? 'Not provided' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Remitter Email</th>
                                                <td>{{ $collection->RemitterEmailId ?? 'Not provided' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <h3> <span style="font-size: 22px;">Payment Details</span></h3>
                                    <table>
                                        <tbody>
                                            @if (Request::is('successdata/*'))
                                                <tr>
                                                    <th>RPP Payment Txn</th>
                                                    <td>{{ $collection->RPPTxnId ?? '' }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>Payment Mode</th>
                                                <td>{{ $collection->PayModeBankName ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment Mode Bid</th>
                                                <td>{{ $collection->PGModeBID ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Transaction Status</th>
                                                <td style="font-weight: 700;">{{ $collection->RESPONSEMESSAGE ?? '' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        @else
                            <div id="loader" class="loader"></div>
                            @endif
                            <div class="btn" style="display: flex;margin-left: 200px;">
                                <a href="{{ '/website' }}">
                                    <button type="button" class="back_btn">Back</button>
                                </a>
                                <button type="button" class="print" onclick="printTable()">Print PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <footer>
        @include('website.footer')
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show loader until the page is fully loaded
            document.getElementById("loader").style.display = "block";
        });

        window.addEventListener("load", function() {
            // Hide loader when the page is fully loaded
            document.getElementById("loader").style.display = "none";
        });
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    {{-- code provided is includes functions to show and hide a loader, and a function to check if the PRN value exists. --}}
    <script>
        function showLoader() {
            document.getElementById("preloader").style.display = "block";
            document.getElementById("content").style.display = "none";
        }

        function hideLoader() {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("content").style.display = "block";
        }

        function checkPRN() {
            var prn = document.getElementById("prn").innerHTML;
            if (prn != "") {
                hideLoader();
            } else {
                showLoader();
                setTimeout(checkPRN, 5000); // check again after 5 seconds
            }
        }

        window.onload = function() {
            showLoader();
            checkPRN();
        }
    </script>

    <script>
        function printTable() {
            window.print();
        }
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
    </div>
</body>

</html>
