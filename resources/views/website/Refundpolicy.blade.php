<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/owl.carousel.min.css" rel="stylesheet" />
    <script src="js/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/owl.carousel.min.js" type="text/javascript"></script>
    <style>
        .row.b-col-default-indent .col-md-12.col-lg-9 {
            padding-right: 30px;
            margin-top: 0;
        }

        h5 {
            margin-bottom: 15px;
            font-size: 17px;
            line-height: 27px;
            color: #000;
            position: relative;
            list-style: none;
            padding-left: 25px;
            font-family: Open Sans, sans-serif;
        }

        h4.innerpage-title,
        .innerpage-title.h4 {
            font-size: 30px;
            color: #012e71;
            margin-bottom: 15px;
            text-transform: none;
            font-weight: 700;
        }

        i.bi.bi-check-circle-fill {
            color: #332f6e;
            margin-right: 7px;
        }
    </style>
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
                        <li><a href="#" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="rajGov@gmail.com"><i
                                        class="bi bi-envelope"></i></span>rajGov@gmail.com</a></li>
                        <li><a href="#" class="mobile"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="91+ 9999999999"><i
                                        class="bi bi-phone"></i></span>91+ 9999999999</a></li>
                        <li><a href="{{ url('/Receiptt') }}" class="download"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Receipt"><i
                                        class="bi bi-download"></i></span>Download Receipt</a></li>
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
                        <h2>Refund Policy</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="payment_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="response_section">
                            <h3>
                                <div class="col-md-12 col-lg-12">
                                    <div class="row b-shortcode-example">
                                        <h4 class="innerpage-title">Refund Policy</h4>
                                        <ol class="custom_list">
                                            <h5><i class="bi bi-check-circle-fill"></i> Once transaction gets successful
                                                on
                                                Rajasthan
                                                Payment Platform (RPP), same will be updated to the respective merchant
                                                department (End-User department consuming services of RPP). Decision on
                                                refunds will be solely taken by the respective merchant department only.
                                            </h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>The fees once paid will not be
                                                refunded for
                                                transactions which are successfully submitted or for successful bill
                                                payment services to the respective merchant department.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>The amount paid for successful
                                                transactions may be
                                                settled with the respective departments.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>User need to connect to the
                                                concerned
                                                Merchant-Department to take any refund, if required.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>User is bind by the refund policy
                                                of
                                                merchant
                                                department against any successful transaction.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>Refunds will be returned using
                                                the
                                                original method
                                                of payment – for example if a donation has been made by credit card, the
                                                refund will be credited by same mode of Channel to same credit card by
                                                the Merchant Department and this goes for all Pay Modes from which the
                                                customer will make the Payment.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>RPP cannot initiate any refunds
                                                on its
                                                own.
                                                Merchant department will initiate refund to the user, if required so, as
                                                per their refund policy.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>If any Convenience fees is paid
                                                by
                                                consumer on
                                                payment gateway, then it’s the sole discretion of concerned Payment
                                                Gateway to return back the convenience fees part to the consumer during
                                                refund of transaction. Rajasthan Payment Platform or all departments
                                                using services under RPP are not liable to pay convenience fees charged.
                                            </h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>The loss on this account shall
                                                not be
                                                borne either
                                                by Government or by the Banks / Payment Gateways.</h5>
                                            <h5><i class="bi bi-check-circle-fill"></i>Apart from the fee chargeable to
                                                Government
                                                against each service, bank / payment gateway transaction charges will be
                                                applicable extra. Automatic refund by respective payment gateway will be
                                                made for transactions which are not successful.</h5>
                                        </ol>
                                    </div>
                                </div>
                            </h3>
                            <table>
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
                    <li><a href="{{ url('RefundPolicy') }}">Refund Policy</a></li>
                    <li><a href="{{ url('TermsCondition') }}">Term & Condition</a></li>
                    <li><a href="{{ url('PrivacyPolicy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('CancellationPolicy') }}">Cancellation Policy</a></li>
                    <li><a href="{{ url('ChargebackGuidelines') }}">Chargeback Guidelines</a></li>
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
