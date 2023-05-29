<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link href="{{ asset('css3/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css3/owl.carousel.min.css') }}" rel="stylesheet">
    {{-- <link href="css3/bootstrap.min.css" rel="stylesheet">
    <link href="css3/bootstrap-icons.css" rel="stylesheet">
    <link href="css3/styles.css" rel="stylesheet" />
    <link href="css3/datatables.min.css" rel="stylesheet" />
    <link href="css3/owl.carousel.min.css" rel="stylesheet" /> --}}
    <style>
        .btn-primary {
            color: #fff;
            background-color: #2f2f74;
            border-color: #2f2f74;
            width: 8%;
        }

        .card-header h3.card-title {
            margin: 0px;
            font-size: 20px;
            color: #2f2f74;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <header>
        <div class="top_header">
            <div class="container">
                <div class="custom_row">
                    <div class="logo"><img src="{{ asset('images/rajgov_logo.png') }}"></div>
                    <div class="menu">
                        <ul>
                            <li><a href="#" class="user"><span class="menu_icon avtar"><i
                                            class="bi bi-person"></i></span><span
                                        class="right_part"><strong>Welcome</strong><span id="user_id"
                                            class="userid">rrfpp.gov.in</span></span></a></li>
                            <li><a href="#" class="mobile"><span class="menu_icon logout"><i
                                            class="bi bi-power"></i></span>Logout</a></li>
                            <li><a href="{{ url('website#help') }}" class="download"><span class="menu_icon"><i
                                            class="bi bi-globe2"></i></span>Donation Portal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_header">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            @include('nice-html.navbar')
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="main_section new_shema">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->Heading }}</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    <form id="new_shema" method="post" action="{{ url('update-department/' . $user->DepartmentId) }}" enctype="multipart/form-data">
                        {{-- @csrf
                        @method('PUT') --}}
                        @csrf
                        @method('POST')
                        {{-- @if ($user->DepartmentId)
                        @method('PUT')
                    @endif --}}
                        <input type="hidden" name="DepartmentId" value="{{ $user->DepartmentId }}">
                        <div class="form_row">
                            <div class="form_item">
                                <label>Heading</label>
                                <input type="text" id="Heading" name="Heading" placeholder="Enter heading"
                                    class="form-control" required value="{{ $user->Heading }}">
                                {{-- <textarea class="form-control" name="heading" id="exampleFormControlTextarea1" rows="3">{{ $user->Heading }}</textarea> --}}
                            </div>
                            <div class="form_item">
                                <label>Slug</label>
                                <input type="text" id="Slug" name="Slug" placeholder="Enter slug"
                                    class="form-control" required value="{{ $user->Slug }}">
                                {{-- <textarea class="form-control" name="slug" id="exampleFormControlTextarea1" rows="3">{{ $user->Slug }}</textarea> --}}
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_item">
                                <label>Short Description</label>
                                <textarea class="form-control" name="ShortDescription" id="exampleFormControlTextarea1" rows="3">{{ $user->ShortDescription }}</textarea>
                            </div>
                            <div class="form_item">
                                <label>Long Description</label>
                                <textarea class="form-control" name="LongDescription" id="exampleFormControlTextarea1" rows="3">{{ $user->LongDescription }}</textarea>
                            </div>
                        </div>
                        <div class="form_row">
                            <div class="form_item full">
                                <label>Image</label>
                                <input type="file" name="Images" id="" class="form-control">
                                <img src="{{ asset('uploads/department/' . $user->Images) }}" width="110px"
                                    height="70px" alt="Img">
                            </div>
                        </div>
                        <div class="btn_row">
                            {{-- @if (session('role') == '1')                            
                            <input type="submit" value="Submit" class="primary_btn">
                        @elseif (session('role') == '2')
                        <input type="submit" value="Submit" class="primary_btn" onclick="alert('This button is disabled')" disabled>

                        @elseif (session('role') == '3')
                            <!-- Button for condition 3 -->
                            <input type="submit" value="Submit" class="primary_btn">
                                
                        @elseif (session('role') == '4')
                            <!-- Button for condition 4 -->
                            <input type="submit" value="Submit" class="primary_btn">
                        @endif    --}}
                            <input type="submit" value="Submit" class="primary_btn">
                            <a class="btn btn-primary" href="javascript:history.back()" role="button">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer_top">
            <div class="container">
                <ul class="footer_menu">
                    <li><a href="#">Refund Policy</a></li>
                    <li><a href="#">Term & Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cancellation Policy</a></li>
                    <li><a href="#">Chargeback Guidelines</a></li>
                </ul>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container">
                <p>Copyright © 2022 - All rights reserved dept of IT&C, Govt of rajasthan </p>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="{{ URL::asset('js3/jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js3/datatables.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> --}}

    <script>
        < script >
            $(document).ready(function() {
                $('#monthly_report').dataTable({
                    searching: true,
                    paging: true,
                    dom: 'lBfrtip', //* l = length, B = button, f = fillter, r = processing, t = table, i = information, p = pagination
                    info: true,
                    buttons: [
                        //'copy',
                        'excel',
                        'csv',
                        'pdf',
                        //'print'
                    ]
                });
            });
    </script>

</body>

</html>
