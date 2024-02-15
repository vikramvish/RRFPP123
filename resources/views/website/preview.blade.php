<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('config.title') }}</title>
    <link href="{{ URL::asset('css1/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/styles1.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css1/owl.carousel.min.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ URL::asset('js1/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js1/owl.carousel.min.js') }}"></script>
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
            @include('website.header')
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
                            <h4 style="color: red;margin-left: 11rem;font-size: 1.1rem;"><b>Donate : Confirm before you
                                    proceed<br>
                            </h4>
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            <form action="{{ url('/confirm-info') }}" method="post">
                                @csrf
                                <div class="form_box">
                                    <h3><span>Personal Information</span></h3>

                                    <div class="form-item">
                                        <label class="form-label">Scheme</label>
                                        <input type="text" class="form-control"
                                            value="{{ $selectedScheme->SchemeName }}" id="PRN" name="scheme" readonly>
                                        <input type="hidden" name="scheme_id" value="{{ $selectedScheme->SchemeId }}">
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">PRN<b style="color: red;font-weight: 700;"> * Keep PRN
                                                for further
                                                Refrence</b></label>
                                        <input type="text" class="form-control" value="{{ $PRN }}" id="PRN" name="PRN"
                                            readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" value="{{ request()->RemitterName }}"
                                            id="full_name" name="RemitterName" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control"
                                            value="{{ request()->RemitterEmailId }}" id="email" name="RemitterEmailId"
                                            readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" value="{{ request()->RemitterMobile }}"
                                            id="phone_number" name="RemitterMobile" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" value="{{ request()->RemitterAddress }}"
                                            id="RemitterAddress" name="RemitterAddress" readonly>
                                    </div>
                                </div>
                                <div class="form_box">
                                    <h3><span>Payment Information</span></h3>
                                    <div class="form-item">
                                        <label class="form-label">Pan Number</label>
                                        <input type="text" class="form-control" value="{{ request()->RemitterPAN }}"
                                            id="pan_number" name="RemitterPAN" readonly>
                                    </div>
                                    <div class="form-item">
                                        <label class="form-label">Amount</label>
                                        <input type="number" maxlength="11" class="form-control"
                                            value="{{ request()->TransactionAmount }}" id="amount"
                                            name="TransactionAmount" readonly>
                                    </div>
                                </div>
                                <div class="btn">
                                    <button type="submit" class="donate_btn" onclick="return handleFormSubmission(event)">Proceed to payment</button>
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
        @include('website.footer')
    </footer>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
   <script>
    <script>
    function handleFormSubmission(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Submit the form via AJAX request
        fetch('{{ url('/confirm-info') }}', {
            method: 'POST',
            body: new FormData(event.target)
        })
        .then(response => {
            if (response.ok) {
                // Form submission was successful, proceed to payment
                window.location.href = 'https://uat.rpp.rajasthan.gov.in/payments/v1/init';
            } else {
                // Form submission encountered an error, display custom 404 error
                window.location.href = 'https://uat.rpp.rajasthan.gov.in/website.invalid_request';
            }
        })
        .catch(error => {
            // Handle any other errors that may occur during form submission
            console.error(error);
        });
    }
</script>
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