﻿<!DOCTYPE html>
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
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script>
        window.onload = function() {
            document.getElementById("preloader").style.display = "none";
        }
    </script>

    <style>
        @media print {

            header,
            footer,
            img,
            a,
            .print {
                display: none;
            }
        }

        .print {
            background: #2f2f74;
            border-radius: 50px;
            color: #fff;
            padding: 0px 15px;
            height: 34px;
            min-width: 20px;
            margin: 0px auto;
            display: block;
            font-size: 15px;
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
    </style>
</head>

<body>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    <header>
        <div class="container">
            @include('website.header')
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
                                    <form action="{{ url('/Receiptt') }}" id="submit_form" method="GET"
                                        class="receipt_form">
                                        <div class="form_coll">
                                            <label style="font-size: 18PX; font-weight:500;">Search based on PRN or Mobile no</label>
                                            <input type="text" name="prn_number" placeholder="Enter PRN Number">
                                            <input type="text" name="mobile_number" placeholder="Enter Mobile Number">   
                                        </div>
                                        <div class="receipt_btn_box">
                                            <button type="submit" class="btn btn-primary"
                                                style="background: #2f2f74; border-radius: 50px; color: #fff; padding: 0px 25px; border: none; height: 40px; font-size: 18px; text-align: center; text-decoration: none;">
                                                <span style="display: block;">Search</span>
                                            </button>
                                            <a href="{{ url('Receiptt') }}"
                                                style="background: #2f2f74; border-radius: 50px; color: #fff; padding: 0px 25px; border: none; height: 40px; display: block; font-size: 18px; text-align: center; text-decoration: none;margin-right: 5px;">
                                                <span style="display: block; margin-top: 8px;">Reset</span>
                                            </a>
                                            <a href="{{ url('/website') }}"
                                                style="background: #2f2f74; border-radius: 50px; color: #fff; padding: 0px 25px; border: none; height: 40px; display: block; font-size: 18px; text-align: center; text-decoration: none;">
                                                <span style="display: block; margin-top: 8px;">Back</span>
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <div class="data_section">
                                    <div class="container">
                                        @if (isset($countries))
                                        <table id="monthly_report" class="table table-striped table-bordered"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>PRN</th>
                                                    <th>Donner Name</th>
                                                    <th>Mobile</th>
                                                    <th>Payment Amount</th>
                                                    <th>Transaction Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($countries) > 0)
                                                @foreach ($countries as $country)
                                                <tr>
                                                    <td>{{ $country->created_at }}</td>
                                                    <td>{{ $country->PRN }}</td>
                                                    <td>{{ $country->RemitterName }}</td>
                                                    <td>{{ $country->RemitterMobile }}</td>
                                                    <td>{{ $country->PaidAmount }}</td>
                                                    <td style="display:flex;justify-content: space-evenly;">
                                                        @if ($country->STATUS == 'SUCCESS')
                                                        <span style="font-weight:700" class="text-success">{{
                                                            $country->STATUS }}</span>
                                                        <a href="{{ url('Pdf?prn='.$country->PRN) }}" target="_blank">
                                                            <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"
                                                                style="color: #2f2f74; font-size: larger;"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Download PDF"></i>
                                                        </a>
                                                        @elseif ($country->STATUS == 'PENDING')
                                                        <span style="font-weight:700; color: #689cbe;">{{
                                                            $country->STATUS
                                                            }}</span>
                                                        <a href="" target="_blank">
                                                            {{-- <i class="bi bi-hourglass-top" aria-hidden="true"
                                                                style="color: #2f2f74; font-size: larger;"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Verify"></i> --}}
                                                        </a>
                                                        @else
                                                        <span class="text-danger" style="font-weight:700">{{
                                                            $country->STATUS }}</span>
                                                        <a href="" target="_blank">
                                                            {{-- <i class="bi bi-hourglass-top" aria-hidden="true"
                                                                style="color: #2f2f74; font-size: larger;"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Verify"></i> --}}
                                                        </a>
                                                        @endif
                                                    </td>

                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="6">No Result Found!</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
        </section>
    </div>

    <footer>
        @include('website.footer')
    </footer>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js2/datatables.min.js') }}"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        function printTable() {
            window.print();
        }
    </script>
    <script>
        $('.partnersSlider').owlCarousel({
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
        function printPDF(url) {
        if (confirm('Print this PDF?')) {
            const win = window.open(url, '_blank');
            win.onload = function() {
                win.print();
            };
        }
    }
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
     let table = new DataTable('#monthly_report');
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