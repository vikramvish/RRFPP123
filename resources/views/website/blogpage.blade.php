<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="{{ URL::asset('css1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/styles1.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/owl.carousel.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js1/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/owl.carousel.min.js') }}"></script>
    <style>
        img {
            width: -webkit-fill-available;
        }
    </style>
</head>

<body class="blog_single">
    <header>
        <div class="container">
            @include('website.header')
        </div>
    </header>
    <div class="main_section">
        <section class="inner-banner">
            <img src="{{ URL::asset('/images/banner.jpg') }}" alt="banner" class="banner_img">
            <div class="bannercontent">
                <div class="container">
                    <div class="banner_content">
                        <h2>
                            {{ $users->Heading }}
                        </h2>
                        <div class="breadcrum">
                            <ul>
                                <li><a
                                        href="{{ url('/website') }}"style="color: #312f72;text-decoration: none;">Home</a>
                                </li>
                                <li> {{ $users->Heading }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="blog_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="blogSingle_box">
                            <div class="blog_img">
                                <img src="{{ asset('uploads/department/' . $users->Images) }}"alt="BlogImages">
                            </div>
                            <div class="blog_content">
                                <p>{{ $users->LongDescription }}</p>
                                <a href="{{ url('paymentpage/' . $slug) }}" class="donate_btn"><span class="donate_icon"><i
                                            class="bi bi-heart-fill"></i></span> Donate Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sidebar">
                            <div class="sidebar_box">
                                <ul>
                                    <li class="sidebar_item">
                                        <div class="item">
                                            <div class="blog_box">
                                                <div class="blog_img">
                                                    <img src="{{ URL::asset('/images/cmrf.png') }}" alt="humanity">
                                                </div>
                                                <div class="blog_discription">
                                                    <h2>Help For CMRF</h2>
                                                    <p>Rajasthan Chief Minister's Assistance Fund is operated under
                                                        Rajasthan Chief Minister's Office, Government Secretariat,
                                                        Jaipur. In this, cash, check,dd and also online payment to help
                                                        chief minister refief
                                                        fund. </p>
                                                    <a href="http://172.22.36.133:8000/blogpage/CMRF" class="read_more">Read
                                                        more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="item">
                                            <div class="blog_box">
                                                <div class="blog_img">
                                                    <img src="{{ URL::asset('/images/animal.jpg') }}" alt="animal">
                                                </div>
                                                <div class="blog_discription">
                                                    <h2>Help For Guashala</h2>
                                                    <p>To contribute to the economy of the state of Rajasthan through
                                                        cow and its offspring and to provide biodiversity in relation to
                                                        reproduction, breed reforms, conservation of native cow breeds
                                                        and the value addition of cow </p>
                                                    <a href="http://172.22.36.133:8000/blogpage/Guashala"
                                                        class="read_more">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="item">
                                            <div class="blog_box">
                                                <div class="blog_img">
                                                    <img src="{{ URL::asset('/images/devsthan.png') }}"
                                                        alt="temple">
                                                </div>
                                                <div class="blog_discription">
                                                    <h2>Help For Devsthan</h2>
                                                    <p>The Department of Devasthan is a department of conservation and
                                                        promotion of temple culture.Devasthan is a department of
                                                        conservation and promotion of temple culture.is a department of
                                                        conservation</p>
                                                    <a href="http://172.22.36.133:8000/blogpage/Devsthan"
                                                        class="read_more">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="item">
                                            <div class="blog_box">
                                                <div class="blog_img">
                                                    <img src="{{ URL::asset('/images/1074082-lumpy-skin-disease_1_d7j4vr_1660152179.jpg') }}"
                                                        alt="humanity">
                                                </div>
                                                <div class="blog_discription">
                                                    <h2>Help For Lampi</h2>
                                                    <p>The virus remains a period of cows in Rajasthan, just know about
                                                        it. The virus that is caused by the lampy skin disease is called
                                                        Capripoxvirus. This disease occurs in cows and buffaloes. The
                                                        virus is of Gotpox and Shippox Family.</p>
                                                    <a href="http://172.22.36.133:8000/blogpage/Lampi"
                                                        class="read_more">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar_box">
                                <h3>Recent Causes</h3>
                                <ul>
                                    <li class="sidebar_item">
                                        <div class="causes-item">
                                            <div class="causes-img"><img src="{{ URL::asset('/images/cmrf.png') }}">
                                            </div>
                                            <div class="causes-content">
                                                <h3>Help For CMRF</h3>
                                                <p>Rajasthan Chief Minister's Assistance Fund is operated under
                                                    Rajasthan Chief Minister's Office, Government Secretariat, Jaipur.
                                                    In this, cash, check,dd and also online payment to help chief
                                                    minister refief
                                                    fund.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="causes-item">
                                            <div class="causes-img"><img src="{{ URL::asset('/images/gmrf.png') }}">
                                            </div>
                                            <div class="causes-content">
                                                <h3>Help For GMRF</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="causes-item">
                                            <div class="causes-img"><img
                                                    src="{{ URL::asset('/images/gosala.png') }}"></div>
                                            <div class="causes-content">
                                                <h3>Help For Gaushala</h3>
                                                <p>To contribute to the economy of the state of Rajasthan through cow
                                                    and its offspring and to provide biodiversity in relation to
                                                    reproduction, breed reforms, conservation of native cow breeds and
                                                    the value addition of cow
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="causes-item">
                                            <div class="causes-img"><img src="{{ URL::asset('/images/lempi.png') }}">
                                            </div>
                                            <div class="causes-content">
                                                <h3>Help For Lampi</h3>
                                                <p>The virus remains a period of cows in Rajasthan, just know about it.
                                                    The virus that is caused by the lampy skin disease is called
                                                    Capripoxvirus. This disease occurs in cows and buffaloes. The virus
                                                    is of Gotpox and Shippox Family.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="sidebar_item">
                                        <div class="causes-item">
                                            <div class="causes-img"><img
                                                    src="{{ URL::asset('/images/devsthan.png') }}"></div>
                                            <div class="causes-content">
                                                <h3>Help For Devasthan</h3>
                                                <p>The Department of Devasthan is a department of conservation and
                                                    promotion of temple culture.Devasthan is a department of
                                                    conservation and promotion of temple culture.is a department of
                                                    conservation
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <footer>
        @include('website.footer')
    </footer>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>
