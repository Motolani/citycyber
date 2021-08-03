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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3"> Basic Wizard</h4>

                    <form>
                        <div id="basicwizard">

                            <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                <li class="nav-item">
                                    <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab"  class="nav-link rounded-0 pt-2 pb-2"> 
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-face-profile me-1"></i>
                                        <span class="d-none d-sm-inline">Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                        <span class="d-none d-sm-inline">Finish</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content b-0 mb-0">
                                <div class="tab-pane" id="basictab1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="userName">User name</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="userName" name="userName" value="hyper">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="password"> Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="password" name="password" class="form-control" value="123456789">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="confirm">Re Password</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="confirm" name="confirm" class="form-control" value="123456789">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="basictab2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="name"> First name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="name" name="name" class="form-control" value="Francis">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="surname"> Last name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="surname" name="surname" class="form-control" value="Brinkman">
                                                </div>
                                            </div>
                    
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="email">Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email" name="email" class="form-control" value="cory1979@hotmail.com">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="basictab3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                <h3 class="mt-0">Thank you !</h3>

                                                <p class="w-75 mb-2 mx-auto">Quisque nec turpis at urna dictum luctus. Suspendisse convallis dignissim eros at volutpat. In egestas mattis dui. Aliquam
                                                    mattis dictum aliquet.</p>

                                                <div class="mb-3">
                                                    <div class="form-check d-inline-block">
                                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                                        <label class="form-check-label" for="customCheck1">I agree with the Terms and Conditions</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <ul class="list-inline wizard mb-0">
                                    <li class="previous list-inline-item">
                                        <a href="#" class="btn btn-info">Previous</a>
                                    </li>
                                    <li class="next list-inline-item float-end">
                                        <a href="#" class="btn btn-info">Next</a>
                                    </li>
                                </ul>

                            </div> <!-- tab-content -->
                        </div> <!-- end #basicwizard-->
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->

        
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

