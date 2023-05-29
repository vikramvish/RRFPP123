<div class="container">
    <div class="custom_row">
        <div class="logo"><img src="images/rajgov_logo.png"></div>
        <div class="menu">
            <ul>
                <li><a href="#" class="user"><span class="menu_icon avtar"><i
                                class="bi bi-person"></i></span><span
                            class="right_part"><strong>Welcome</strong><span id="user_id"
                                class="userid">{{ Session('name') }}</span></span></a></li>
                <li><a href="{{ url('/logout') }}"
                        onclick="return confirm('Are you sure You Want to Logout?')" class="mobile"><span
                            class="menu_icon logout"><i class="bi bi-power"></i></span>Logout</a></li>
                <li><a href="{{ url('website') }}" target="_blank" class="download"><span class="menu_icon"><i
                                class="bi bi-globe2"></i></span>Donation Portal</a></li>
                        {{-- <li><a href="{{ url('website#help') }}"
                        onclick="return confirm('do you Want to switch to donation portal?')"
                        target="_blank" class="donate"><span class="menu_icon"><i
                                class="bi bi-heart-fill"></i></span>Donate
                        Now</a></li> --}}
            </ul>
        </div>
    </div>
</div>