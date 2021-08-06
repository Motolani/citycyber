<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | CityCyber - Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="CityCyber" name="CityCyber" />
        <meta content="CityCyber" name="CityCyber" />
	    <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- App css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{asset('assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                   <span><h2 style = "color:white">CityCyber</h1></span>  
				                    {{--<span><img src="{{asset('assets/images/logo.png')}}" alt="" height="18"></span>--}}
                                </a>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                             @if (\Session::has('message'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('message') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                            <li>{{Session::get('error')}}</li>
                                        
                                    </ul>
                                </div>
                            @endif

                            <!-- handdle session Messages start -->
                                @if(session()->has('status'))
                                    <div class="alert alert-danger text-center" role="alert">
                                    <p><i class="fa fa-warning"></i> {{session('status')}}</p>
                                    </div>
                                @endif
                            <!-- handdle session Messages Start-->


                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h3 class="text-dark-50 text-center pb-0 fw-bold">ATTENDANCE</h3>
                                   <P class="text-muted mb-4">STAFF FINGERPRINT ATTENDANCE CAPTURE.</P>
                                </div>

                                <form method="POST" action="{{url('attendance')}}"> 
					            @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Staff Id</label>
                                        <input class="form-control" name = "staff_number" type="text" id="staff_number" required="" placeholder="Enter your Id">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Action Type</label>
                                        <select id="offe" class="form-control" name="actionType" data-toggle="select" required>

                                            <option value="clockIn">Clock In</option>
                                            <option value="clockOut">Clock Out</option>

                                        </select>
                                    </div>


                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Clock In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                            

                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Click <a href="/" class="text-muted ms-1"><b>Here</b></a> To Login</p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2018 - 2021 © City - citycyber.com
        </footer>

        <!-- bundle -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        
    </body>
</html>


