<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="css1/bootstrap.min.css" rel="stylesheet">
    <link href="css1/bootstrap-icons.css" rel="stylesheet">
    <link href="css3/bootstrap-icons.css" rel="stylesheet">
    <link href="css1/styles1.css" rel="stylesheet" />
    <link href="css1/owl.carousel.min.css" rel="stylesheet" />
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/owl.carousel.min.js') }}"></script>

    <style>
        .causes-grid ul li:nth-child(3n+1) {
            clear: both;
        }

        .col-sm-5.b-contact-form-box {
            margin-left: auto;
            background: #e0e9f5;
            padding: 30px;
            border-radius: 20px;
            width: 40%;
            margin-right: 60px;
            margin-bottom: 10px;
        }

        .col-sm-5.b-contact-form-box .f-title-description {
            font-size: 24px;
            line-height: 24px;
            color: #03a0fe;
            font-weight: 700;
        }

        .b-google-map__info-window-address-title.f-google-map__info-window-address-title {
            pointer-events: none;
            color: #03a0fe;
            font-weight: 700;
            text-transform: capitalize;
            font-size: 16px;
        }

        .col-sm-5.b-contact-form-box a {
            color: #333;
            text-decoration: none;
        }

        .b-title-description__comment.f-title-description__comment.f-primary-l {
            color: #012e71;
            text-transform: none;
            font-weight: 400;
            font-size: 15px;
            margin-top: 5px;
        }

        img {
            width: 100%;
            height: 100%;
        }

        .main_section {
            display: flex;
            align-items: center;
        }

        h4 {
            color: #012e71;
            font-weight: 700;
            font-size: 30px;
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
                        <li><a href="{{ url('website') }}" class="email"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home"><i
                                        class="bi bi-house-heart"></i></i></span>Home</a></li>
                        <li><a href="" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="rajasthan.gov.in"><i
                                        class="bi bi-envelope"></i></span>rajasthan.gov.in</a></li>
                        <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact-Us"><i
                                        class="bi bi-phone"></i></span>Contact-Us</a></li>
                        <li><a href="{{ url('/Receiptt') }}" class="download"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Receipt"><i
                                        class="bi bi-download"></i></span>Download Receipt</a></li>
                        <li><a href="{{ url('website#help') }}" class="donate"><span class="menu_icon"><i
                                        class="bi bi-heart-fill"></i></span>Donate Now</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
    </header>
    <section>
        <div class="container" style="text-align: center;">
            <h4> Contact Us for Better Information! </h4>
           
            <p style="font-size: 18px">Drop us a line, or give us a heads up if you're interested in visiting us.</p>
        </div>
    </section>
    <br>
    <br>
    <div class="main_section">
        <div class="col-sm-5 b-contact-form-box">
            <img src="{{ asset('images/contact.jpg') }}" alt="Contact images">
        </div>
        <div class="col-sm-5 b-contact-form-box">
            <h3 class="f-primary-b b-title-description f-title-description"><i class="bi bi-person-lines-fill"></i>
                Contact Info <div class="b-title-description__comment f-title-description__comment f-primary-l">
                    Contact From You Can Find Us.</div>
            </h3>
            <div class="row b-google-map__info-window-address">
                <ul class="list-unstyled">
                    <li class="col-xs-12">
                        <div class="b-google-map__info-window-address-icon f-center pull-left"
                            style="pointer-events: none;"><i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <div class="b-google-map__info-window-address-title f-google-map__info-window-address-title"
                                style="pointer-events: none;"><i class="bi bi-building"></i>Rajasthan Fund Portal</div>
                            <div class="desc">RajCOMP Info Services Ltd. (RISL), 1st Floor,
                                C-Block, Yojana Bhawan, Tilak Marg, C-Scheme, Jaipur-302005 (Raj) INDIA.</div>
                        </div>
                    </li>
                    <li class="col-xs-12">
                        <div class="b-google-map__info-window-address-title f-google-map__info-window-address-title"
                            style="pointer-events: none;"><i class="bi bi-envelope"></i>Email</div>
                        <div class="desc"><a href="{{ url('contactus') }}"
                                target="_top">support[dot]rajasthan[dot]gov[dot]in</a>
                        </div>
            </div>
            </li>
            </ul>
        </div>
    </div>
    {{-- <section class="banner">
            <img src="images/banner.jpg" alt="banner" class="banner_img">
        </section> --}}
    </div>
    <section class="partners_section">
        <div class="container">
            <h3 class="sub_title center">Partners</h3>
            <h2 class="main_title center">Our Partners</h2>
            <div class="partners_slider">
                <div class="owl-carousel owl-theme partnersSlider">
                    <div class="item">
                        <div class="partners_box">
                            <div class="partners_img">
                                <img src="images/rcmrf_logo.png" alt="cmrf">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="partners_box">
                            <div class="partners_img">
                                <img src="images/gmrf_logo.png" alt="gmrf">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="partners_box">
                            <div class="partners_img">
                                <img src="images/devsthan_logo.png" alt="devsthan">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="partners_box">
                            <div class="partners_img">
                                <img src="images/patner_rajgov_logo.png" alt="rajgov">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <footer>
        <div class="footer_top">
            <div class="container">
                <div class="footer_row">
                    <div class="footer_left">
                        <div class="footerLeft_inner">
                            <ul>
                                <li>
                                    <div class="footer_item">
                                        <div class="ci_header"><span class="ci_icon"><i
                                                    class="bi bi-person-bounding-box"></i></span>
                                            <h3>Nodal Officer</h3>
                                        </div>
                                        <p>Dr. Yuvraj Singh Gurjar,<br>SA ( Joint Director )<br>RISL, Jaipur, Rajasthan
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer_item">
                                        <div class="ci_header"><span class="ci_icon"><i
                                                    class="bi bi-building"></i></span>
                                            <h3>Address</h3>
                                        </div>
                                        <p>RajCOMP Info Services Ltd. (RISL), 1st Floor, C-Block, Yojana Bhawan, Tilak
                                            Marg, C-Scheme, Jaipur-302005 (Raj) INDIA.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_middle">
                        <div class="footermiddle_inner">
                            <div class="fml_box">
                                <div class="ci_header"><span class="ci_icon"><i class="bi bi-globe2"></i></span>
                                    <h3>Information</h3>
                                </div>
                                <ul>
                                    <li><a href="{{ url('refundpolicy') }}">Refund Policy</a></li>
                                    <li><a href="#">Term & Condition</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Cancellation Policy</a></li>
                                    <li><a href="#">Chargeback Guidelines</a></li>
                                </ul>
                            </div>
                            <div class="fml_box">
                                <div class="ci_header"><span class="ci_icon"><i class="bi bi-globe2"></i></span>
                                    <h3>Useful Links</h3>
                                </div>
                                <ul>
                                    <li><a href="https://rajasthan.gov.in" rel="noopener noreferrer"
                                            target="_blank">Government of Rajasthan</a></li>
                                    <li><a href="https://doitc.rajasthan.gov.in/" rel="noopener noreferrer"
                                            target="_blank">Department of IT &amp; Communication</a></li>
                                    <li><a href="https://risl.rajasthan.gov.in" rel="noopener noreferrer"
                                            target="_blank">RajCOMP Info Services Ltd</a></li>
                                    <li><a href="https:///emitra.rajasthan.gov.in" rel="noopener noreferrer"
                                            target="_blank">Emitra</a></li>
                                    <li><a href="https://sampark.rajasthan.gov.in/" rel="noopener noreferrer"
                                            target="_blank">Rajasthan Sampark</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer_right">
                        <div class="mapbox">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3558.010963212742!2d75.79652051501928!3d26.903147166978414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db696bfffffff%3A0xee47ad2808fd8f37!2sRajCOMP%20Info%20Services%20Ltd.!5e0!3m2!1sen!2sin!4v1657776909709!5m2!1sen!2sin"
                                width="" height="" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" style="border: 0;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <p>Copyright © 2022 - All rights reserved dept of IT&C, Govt of rajasthan </p>
            </div>
        </div>
    </footer>
    <script>
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
    <script>
       
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        $('.aboutSlider').owlCarousel({
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
</body>

</html>
