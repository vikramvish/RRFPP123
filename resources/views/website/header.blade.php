<div class="custom_row">
    <div class="logo"><img src="{{ asset('images/rajgov_logo.png') }}"></div>
    <div class="menu">
        <ul>
            <li><a href="{{ url('website') }}" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Home"><i class="bi bi-house-heart"></i></i></span>Home</a>
            </li>
            <li><a href="{{ url('contactus') }}" class="mobile"><span class="menu_icon" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Contact-Us"><i class="bi bi-phone"></i></span>Contact-Us</a>
            </li>
            <li><a href="" class="email"><span class="menu_icon" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="support.donation@rajasthan.gov.in"><i
                            class="bi bi-envelope"></i></span>rajasthan.gov.in</a></li>
            <li><a href="{{ url('/Receiptt') }}" class="download"><span class="menu_icon" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Download Receipt"><i
                            class="bi bi-download"></i></span>Download Receipt</a></li>
            {{-- <li><a href="#help" class="donate"><span class="menu_icon"><i
                            class="bi bi-heart-fill"></i></span>Donate Now</a></li> --}}
            @if (request()->is('website'))
                <li><a href="#help" class="donate"><span class="menu_icon"><i
                                class="bi bi-heart-fill"></i></span>Donate Now</a></li>
            @elseif (request()->is('paymentpage/*'))
                <li><a href="{{ url('#') }}" class="donate"><span class="menu_icon"><i
                                class="bi bi-heart-fill"></i></span>Donate Now</a></li>
            @elseif (request()->is('blog/*'))
                <li><a href="{{ url('paymentpage/' . $slug) }}" class="donate"><span class="menu_icon"><i
                                class="bi bi-heart-fill"></i></span>Donate Now</a></li>
            @else
                <li><a href="{{ url('website#help') }}" class="donate"><span class="menu_icon"><i
                                class="bi bi-heart-fill"></i></span>Donate Now</a></li>
            @endif
        </ul>
    </div>
</div>
