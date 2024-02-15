<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>
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

        .ul-container {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            /* Ensure equal height */
        }

        .ul-container .causes-item {
            flex: 1;
        }

        .blog_slider {
            display: flex;
        }

        .blog_slider .item {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog_slider .item .blog_box {
            flex-grow: 1;
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
                            {{-- <h2 class="main_title">Small Actions Lead<br>
                                To Big Changes</h2> --}}
                            <h2 class="main_title">{!! config('config.WELCOME') !!}</h2>
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
                                        <img src="uploads/department/{!! $user->Images !!}" alt="education" />
                                    </div>
                                    <div class="blog_discription">
                                        <h2>{!! $user->Heading !!}</h2>
                                        <p>{!! $user->ShortDescription !!}
                                        </p>
                                        <a onclick="location.href='{{ url('blog/' . $user->Slug) }}'"
                                            class="read_more">Read more</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="aboutus">
                        <div class="about_message">
                            <p>{{ config('config.HOME_CONTENT') }}</p>
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
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search Here For Causes ........">
                    </form>
                    @csrf
                    <div class="causes-grid" id="search-results">
                        <ul id="show" class="ul-container">
                            @foreach ($users as $user)
                            <li class="searchable">
                                <div class="causes-item">
                                    <div class="causes-img"><img src="uploads/department/{!! $user->Images !!}"></div>
                                    <div class="causes-content">
                                        <h3>{!! $user->Heading !!}</h3>
                                        <p>{!! strip_tags($user->ShortDescription) !!}</p>
                                        <button onclick="location.href='{{ url('paymentpage', Str::slug($user->Slug)) }}'" id="donate">Donate Now</button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <footer>
        @include('website.footer')
    </footer>

    {{-- for live searching on input field --}}

    <script>
        var searchInput = document.getElementById('search');
    
        searchInput.addEventListener('keyup', function () {
            var searchValue = searchInput.value.toLowerCase();
            var items = document.getElementsByClassName('searchable');
    
            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                var heading = item.getElementsByTagName('h3')[0].innerText.toLowerCase();
                var description = item.getElementsByTagName('p')[0].innerText.toLowerCase();
    
                if (heading.includes(searchValue) || description.includes(searchValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
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
                    items: 3
                }
            }
        })
    </script>

</body>

</html>