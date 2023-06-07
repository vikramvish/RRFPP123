<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact-Us</title>
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
            @include('website.header')
        </div>
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
                                <p>Address: {{ config('config.address') }}</p>
                                {{-- <div class="desc">RajCOMP Info Services Ltd. (RISL), 1st Floor,
                                C-Block, Yojana Bhawan, Tilak Marg, C-Scheme, Jaipur-302005 (Raj) INDIA.</div> --}}
                        </div>
                    </li>
                    <li class="col-xs-12">
                        <div class="b-google-map__info-window-address-title f-google-map__info-window-address-title"
                            style="pointer-events: none;"><i class="bi bi-envelope"></i>Email</div>
                        <div class="desc"><a href="{{ url('contactus') }}"
                                target="_top">{{ config('config.Email') }}</a></div>

                    </li>
                    <li class="col-xs-12">
                        <div class="b-google-map__info-window-address-title f-google-map__info-window-address-title"
                            style="pointer-events: none;"><i class="bi bi-phone"></i>Helpdesk No:-</div>
                        <div class="desc"><a href="{{ url('contactus') }}"
                                target="_top">{{ config('config.PHONE') }}</a></div>
                    </li>
                </ul>
            </div>
        </div>
        {{-- <section class="banner">
            <img src="images/banner.jpg" alt="banner" class="banner_img">
        </section> --}}
    </div>
    <footer>
        @include('website.footer')
    </footer>
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
