<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/owl.carousel.min.css" rel="stylesheet" />
    <script src="js/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/owl.carousel.min.js" type="text/javascript"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="custom_row">
                <div class="logo"><img src="images/rajgov_logo.png"></div>
                <div class="menu">
                    <ul>
                        <li><a href="{{ '/website' }}" class="email"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home"><i
                                        class="bi bi-house-heart"></i></i></span>Home</a></li>
                        <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact-Us"><i
                                        class="bi bi-phone"></i></span>Contact-Us</a></li>
                        <li><a href="#" class="mobile"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="91+ 9999999999"><i
                                        class="bi bi-phone"></i></span>91+ 9999999999</a></li>
                        <li><a href="{{ url('/Receiptt') }}" class="download"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Receipt"><i
                                        class="bi bi-download"></i></span>Download Receipt</a></li>
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
                            <div class="alert alert-danger">
                                Transaction is Failed
                            </div>
                            <table>
                                {{-- @foreach ($user as $users) --}}
                                @if ($collection->RemitterName)
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $collection->RemitterName }} </td>
                                        </tr>
                                    @endif

                                    @if ($collection->RemitterMobile)
                                        <tr>
                                            <th>Mobile Number</th>
                                            <td>{{ $collection->RemitterMobile }} </td>
                                        </tr>
                                    @endif
                                {{-- @endforeach --}}
                                <tr>
                                    <th>PRN</th>
                                    <td>{{ $saveData->PRN }}</td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td>{{ $saveData->CURRENCY }}</td>
                                </tr>
                                <tr>
                                    <th>RPP Txn Id</th>
                                    <td>{{ $saveData->RPPTXNID }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td>{{ $saveData->PAYMENTMODE }} </td>
                                </tr>
                                <tr>
                                    <th>RPP Timestamp</th>
                                    <td>{{ $saveData->RPPTIMESTAMP }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Amount</th>
                                    <td>{{ $saveData->PAYMENTAMOUNT }} </td>
                                </tr>
                                <tr>
                                    <th>Payment Mode Bid</th>
                                    <td>{{ $saveData->PAYMENTMODEBID }} </td>
                                </tr>
                                <tr>
                                    <th>Transaction Status</th>
                                    <td>{{ $saveData->RESPONSEMESSAGE }} </td>
                                </tr>
                            </table>
                            <a href="{{ '/website' }}"> <button type="button" class="back_btn">Back</button>
                            </a>
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
