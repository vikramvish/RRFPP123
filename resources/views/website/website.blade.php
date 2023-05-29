<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="css1/bootstrap.min.css" rel="stylesheet">
    <link href="css1/bootstrap-icons.css" rel="stylesheet">
    <link href="css1/styles1.css" rel="stylesheet" />
    <link href="css1/owl.carousel.min.css" rel="stylesheet" />
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/owl.carousel.min.js') }}"></script>
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
                        <li><a href="#top" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Home"><i
                                        class="bi bi-house-heart"></i></i></span>Home</a></li>
                        <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact-Us"><i
                                        class="bi bi-phone"></i></span>Contact-Us</a></li>
                        <li><a href="" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="rajasthan.gov.in"><i
                                        class="bi bi-envelope"></i></span>rajasthan.gov.in</a></li>
                        <li><a href="{{ url('/Receiptt') }}" class="download"><span class="menu_icon"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Receipt"><i
                                        class="bi bi-download"></i></span>Download Receipt</a></li>
                        <li><a href="#help" class="donate"><span class="menu_icon"><i
                                        class="bi bi-heart-fill"></i></span>Donate Now</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="main_section">
        <section class="banner">
            <img src="images/banner.jpg" alt="banner" class="banner_img">
            <div class="bannercontent">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="banner_content">
                                <h2>Lend The<br>
                                    <span>Helping Hands</span><br>
                                    Get Involved
                                </h2>
                                <a href="#help" class="donate_btn"><span class="donate_icon"><i
                                            class="bi bi-heart-fill"></i></span> Donate Now</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="cm_box">
                                <img src="images/cm-rajasthan_2018.png" id="cm">
                                <div class="content_box">
                                    <strong>Shri Ashok Gehlot</strong>
                                    <p>Hon'ble Chief Minister, Rajasthan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about_section">
            <div class="title_section">
                <div class="container">
                    <div class="custom_row">
                        <div class="title_box">
                            <h3 class="sub_title">Welcome To RRFPP</h3>
                            <h2 class="main_title">Small Actions Lead<br>
                                To Big Changes</h2>
                        </div>
                        <div class="title_righ"><i class="charity-love_hearts"></i></div>
                    </div>
                </div>
            </div>
            <div class="about_content">
                <div class="container">
                    <div class="blog_slider">
                        <div class="owl-carousel owl-theme aboutSlider">
                            @foreach ($users as $user)
                                <div class="item">
                                    <div class="blog_box">
                                        <div class="blog_img">
                                            <img src=uploads/department/{{ $user->Images }} alt="education">
                                        </div>
                                        <div class="blog_discription">
                                            <h2>{{ $user->Heading }}</h2>
                                            <p>{{ $user->ShortDescription }}
                                            </p>
                                            <a onclick="location.href='{{ url('blogpage/' . $user->Slug) }}'"
                                                class="read_more">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="aboutus">
                        <div class="about_message">
                            <p>RRFPP(Rajasthan Relief Fund Payment Portal) Assistance Fund is operated under Rajasthan
                                IT Department Office, Yojana Bhawan,C-scheme, Jaipur. The amount is
                                received by receiving the amount in the form of donation by and directly to the bank
                                account. The amount given in the form of donations to Rajasthan Relief Fund Payment
                                Portal is free from 100 percent income tax under Section 82 (G) of the Income
                                Tax Act 1961. The appropriation of this deposit is appropriated as a fixed deposit in
                                nationalized banks, post offices, government deposits scheme.</p>
                        </div>
                        <ul>
                            <li>
                                <div class="stats_box">
                                    <span class="icon"><img src="images/total_department.png"></span>
                                    <div class="stats_type">
                                        <span class="value">{{ $count }}</span>
                                        <span class="title">Department/Merchant</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="stats_box">
                                    <span class="icon"><img src="images/total_transaction.png"></span>
                                    <div class="stats_type">
                                        <span class="value">{{ $transaction }}</span>
                                        <span class="title">Total Transaction</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="stats_box">
                                    <span class="icon"><img src="images/total_amout.png"></span>
                                    <div class="stats_type">
                                        <span class="value">{{ $balance }}</span>
                                        <span class="title">Total Amount</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="btn_box">
                            <a href="#help" class="donate_btn"><span class="donate_icon"><i
                                        class="bi bi-heart-fill"></i></span> Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="recent_causes">
            <div class="container">
                <h3 class="sub_title center">Help us Now</h3>
                <h2 class="main_title center">More Recent Causes</h2>
                <div id="help" class="search_box">
                    <form action="">
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search Here For Causes ........">
                    </form>
                    @csrf
                    <div class="causes-grid" id="search-results">
                        <ul id="show">
                            @foreach ($users as $user)
                                <li class="searchable">
                                    <div class="causes-item">
                                        <div class="causes-img"><img src=uploads/department/{{ $user->Images }}>
                                        </div>
                                        <div class="causes-content">
                                            <h3>{{ $user->Heading }}</h3>
                                            <p>{{ $user->ShortDescription }}</p>
                                            <button
                                                onclick="location.href='{{ url('paymentpage', Str::slug($user->Slug)) }}'"
                                                id="donate">Donate Now</button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </section>
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
                                    <li><a href="{{ url('RefundPolicy') }}">Refund Policy</a></li>
                                    <li><a href="{{ url('TermsCondition') }}">Term & Condition</a></li>
                                    <li><a href="{{ url('PrivacyPolicy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('CancellationPolicy') }}">Cancellation Policy</a></li>
                                    <li><a href="{{ url('ChargebackGuidelines') }}">Chargeback Guidelines</a></li>
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

    {{-- for live searching on input field --}}
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".searchable").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

                // Show message if no results found
                if ($(".searchable:visible").length == 0) {
                    $("#search-results").html("<p>No results found.</p>");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dropdown').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'all') {
                    $('ul li').show();
                } else {
                    $('ul li').hide();
                    $('ul li ul:contains("' + selectedValue + '")').parent().show();
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
    <script></script>

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
