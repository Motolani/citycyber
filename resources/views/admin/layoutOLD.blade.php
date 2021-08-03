<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
    <title> @yield('title') </title>

</head>


<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
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
        <script src="{{('assets/js/vendor.min.js')}}"></script>
        <script src="{{('assets/js/app.min.js')}}"></script>

        <!-- third party:js -->
        {{--<script src="{{('assets/js/vendor/apexcharts.min.js')}}"></script>--}}
        <!-- third party end -->

        <!-- Chat js -->
        <script src="{{('assets/js/ui/component.chat.js')}}"></script>

        <!-- Todo js -->
        <script src="{{('assets/js/ui/component.todo.js')}}"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	 <!-- demo app -->
        <script src="{{('assets/js/pages/demo.form-wizard.js')}}"></script>
        <!-- end demo js-->

	<script>
	$(document).ready(() => {
	
	});
	</script>
        <!-- demo:js -->
        {{--<script src="{{('assets/js/pages/demo.widgets.js')}}"></script>--}}
        <!-- demo end -->
	 @yield('script')
</body>

</html>
