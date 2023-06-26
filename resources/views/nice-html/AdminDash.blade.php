<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Nice Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>{{ config('config.title') }}</title>
    
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="css/chartist.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootnavbar.css') }}" rel="stylesheet">
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}
    <link href="{{ asset('css/style.sel.css') }}" rel="stylesheet" />
    {{-- <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}

    <style>
        .dataTables_filter {
            margin-right: 30px;
        }

        #myTable_paginate {
            margin-right: 30px;
            margin-bottom: 5px;
        }

        .parent {
            display: block;
            position: relative;
            float: left;
            line-height: 30px;

        }

        .parent a {
            margin: 26px;
            color: black;
            text-decoration: none;
        }

        .parent:hover>ul {
            display: block;
            position: absolute;
        }

        .child {
            display: none;
        }

        .child li {
            background-color: #E4EFF7;
            line-height: 30px;
            border-bottom: #CCC 1px solid;
            border-right: #CCC 1px solid;
            width: 100%;
        }

        .child li a {
            color: #000000;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0px;
            min-width: 10em;
        }

        ul ul ul {
            left: 100%;
            top: 0;
            margin-left: 1px;
        }

        .parent li:hover {
            background-color: #F0F0F0;
        }

        .expand {
            font-size: 12px;
            float: right;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            @csrf
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand">
                        <a href="index.html" class="logo">
                            <b class="logo-icon">
                                <img src="" alt="" class="dark-logo" />
                                <img src="" alt="" class="light-logo" />
                            </b>
                            <span class="logo-text">
                                <img src="" alt="" class="dark-logo" />
                                <img src="" class="" alt="" />
                            </span>
                        </a>
                    </div>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" style="margin-left: 30px;">Admin</a>
                            <form class="d-flex" role="search">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                        href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="images/userAvatar.png" alt="user" class="rounded-circle"
                                            width="31">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                        aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/logout"><i class="ti-wallet me-1 ms-1"></i>
                                            Logout</a>
                                    </ul>
                                </li>
                            </form>
                        </div>
                    </nav>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/AdminDash') }}" aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Home</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/department') }}" aria-expanded="false">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu">Department/Scheme</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/downloads') }}" aria-expanded="false">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu">Downloads</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/Info') }}"
                                aria-expanded="false">
                                <i class="mdi mdi-arrange-bring-forward"></i>
                                <span class="hide-menu">Information</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/contact') }}"
                                aria-expanded="false">
                                <i class="mdi mdi-file"></i>
                                <span class="hide-menu">Contact Us</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/feedback') }}"
                                aria-expanded="false">
                                <i class="mdi mdi-alert-outline"></i>
                                <span class="hide-menu">Feedback</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title" style="margin-left: 18px;">Admin Panel</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row" style="justify-content: space-evenly;">
                    <div class="col-lg-3">
                        <div class="card">
                            <button type="button" class="btn btn-light btn-lg" data-toggle="modal"
                                data-target="#exampleModal"
                                style="padding: 35px;background-color: #efefef;box-shadow: 0px 15px 20px rgb(0 0 0 / 10%);">
                                Departments <br> Total Department: 4
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <button type="button" class="btn btn-light btn-lg" data-toggle="modal"
                                data-target="#exampleModal"
                                style="padding: 35px;background-color: #efefef;box-shadow: 0px 15px 20px rgb(0 0 0 / 10%);">
                                Schemes <br> Total Schemes: 0
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <button type="button" class="btn btn-light btn-lg" data-toggle="modal"
                                data-target="#exampleModal"
                                style="padding: 35px;background-color: #efefef;box-shadow: 0px 15px 20px rgb(0 0 0 / 10%);">
                                Newly Added <br> Newly Added: 0
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="white-space: nowrap;">
                            <button type="button" class="btn btn-light btn-lg" data-toggle="modal"
                                data-target="#exampleModal"
                                style="padding: 35px;background-color: #efefef;box-shadow: 0px 15px 20px rgb(0 0 0 / 10%);">
                                Total Donation <br> Total Donation: Rs {{ $balance }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <!-- column -->
                <div class="col-12">
                    <div class="card">
                        <div class="heading" style="display: flex;">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;font-weight: 500;">Donation this
                                    Month
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="margin-left: 20px;">
                    <div id="head2">
                        <div class="col-md-4" style="width: 50%;margin: 0px auto;">
                            <div class="form-group">
                                <select name="filter_month" id="filter_month" class="form-control" required
                                    style="border: 1px solid #aaa;">
                                    <option selected value="">--Select Month--</option>

                                    <option value="Janaury">Janaury</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="filter_department" id="filter_department" class="form-control" required
                                    style="border: 1px solid #aaa;">
                                    <option selected value="">--Select Department--</option>

                                    <option value='1'>1.CMRF</option>
                                    <option value='2'>2.GMRF</option>
                                    <option value='3'>3.Lampi</option>
                                    <option value='4'>4.Gaushala</option>
                                </select>
                            </div>
                            <div class="form-group" align="center">
                                <button type="button" name="filter" id="filter" class="btn btn-info"
                                    style="
                                    color: #000;
                                    background-color: lightgray;
                                    border-color: LIGHTGRAY;
                                ">Filter</button>

                                <button type="button" name="reset" id="reset" class="btn btn-info"
                                    style="
                                    color: #000;
                                    background-color: lightgray;
                                    border-color: LIGHTGRAY;
                                ">Reset</button>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Id</th>
                                    <th class="border-top-0">Prn</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Month</th>
                                    <th class="border-top-0">Department</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">Donation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    <tr>
                                        <td class="txt-oflo">{{ $users->PK_id }}</td>
                                        <td class="txt-oflo">{{ $users->PRN }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Name }}</td>
                                        <td class="txt-oflo">{{ $users->Month_Name }}</td>
                                        <td class="txt-oflo">{{ $users->department }}</td>
                                        <td class="txt-oflo"> {{ $users->created_at }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Amount }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($gmrf as $users)
                                    <tr>
                                        <td class="txt-oflo">{{ $users->PK_id }}</td>
                                        <td class="txt-oflo">{{ $users->PRN }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Name }}</td>
                                        <td class="txt-oflo">{{ $users->Month_Name }}</td>
                                        <td class="txt-oflo">{{ $users->department }}</td>
                                        <td class="txt-oflo"> {{ $users->created_at }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Amount }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($lampi as $users)
                                    <tr>
                                        <td class="txt-oflo">{{ $users->PK_id }}</td>
                                        <td class="txt-oflo">{{ $users->PRN }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Name }}</td>
                                        <td class="txt-oflo">{{ $users->Month_Name }}</td>
                                        <td class="txt-oflo">{{ $users->department }}</td>
                                        <td class="txt-oflo"> {{ $users->created_at }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Amount }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($gaushala as $users)
                                    <tr>
                                        <td class="txt-oflo">{{ $users->PK_id }}</td>
                                        <td class="txt-oflo">{{ $users->PRN }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Name }}</td>
                                        <td class="txt-oflo">{{ $users->Month_Name }}</td>
                                        <td class="txt-oflo">{{ $users->department }}</td>
                                        <td class="txt-oflo"> {{ $users->created_at }}</td>
                                        <td class="txt-oflo">{{ $users->Donnar_Amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center">
        Copyrights © Dept of IT&C, Govt of Rajasthan. All Rights Reserved.. Designed and Maintained by RISL
        <a href="https://rajasthan.gov.in/">rajasthan.gov.in</a>.
    </footer>

    </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="js/chartist.min.js"></script>
    <script src="js/chartist-plugin-tooltip.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="js/checkbox.js"></script>

    <!--data table-->
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
   <script type="text/javascript">
    $(function () {
        
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('AdminDash') }}",
            data: function (d) {
                  d.approved = $('#approved').val(),
                  d.search = $('input[type="search"]').val()
              }
          },
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'approved', name: 'approved'},
          ]
      });
    
      $('#approved').change(function(){
          table.draw();
      });
        
    });
  </script>

</body>

</html>
