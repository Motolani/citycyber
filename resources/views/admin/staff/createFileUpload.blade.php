
@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    
                    <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Staff</li>
                </ol>
            </div>
            <h4 class="page-title">Create Staff</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    
    <div class="col-12" id = "h_div" style = "align-content:right, float:right">
        <div class="card">
            <div class="card-body" >
                <h4 class="header-title" style = "">Staff Management</h4>
                <p class="text-muted font-14">
                    Here if the first level where you can insert all personal staff's Information
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Staff Document Upload
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
		    <form method = "POST" action = "{{route('createOffice')}}">
			@csrf

                <div class="row">
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                            <p class="mb-1 fw-bold text-muted"></p>
                            <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Assumption duty form</label>
                            <input type="file" name = "assumptionDutyForm" id="example-fileinput" class="form-control">
                            
                        </div>
                    </div> <!-- end col -->

                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Staff bank details</label>
                            <input type="file" name = "staffBankDetails" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Oath of password secrecy</label>
                            <input type="file" name = "oathOfPassSecrecy" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Oath of allegiance and secrecy</label>
                            <input type="file" name = "oathOfAllegieanceAndSecrecy" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page1</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage1" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page2</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage2" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page3</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage3" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page4</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage4" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page5</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage5" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page6</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage6" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page7</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage7" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Human capital management employee data form page8</label>
                            <input type="file" name = "humanCapitalManagementEmployeeDataFormPage8" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Application letter</label>
                            <input type="file" name = "applicationLetter" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Curriculm vitae</label>
                            <input type="file" name = "curriculmVitae" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">Interview evaluation</label>
                            <input type="file" name = "interviewEvaluation" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> First school leaving certificate</label>
                            <input type="file" name = "firstSchoolLeavingCertificate" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> SENIOR SCHOOL CERTIFICATE (WAEC/NECO)</label>
                            <input type="file" name = "seniorSchoolCertificate(WAEC/NECO)" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> Tertiary institution certificate (OND/HND/B.SC)</label>
                            <input type="file" name = "tertiaryInstitutionCertificate (OND/HND/B.SC)" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">National youth service corp (NYSC) discharge certificate</label>
                            <input type="file" name = "nationalYouthServiceCorp(NYSC)DischargeCertificate" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> Local government of origin</label>
                            <input type="file" name = "localGovernmentOfOrigin" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> GUARANTOR FORM 1ment of origin</label>
                            <input type="file" name = "localGovernmentOfOrigin" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> GUARANTOR'S CONFIRMATION FORM 1</label>
                            <input type="file" name = "guarantor'sConfirmation" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> PROFESSIONAL CERTIFICATION(S)</label>
                            <input type="file" name = "professionalCertification(s)" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> POST GRADUATE CERTIFICATE(S)</label>
                            <input type="file" name = "postGraduateCertificate" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> GUARANTOR FORM 2</label>
                            <input type="file" name = "guarantorForm2" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> GUARANTOR'S CONFIRMATION FORM 2</label>
                            <input type="file" name = "guarantor'sConfirmationForm2" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label">GUARANTOR FORM (ADDITIONAL)</label> 
                            <input type="file" name = "guarantorForm(Additional)" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="mb-3">
                        <p class="mb-1 fw-bold text-muted"></p>
                        <p class="text-muted font-14">
                            <label for="example-fileinput" class="form-label"> GUARANTOR'S CONFIRMATION FORM (ADDITIONAL)</label>
                            <input type="file" name = "gurantor'sConfirmationForm(Additional)" id="example-fileinput" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    
                </div>
                <!-- end row -->
                <!-- end row --> 

                <div class="row" style="margin-top:10px">


                    <div class="col-lg-6">
                        <div class="mb-0">
                            
                        </div>
                    </div> <!-- end col -->


                    <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                        <button class="btn btn-primary" style="float: right;" id="submit">Goto Preview</button>
                    </div>
                </div>
                <!-- end row --> 
		    </form>
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
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
    // $(function () {
    //     $(document).ready(function(){
    //     let aa =$('#h_div');
    //     console.log("h_div logger ----",aa);
    //     aa.hide();
    //     $("#hide").click(function(){
    //         $("div").hide();
    //     });


        
    //     $("#getParents").click(function(){
    //         let header = $('headerShow');
    //         let level_id = $(this).val();
	    
	
	//     let levels = $('#level').val();
	//     let level = levels.split('|', 1)[0];
	//     let levelName = levels.split('|', 2)[1];
	//     $("#officeType").val(levelName);

    //         //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
    //         $("#parentOfficeId").val(level);
    //         console.log("level_iddddPhil",level);
    //         getParent(level);

            

    //         //$("#kdd").html(total);
    //         //$("div").show();
    //     });
    //     });

    //     function getParent(level_id) {
    //         let url = "{{url('api/loadParent')}}";
    //     console.log('mymessage' + url);
    //     $.ajax({
    //         url: url,
    //         type: 'post',
    //         data: {level: level_id},

    //         success: function (data) {
    //             //$('#addons option:not(:first)').remove();
    //             loadParent(data);

    //             console.log("response",data);
    //         },
    //         error: function (xhr, err) {
    //             var responseTitle= $(xhr.responseText).filter('title').get(0);
    //             alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
    //         }

    //     });

    //     }
    //     function loadParent(data) {
    //         console.log('thisadata',data);
	//     let aa =$('#h_div');
	//     let startcad = $('#first_card');
	  
    //     console.log("h_div loggererere ----",aa);
    //     aa.show();$('#first_cardB').hide();
	// startcad.hide();
    //         $.each(data.data, function(key, lev){
	// 	console.log("level", lev);
    //             let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.type}</option>`;
    //             $("#types").append(option);
    //         });

    //         //Change the text of the default "loading" option.
    //         $('#addons-select').removeClass('d-none').addClass('d-block')
    //         $('#addon-loader').removeClass('d-block').addClass('d-none');
    //         $('#submit').removeClass('d-none').addClass('d-block');
    //     }

    // });
 </script>

@endsection






