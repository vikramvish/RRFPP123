@if(request()->url() !== 'http://172.22.36.133:8000/contactus')
<section class="partners_section">
    <div class="container">
        <h3 class="sub_title center">Partners</h3>
        <h2 class="main_title center">Our Partners</h2>
        <div class="partners_slider">
            <div class="owl-carousel owl-theme partnersSlider">
                <div class="item">
                    <div class="partners_box">
                        <div class="partners_img">
                            <img src="{{ asset('images/rcmrf_logo.png') }}">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="partners_box">
                        <div class="partners_img">
                            <img src="{{ asset('images/gmrf_logo.png') }}">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="partners_box">
                        <div class="partners_img">
                            <img src="{{ asset('images/devsthan_logo.png') }}">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="partners_box">
                        <div class="partners_img">
                            <img src="{{ asset('images/patner_rajgov_logo.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
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
                                <p>{{ config('config.node_officer') }}
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="footer_item">
                                <div class="ci_header"><span class="ci_icon"><i
                                            class="bi bi-building"></i></span>
                                    <h3>Address</h3>
                                </div>
                                <p>{{ config('config.address') }}</p>
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