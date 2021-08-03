@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 


    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white">Office Name</h4>
                                        <p class="font-13 text-white-50"> ALPHA SHOP</p>

                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1">No 10, ikeja Lagos</h5>
                                                <p class="mb-0 font-13 text-white-50">Address</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">Head Quater</h5>
                                                <p class="mb-0 font-13 text-white-50">Office Type </p>
                                            </li>
                                        </ul>
                                    </div>

                                    
                                </div>


                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 mb-1 text-white">Michael Franklin</h4>
                                        <p class="font-13 text-white-50"> Authorised Brand Seller</p>

                                        <ul class="mb-0 list-inline text-light">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1">$ 25,184</h5>
                                                <p class="mb-0 font-13 text-white-50">Total Revenue</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">5482</h5>
                                                <p class="mb-0 font-13 text-white-50">Number of Orders</p>
                                            </li>
                                        </ul>
                                    </div>

                                    
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                <button type="button" class="btn btn-light">
                                    <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                </button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-xl-4">
            
            <!-- Toll free number box-->
            <div class="card text-white bg-info overflow-hidden">
                <div class="card-body">
                    <div class="toll-free-box text-center">
                        <h4> <i class="mdi mdi-deskphone"></i> Toll Free : 2347035666498</h4>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <!-- End Toll free number box-->

            <!-- Messages-->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Head Of Departments</h4>

                    <div class="inbox-widget">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Phisvibe Olalere</p>
                            <p class="inbox-item-text">Music Departments</p>
                            <p class="inbox-item-date">
                                <a href="#" class="btn btn-sm btn-link text-info font-13"> View </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Isaac Adejumobi</p>
                            <p class="inbox-item-text">C.T.O</p>
                            <p class="inbox-item-date">
                                <a href="#" class="btn btn-sm btn-link text-info font-13"> View </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Babafemi Aina</p>
                            <p class="inbox-item-text">Project Manager </p>
                            <p class="inbox-item-date">
                                <a href="#" class="btn btn-sm btn-link text-info font-13"> View </a>
                            </p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Faith Akindele</p>
                            <p class="inbox-item-text">Budjet Officer</p>
                            <p class="inbox-item-date">
                                <a href="#" class="btn btn-sm btn-link text-info font-13"> View </a>
                            </p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg" class="rounded-circle" alt=""></div>
                            <p class="inbox-item-author">Afolabi Omolola</p>
                            <p class="inbox-item-text">Hod ICT</p>
                            <p class="inbox-item-date">
                                <a href="#" class="btn btn-sm btn-link text-info font-13"> View </a>
                            </p>
                        </div>
                    </div> <!-- end inbox-widget -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div> <!-- end col-->

        <div class="col-xl-8">

            <!-- Chart-->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Orders & Revenue</h4>
                    <div dir="ltr">
                        <div style="height: 260px;" class="chartjs-chart">
                            <canvas id="high-performing-product"></canvas>
                        </div>
                    </div>        
                </div>
            </div>
            <!-- End Chart-->

            <div class="row">
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-basket float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Orders</h6>
                            <h2 class="m-b-20">1,587</h2>
                            <span class="badge bg-primary"> +11% </span> <span class="text-muted">From previous period</span>
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-box float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Revenue</h6>
                            <h2 class="m-b-20">$<span>46,782</span></h2>
                            <span class="badge bg-danger"> -29% </span> <span class="text-muted">From previous period</span>
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-jewel float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Product Sold</h6>
                            <h2 class="m-b-20">1,890</h2>
                            <span class="badge bg-primary"> +89% </span> <span class="text-muted">Last year</span>
                        </div> <!-- end card-body-->
                    </div> <!--end card-->
                </div><!-- end col -->

            </div>
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    @endsection


@section('script')
 <script>
    //  $(document).ready(function(){
    //     let aa =$('#h_div');
    //     let header = $('headerShow');
	// console.log("h_div logger ----",aa);
    //    	header.hide();
    //     aa.hide();
    //     $('#h_div_status').text('hide div successfully');
    // });
    $(function () {
        $(document).ready(function(){
        let aa =$('#h_div');
        console.log("h_div logger ----",aa);
        aa.hide();
        $("#hide").click(function(){
            $("div").hide();
        });


        
        $("#getParents").click(function(){
            let header = $('headerShow');
            let level_id = $(this).val();
	    
	
	    let levels = $('#level').val();
	    let level = levels.split('|', 1)[0];
	    let levelName = levels.split('|', 2)[1];
	    $("#officeType").val(levelName);

            //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
            $("#parentOfficeId").val(level);
            console.log("level_iddddPhil",level);
            getParent(level);

            

            //$("#kdd").html(total);
            //$("div").show();
        });
        });

        function getParent(level_id) {
            let url = "{{url('api/loadParent')}}";
        console.log('mymessage' + url);
        $.ajax({
            url: url,
            type: 'post',
            data: {level: level_id},

            success: function (data) {
                //$('#addons option:not(:first)').remove();
                loadParent(data);

                console.log("response",data);
            },
            error: function (xhr, err) {
                var responseTitle= $(xhr.responseText).filter('title').get(0);
                alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
            }

        });

        }
        function loadParent(data) {
            console.log('thisadata',data);
	    let aa =$('#h_div');
	    let startcad = $('#first_card');
	  
        console.log("h_div loggererere ----",aa);
        aa.show();$('#first_cardB').hide();
	    startcad.hide();
            $.each(data.data, function(key, lev){
		console.log("level", lev);
                let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.type}</option>`;
                $("#types").append(option);
            });

            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }

    });
 </script>

@endsection

