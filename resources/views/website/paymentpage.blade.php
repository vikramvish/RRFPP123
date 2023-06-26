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
    <script type="text/javascript" src="{{ URL::asset('js1/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/owl.carousel.min.js') }}"></script>

    <style>
        a:hover {
            color: #312f72;
            text-decoration: none;
        }

        a {
            color: #312f72;
            text-decoration: none;
        }

        select.form-control {
            -webkit-appearance: searchfield !important;
        }
    </style>
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

<body class="blog_single">
    <header>
        <div class="container">
            @include('website.header')
        </div>
    </header>
    <div id="preloader">
        <div id="loader"></div>
    </div>
    <div class="main_section">
        <section class="inner-banner">
            <img src="{{ URL::asset('/images/banner.jpg') }}" alt="banner" class="banner_img">
            <div class="bannercontent">
                <div class="container">
                    <div class="banner_content">

                        {{-- @foreach ($collections as $collection) --}}
                        <h2>
                            {{ $collections->Heading }}
                        </h2>
                        {{-- @endforeach --}}

                        <div class="breadcrum">
                            <ul>
                                <li><a href="{{ url('/website') }}">Home</a></li>
                                <li>{{ $collections->Heading }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="payment_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="payment_single">
                            <div class="payment_single_img">
                                {{-- @foreach ($collections as $collection) --}}
                                <img src="{{ asset('uploads/department/' . $collections->Images) }}">
                                {{-- @endforeach --}}
                            </div>
                            <div class="payment_content">
                                <p>{!! $collections->LongDescription !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="payment_section">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#with_info"><strong>Donate
                                            Now</strong>With Personal Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#without_info"><strong>Donate
                                            Now</strong>Without Personal Info</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="with_info" class="tab-pane active"><br>
                                    <form action="{{ url('website-form') }}" method="post">
                                        @csrf
                                        <div class="form_box">
                                            <h3><span>Personal Information</span></h3>
                                            <div class="md-3">
                                                {{-- <label class="form-lebel">Select Department</label> --}}
                                                {{-- <div class="col-auto">
                                                    <select class="form-control" id="departmentDropdown" name="department"
                                                        placeholder="Select Scheme">
                                                        <option value="">Select department</option>
                                                        @foreach($dept as $department)
                                                            <option value="{{ $department->DepartmentId }}">{{ $department->DepartmentName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <label class="form-lebel">Select Scheme</label>
                                                <div class="col-auto">
                                                    <select class="form-control" id="schemeDropdown" name="scheme"
                                                        placeholder="Select Scheme" required>
                                                        <option value="">Select Scheme</option>
                                                        @foreach ($scheme as $schemes)
                                                            <option value="{{ $schemes->SchemeId }}">
                                                                {{ $schemes->SchemeName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" required="required"
                                                    id="full_name" placeholder="Enter Full Name" name="RemitterName" oninput="capitalizeFirstLetter(this)">
                                                {!! $errors->first('RemitterName', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" pattern="^\w+([\.-]?\w+)@\w+([\.-]?\w+)*(\.\w{2,3})+$" class="form-control" required="required"
                                                    id="email" placeholder="Enter Email Address"
                                                    name="RemitterEmailId">
                                                {!! $errors->first('RemitterEmailId', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control" required="required"
                                                    maxlength="11" minlength="10" id="Mobile_No" placeholder="Enter Mobile Number"
                                                    name="RemitterMobile">
                                                {!! $errors->first('RemitterMobile', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" id="address" placeholder="Enter Address"
                                                    name="RemitterAddress"></textarea>
                                                {!! $errors->first('RemitterAddress', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>

                                        <div class="form_box">
                                            <h3><span>Payment Information</span></h3>
                                            <div class="form-item">
                                                <label class="form-label">PAN/TAN Number</label>
                                                <input type="text" class="form-control"
                                                    maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" minlength="10" id="pan_number" placeholder="Enter Pan Number"
                                                    name="RemitterPAN">
                                                {!! $errors->first('RemitterPAN', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            {{-- <span><b style="color: #312f72;">NOTE: PAN is Mandatory for Tax Benefits</b></span> --}}

                                            <div class="form-item">
                                                <label class="form-label">Amount</label>
                                                <input type="text" class="form-control" required="required"
                                                    id="amount" placeholder="Enter Amount"
                                                    name="TransactionAmount" value="1000">
                                                {!! $errors->first('TransactionAmount', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Select Quick Amount</label>
                                                <span class="qa" value="500"> 500 </span>
                                                <span class="qa" value="1000"> 1000 </span>
                                                <span class="qa" value="2000"> 2000 </span>
                                                <span class="qa" value="3000"> 3000 </span>
                                                <span class="qa" value="5000"> 5000 </span>
                                            </div>
                                        </div>
                                        {{-- <a href="{{SchemeId}}"> --}}
                                        <button type="submit" class="donate_btn">Donate</button>
                                        {{-- </a> --}}
                                    </form>
                                </div>
                                <div id="without_info" class="tab-pane fade"><br>
                                    <form action="{{ url('/website-Annonmous') }}" method="post">
                                        @csrf
                                        <div class="form_box">
                                            <h3><span>Payment Information</span></h3>
                                            <div class="md-3">
                                                <label class="form-lebel">Select Department</label>
                                                {{-- <div class="col-auto">
                                                    <select class="form-control" id="departmentDropdown" name="department"
                                                        placeholder="Select Scheme">
                                                        <option value="">Select department</option>
                                                        @foreach($dept as $department)
                                                            <option value="{{ $department->DepartmentId }}">{{ $department->DepartmentName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                <label class="form-lebel">Select Scheme</label>
                                                <div class="col-auto">
                                                    <select class="form-control" id="schemeDropdown" name="scheme"
                                                        placeholder="Select Scheme" required>
                                                        <option value="">Select Scheme</option>
                                                        @foreach ($scheme as $schemes)
                                                            <option value="{{ $schemes->SchemeId }}">
                                                                {{ $schemes->SchemeName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Amount</label>
                                                <input type="text" class="form-control" required="required"
                                                    id="amount1" placeholder="Enter Amount"
                                                    name="TransactionAmount" value="1000">
                                                {!! $errors->first('TransactionAmount', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-item">
                                                <label class="form-label">Select Quick Amount</label>
                                                <span class="qa1" value="500"> 500 </span>
                                                <span class="qa1" value="1000"> 1000 </span>
                                                <span class="qa1" value="2000"> 2000 </span>
                                                <span class="qa1" value="3000"> 3000 </span>
                                                <span class="qa1" value="5000"> 5000 </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="donate_btn">Donate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="recent_causes">
            <div class="container">
                <div class="rc_slider">
                    <h2 class="main_title center">Recent Causes</h2>
                    <div class="owl-carousel owl-theme recentcausesSlider">
                        <div class="item">
                            <div class="causes-item">
                                <div class="causes-img">
                                    <img src="{{ URL::asset('/images/cmrf.png') }}" alt="profile Pic">
                                </div>
                                <div class="causes-content">
                                    <h3>Help For CMRF</h3>
                                    <p>Rajasthan Chief Minister's Assistance Fund is operated under Rajasthan Chief
                                        Minister's Office, Government Secretariat, Jaipur. In this, online can deposite
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="causes-item">
                                <div class="causes-img">
                                    <img src="{{ URL::asset('/images/gmrf.png') }}" alt="profile Pic">
                                </div>
                                <div class="causes-content">
                                    <h3>Help For GMRF</h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem
                                        Ipsum has been the industry's standard dummy text standard dummy text</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="causes-item">
                                <div class="causes-img">
                                    <img src="{{ URL::asset('/images/gosala.png') }}" alt="profile Pic">
                                </div>
                                <div class="causes-content">
                                    <h3>Help For Gaushala</h3>
                                    <p>To contribute to the economy of the state of Rajasthan through cow and its
                                        offspring and to provide biodiversity in relation with the gaushala.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="causes-item">
                                <div class="causes-img">
                                    <img src="{{ URL::asset('/images/lempi.png') }}" alt="profile Pic">
                                </div>
                                <div class="causes-content">
                                    <h3>Help For Lampi</h3>
                                    <p>The virus remains a period of cows in Rajasthan, just know about it.This disease
                                        occurs in cows and buffaloes.the virus is of Gotpox Family.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="causes-item">
                                <div class="causes-img">
                                    <img src="{{ URL::asset('/images/devsthan.png') }}" alt="profile Pic">
                                </div>
                                <div class="causes-content">
                                    <h3>Help For Devasthan</h3>
                                    <p>The Department of Devasthan is a department of conservation and promotion of
                                        temple culture.Devasthan is a department of conservation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </div>
    </div>
    <footer>
        @include('website.footer')
    </footer>
    {{-- <script src="jquery.js" type="text/javascript"></script> --}}
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <script>
        function capitalizeFirstLetter(input) {
            const words = input.value.split(' ');
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }
            input.value = words.join(' ');
        }
    </script>
    {{-- <script>
       $(document).ready(function() {
    $('#departmentDropdown').on('change', function() {
        var departmentId = $(this).val();
        if(departmentId) {
            $.ajax({
                url: '/paymentpage/getSchemes/'+departmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#schemeDropdown').empty();
                    $('#schemeDropdown').append('<option value="">Select Scheme</option>');
                    $.each(data, function(key, value) {
                        $('#schemeDropdown').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        } else {
            $('#schemeDropdown').empty();
            $('#schemeDropdown').append('<option value="">Select Scheme</option>');
        }
    });
});
    </script> --}}
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
