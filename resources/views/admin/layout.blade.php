<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
    <title> @yield('title') </title>

</head>


<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
@include('sweet::alert')
<!-- Begin page -->
<div class="">
{{-- <div class="wrapper"> --}}
    <!-- left Sidebar -->
@include('admin.includes.leftsidebar')
<!-- left sidebar ends -->
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Starts-->
        @include('admin.includes.topbar')
        <!-- end Topbar -->

        <!-- Start Content-->
            <div class="container-fluid">
                @if(Session::has('error'))
                    <div class="alert alert-danger mt-3">
                        {{Session::get('error')}}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    </div>
                @endif
                @yield('content')
            </div>
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script> © CityCyber - citycyber.com
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>

<div class="rightbar-overlay"></div>
<!-- /End-bar -->


<!-- bundle -->
<script src="{{asset('/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('/assets/js/app.min.js')}}"></script>

<!-- third party:js -->
{{--<script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>--}}
<!-- third party end -->

<!-- Chat js -->
<script src="{{asset('/assets/js/ui/component.chat.js')}}"></script>

<!-- Todo js -->
<script src="{{asset('/assets/js/ui/component.todo.js')}}"></script>

<!-- Timepicker -->
<script src="{{asset('/assets/js/pages/demo.timepicker.js')}}"></script>

<!-- Typehead -->
<script src="{{asset('/assets/js/vendor/handlebars.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/typeahead.bundle.min.js')}}"></script>

<!-- third party js -->
<script src="{{asset('/assets/js/vendor/Chart.bundle.min.js')}}"></script>
<!-- third party js ends -->


<!-- demo app -->
<script src="{{asset('/assets/js/pages/demo.dashboard-projects.js')}}"></script>
<!-- end demo js-->

<!-- Demo -->
<script src="{{asset('/assets/js/pages/demo.typehead.js')}}"></script>

<!-- demo app -->
<script src="{{asset('/assets/js/pages/demo.form-wizard.js')}}"></script>
<!-- end demo js-->

{{--Jquery Validator--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<!-- third party js -->
<script src="{{asset('/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/buttons.flash.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor/dataTables.select.min.js')}}"></script>
<!-- third party js ends -->

{{--<script src="{{('/assets/js/pages/demo.datatable-init.js')}}"></script>--}}






@yield('script')

</body>

</html>

