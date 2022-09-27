
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Create Staff</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Form Preview</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="h_div" style="align-content:right;float:right">
        <div class="card">
            <div class="card-body">

                <!-- company Information Starts -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                           class="nav-link active">
                            PERSONAL INFORMATION
                        </a>
                    </li>
                </ul>
		<div id="personalPreviews" class="row">
			<div id="container" class="row form-group" style="margin-top: 20px">
                        <div class="col-md-4">
                            <div id="staff-container">
                                <img src="http://www.fao.org/fileadmin/templates/experts-feed-safety/images/profile-img03.jpg" id="profilepic" alt="Profile Photo" />
                                <label for="formFileSm" class="form-label">
                                    Select a Staff Image.Only JPEG, PNG &amp;
                                    GIF formats. Image should not be larger than 300 KB
                                </label>
                                <input onchange="loadFile(event)" class="form-control form-control-sm" id="formFileSm" type="file" name="imgUrl"/>
                            </div>
                        </div>
                
                    </div>
                
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <span class="d-block p-2 bg-light text-primary"  id="firstName_x"></span>
                            </div>
                        </div>
                        <!-- end col -->
                
                        <div class="col-lg-4 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Middle Name</label>
                                <span class="d-block p-2 bg-light text-primary" id="middleName_x"></span>
                            </div>
                        </div> <!-- end col -->
                
                        <div class="col-lg-4 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <span class="d-block p-2 bg-light text-primary" id="lastName_x"></span>
                            </div>
                        </div> <!-- end col -->
                
                        <!-- end row -->
                
                        <div class="col-lg-6 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Residential Address</label>
                                <span class="d-block p-2 bg-light text-primary" id="residentialAddress_x"></span>
                            </div>
                        </div>
                        <!-- end col -->
                
                        <div class="col-lg-6 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Home Address</label>
                                <span class="d-block p-2 bg-light text-primary" id="homeAddress_x"></span>
                            </div>
                        </div>
			<!-- end col -->
			<div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Phone</label>
                <span class="d-block p-2 bg-light text-primary" id="phone_x"></span>
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Email</label>
                <span class="d-block p-2 bg-light text-primary" id="email_x"></span>
            </div>
        </div>
        

        <div class="col-lg-6 mt-3">
            <label class="mb-1 fw-bold">
                Select State
            </label>

            <span class="d-block p-2 bg-light text-primary" id="state_x"></span>
        </div> 

        <div class="col-lg-6 mt-3">
            <p class="mb-1 fw-bold">
                Select Lga
            </p>
		<span class="d-block p-2 bg-light text-primary" id="lgas_x"></span>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-3 position-relative" id="datepicker1">
                <label class="form-label">Date of Birth</label>
                <span class="d-block p-2 bg-light text-primary" id="dob_x"></span>
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
	    <label for="example-date" class="form-label">Select Gender</label>
<span class="d-block p-2 bg-light text-primary" id="gender_x"></span>

        </div>
        

        <div class="col-lg-6 mt-3">
            <label for="example-date" class="form-label">Select Marital Status</label>
            <span class="d-block p-2 bg-light text-primary" id="m_status_x"></span>
           
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Photo</label>
                <input name="nok_photo" type="file" class="form-control" id="nokPhoto" />
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Name</label>
                <span class="d-block p-2 bg-light text-primary" id="nextofkinName_x"></span>
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of kin Relationship</label>
                <span class="d-block p-2 bg-light text-primary" id="nextOfkinRelation_x"></span>
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next Of Kin Phone</label>
                <span class="d-block p-2 bg-light text-primary" id="nextofkinPhone_x"></span>
            </div>
        </div> 

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Address</label>
                <span class="d-block p-2 bg-light text-primary" id="nextofkinAddress_x"></span>
            </div>
        </div> 


     <!---   <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next Of Kin Contact Address</label>
                <span class="d-block p-2 bg-light text-primary" id="nextofkinContact_x"></span>
            </div>
        </div> -->


        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Emergency Phone</label>
                <span class="d-block p-2 bg-light text-primary" id="emmergencyPhone_x"></span>
            </div>
        </div>
        

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Emergency Address</label>
                <span class="d-block p-2 bg-light text-primary" id="emmergencyAddress_x"></span>
            </div>
        </div>
                    </div>
		</div>


                <!--company Information Starts -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                           class="nav-link active">
                            COMPANY INFORMATION
                        </a>
                    </li>
                </ul> <!-- end nav-->
		<div id="companyPreviews" class="row">
			<?php
    $selectedBank = null;
    $staffUnit = null;
    if(Session::has('companyInfo')){
        $companyInfo = Session::get('companyInfo');
        $ex= explode("|",$companyInfo['bank']);

        $selectedBank =$ex[0];

        $expUnit= explode("|",$companyInfo['staffUnit']);
        $staffUnit = $expUnit[0];

        $expdept = explode("|",$companyInfo['staffDepartment']);
        $staffDepartment = $expdept[0];


        $expLevel = explode("|",$companyInfo['staffLevel']);
        $staffLevel = $expLevel[0];

        $expUnit = explode("|",$companyInfo['staffUnit']);
        $staffUnit = $expUnit[0];

        $expRespType = explode("|",$companyInfo['resumptionType']);
        $resumptionType = $expRespType[0];

        $office = explode("|",$companyInfo['staffBranch']);
        $staffBranch = $office[0];
        //staffDepartment
        //staffUnit
    }
    ?>

    <div class="col-lg-6 mt-3">
        <label class="form-label">
            Staff Code
        </label>
       <span class="d-block p-2 bg-light text-primary"  id="staffCode_x"></span>
        <!-- <button class="btn btn-primary btn-sm" type="button" id="editStaffCode"><span class="uil-edit"></span></button> -->
    </div> 
    <div class="col-lg-6 mt-3">
        <label class="form-label font-14">
            Staff Status
        </label>
        <span class="d-block p-2 bg-light text-primary"  id="status_x"></span>
    </div> 

    <div class="col-lg-6 mt-3">
        <label class="form-label"> Select Staff Branch </label>
        <span class="d-block p-2 bg-light text-primary"  id="staffBranch_x"></span>
    </div> 

    <div class="col-md-6 mt-3">
        <label for="example-date" class="form-label">Select Bank</label>
        <span class="d-block p-2 bg-light text-primary"  id="bank_x"></span>
    </div> 
    <div class="col-md-6 mt-3">
        <label class="form-label">Account Name</label>
        <span class="d-block p-2 bg-light text-primary"  id="accountName_x"></span>
    </div>
    <div class="col-md-6 mt-3">
        <div class="mb-0">
            <label class="form-label">Account Number</label>
            <span class="d-block p-2 bg-light text-primary"  id="accountNumber_x"></span>
        </div>
    </div> 

    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Access Level</label>
        <span class="d-block p-2 bg-light text-primary"  id="accessLevel_x"></span>
        
    </div> 


    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Department Role</label>
        <span class="d-block p-2 bg-light text-primary"  id="staffDepartmentRole_x"></span>
    </div>
    


    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Department</label>
        <span class="d-block p-2 bg-light text-primary"  id="staffDepartment_x"></span>
    </div> 


    <!-- staff unit and department starts -->
    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Unit</label>
        <span class="d-block p-2 bg-light text-primary"  id="staffUnit_x"></span>
    </div> 
    <!-- staff unit and department ends -->


    <table class="table table-hover guarantor">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Photo</th>
            <th>Guarantor's Name</th>
            <th>Guarantor's Phone</th>
            <th>Guarantor's Email</th>
            <th>Guarantor's Office Address</th>
            <th>Guarantor's Home Address</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>

                <td>
                        <span class="d-block p-2 bg-light text-primary" id="g_photo_x"></span>
                    </td>

                    <td>
		    <span class="d-block p-2 bg-light text-primary" id="g_name_x"></span>
                    </td>

                    <td>
                    <span class="d-block p-2 bg-light text-primary" id="g_phone_x"></span>
                    </td>

                    <td>
                    <span class="d-block p-2 bg-light text-primary" id="g_email_x"></span>
                    </td>

                    <td>
                    <span class="d-block p-2 bg-light text-primary" id="g_office_address_x"></span>
                    </td>

                    <td>
                    <span class="d-block p-2 bg-light text-primary" id="g_home_address_x"></span>
                    </td>

                <td></td>

            </tr>
        </tbody>
    </table>

    <div class="more_guarantor" style="margin-bottom: 15px">
        <span class="btn btn-primary">Click to Add More Guarantors <i class="fa fa-plus"></i></span>
    </div>

    <div class="col-lg-4 mt-3">
        <div class="mb-3 position-relative" id="datepicker2">
            <label class="form-label">Resumption Date</label>
            <span class="d-block p-2 bg-light text-primary" id="resumptionDate_x"></span>
        </div>
    </div> 


    <div class="col-lg-4 mt-3">
        <div class="mb-3 position-relative" id="datepicker3">
            <label class="form-label">Assumption date</label>
            <span class="d-block p-2 bg-light text-primary" id="assumptionDate_x"></span>
        </div>
    </div> 


    <div class="col-lg-6 mt-3">
        <label class="form-label"> Staff Level </label>
        <span class="d-block p-2 bg-light text-primary" id="staffLevel_x"></span>
    </div> 

    <div class="col-lg-6 mt-3">

        <label class="form-label">
            Staff Resumption Type
        </label>
        <span class="d-block p-2 bg-light text-primary" id="resumptionType_x"></span>
    </div> 

		</div>


                <!-- Work Experiences Begin -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                               class="nav-link active">
                                Work Experience
                            </a>
                        </li>
                    </ul>
		<div id="experiencePreviews" class="row">
			<div class="row">
        <span class="label label-info" style=" font-size: 17px !important; text-transform: uppercase">Work Experience</span><br /><br /><small>Enter Work experience from oldest to
            recent</small><br /><br />


        <table class="table table-hover work_experience">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Name of Establishment</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>Position Held</th>
                <th>Job Functions</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>

                    <td>
                        <span class="d-block p-2 bg-light text-primary" id="institution_name_x"></span>
                    </td>

                    <td>
                        <!-- <div class="mb-3 position-relative" id="work_start_year">  -->
                        <span class="d-block p-2 bg-light text-primary" id="work_start_year_x"></span>
                        </div>
                    </td>

                    <td>
                         <!-- <div class="mb-3 position-relative" id="work_end_year">  -->
                        <span class="d-block p-2 bg-light text-primary" id="work_end_year_x"></span>
                        </div>
                    </td>

                    <td>
                        <span class="d-block p-2 bg-light text-primary" id="position_held_x"></span>
                    </td>

                    <td>
                    <span class="d-block p-2 bg-light text-primary" id="job_functions_x"></span>
                    </td>

                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="more_work" style="margin-bottom: 25px">
            <span class="btn btn-primary">Click to Add More Work Experience <i class="fa fa-plus"></i></span>
        </div>
    </div>
		</div>

                    <div class="row" style="margin-top:10px">
                        <div class="row" style="margin-top:30px">
			    <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                               
                              <button class="btn btn-primary" name="back" type="button" value="Back" id="backbtn">Back</button>
			    </div>
                       <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                                <button class="btn btn-primary" name="proceed" value="Submit"
                                        id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>


    <script>

     $(document).ready(function(){
     	     $("#backbtn").click(function(){
		window.history.back();
     });
    
   
    $(function () {

        let url = "{{url('api/get-states')}}";
        console.log('mymessage' + url);
        $.ajax({
            url: url,
            type: 'get',
            data: { level: '1' },

            success: function (data) {

                console.log('thisadata', data);
                $.each(data, function (key, states) {
                    console.log("CountryState", states);
                    let option = `<option value="${states.name}"> ${states.name}</option>`;
                    $("#state").append(option);
                });

                //Change the text of the default "loading" option.
                //$('#addons-select').removeClass('d-none').addClass('d-block')
                //$('#addon-loader').removeClass('d-block').addClass('d-none');
                //$('#submit').removeClass('d-none').addClass('d-block');


                console.log("response", data);
            },
            error: function (xhr, err) {
                var responseTitle = $(xhr.responseText).filter('title').get(0);
                alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
            }

        });


        $('#state').change(function () {
            let selectedState = $(this).val();
            console.log("thisIsMySelectedState", selectedState)

            //        alert("The paragraph was clicked.");


            if (selectedState !== '') {
                //$('#addon-loader').removeClass('d-none').addClass('d-block');
                //$('#submit').removeClass('d-block').addClass('d-none');
                // getAddon(code);


                let url = "{{url('api/get-lga')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: { state: selectedState },

                    success: function (data) {
                        // $('#addons option:not(:first)').remove();
                        console.log('thisadata', data);
                        $.each(data, function (key, lga) {
                            console.log("CountryState", lga);
                            let option = `<option value="${lga}"> ${lga}</option>`;
                            $("#lgas").append(option);
                        });


                    },
                    error: function (xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });
            }
            else {
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#addons option:not(:first)').remove();

                $('#addons-select').removeClass('d-block').addClass('d-none')
                $('#submit').removeClass('d-block').addClass('d-none');
            }

        });




        function formatErrorMessage(jqXHR, exception) {

            if (jqXHR.status === 0) {
                return ('Not connected.\nPlease verify your network connection.');
            } else if (jqXHR.status == 404) {
                return ('The requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                return ('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                return ('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                return ('Time out error.');
            } else if (exception === 'abort') {
                return ('resource request aborted.');
            } else {
                return ('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
    });
</script>
