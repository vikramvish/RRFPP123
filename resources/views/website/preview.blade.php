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
    <script>
        window.onload = function() {
            document.getElementById("preloader").style.display = "none";
        }
    </script>
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
                        <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact-Us"><i
                                        class="bi bi-phone"></i></span>Contact-Us</a></li>
                        <li><a href="#" class="download"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Download Receipt"><i
                                        class="bi bi-download"></i></span>Download Receipt</a></li>
                        <li><a href="http://127.0.0.1:8000/website#help" class="donate"><span class="menu_icon"><i
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
                        <h2>Confirm Your Information</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="payment_main">

            <div class="container">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="preview_section">
                            <h4 style="color: red;margin-left: 11rem;font-size: 1.1rem;"><b>This is a Review of your
                                    submission. It has not been submitted
                                    yet !<br>
                            </h4>
                            <form action="{{ url('/website-dept') }}" method="post">
                                @csrf
                                <div class="form_box">
                                    <h3><span>Personal Information</span></h3>

                                    <div class="form-item">
                                        <label class="form-label">Scheme</label>
                                        <input type="text" class="form-control"
                                            value="{{ $selectedScheme->SchemeName }}" id="PRN" name="scheme"
                                            readonly>
                                        <input type="hidden" name="scheme_id" value="{{ $selectedScheme->SchemeId }}">
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">PRN<b style="color: red;font-weight: 700;"> * Keep PRN
                                                for further
                                                Refrence</b></label>
                                        <input type="text" class="form-control" value="{{ $PRN }}"
                                            id="PRN" name="PRN" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" value="{{ request()->RemitterName }}"
                                            id="full_name" name="RemitterName" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control"
                                            value="{{ request()->RemitterEmailId }}" id="email"
                                            name="RemitterEmailId" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control"
                                            value="{{ request()->RemitterMobile }}" id="phone_number"
                                            name="RemitterMobile" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control"
                                            value="{{ request()->RemitterAddress }}" id="RemitterAddress"
                                            name="RemitterAddress" readonly>
                                    </div>
                                </div>
                                <div class="form_box">
                                    <h3><span>Payment Information</span></h3>
                                    <div class="form-item">
                                        <label class="form-label">Pan Number</label>
                                        <input type="text" class="form-control"
                                            value="{{ request()->RemitterPAN }}" id="pan_number" name="RemitterPAN"
                                            readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control"
                                            value="{{ request()->TransactionAmount }}" id="amount"
                                            name="TransactionAmount" readonly>
                                    </div>
                                </div>
                                <div class="btn">
                                    <button type="submit" class="donate_btn">Procced to payment</button>
                                    <a href="{{ url()->previous() }}" class="donate_btn">Reject</a>

                                </div>
                            </form>
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
