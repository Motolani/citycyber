
<div id="experienceForm">
    <!-- Work Experience Details Ends-->
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
            @if(Session::has('workEducation') &&
            Session::get('workEducation')['institution_name'])
                <?php $counter = 1;?>
                @for ($i = 0; $i < sizeof(Session::get('workEducation')['institution_name']);
                    $i++) <tr>
                    <td>{{$counter++}}</td>

                    <td>
                        <input type="text" name="institution_name[]" autocomplete="off"
                               {{-- value="{{ Session::get('workEducation')['institution_name'][$i] ?? '' }}" --}}
                               class="form-control" data-provide="datepicker"
                               data-date-container="">
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="work_start_year">
                            <select name="work_start_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="work_end_year">
                            <select name="work_end_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </td>

                    <td>
                        <input autocomplete="off"
                               {{-- value="{{ Session::get('workEducation')['position_held'][$i] ?? '' }}" --}}
                               class="form-control underline" id="position_held" type="text"
                               name="position_held[]">
                    </td>

                    <td>
                        <input autocomplete="off"
                               {{-- value="{{ Session::get('workEducation')['job_functions'][$i] ?? '' }}" --}}
                               class="form-control underline" name="job_functions[]" id="job_functions" type="text"
                               id="">
                    </td>

                    <td></td>
                </tr>
                @endfor
            @else

                <tr>
                    <td>1</td>

                    <td>
                        <input autocomplete="off" class="form-control underline"
                               id="institution_name" type="text" name="institution_name[]">
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="work_start_year">
                            <input type="text" class="form-control" autocomplete="off"
                                   placeholder="YYYY only e.g 2004" name="work_start_year[]"
                                   id="work_start_year" data-provide="datepicker"
                                   data-date-container="#work_start_year">
                        </div>
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="work_end_year">
                            <input type="text" class="form-control"
                                   placeholder="YYYY only e.g 2004" name="work_end_year[]"
                                   id="work_end_year" autocomplete="off"
                                   data-provide="datepicker"
                                   data-date-container="#work_end_year">
                        </div>
                    </td>

                    <td>
                        <input autocomplete="off" value="" class="form-control underline"
                               id="position_held" type="text" name="position_held[]">
                    </td>

                    <td>
                        <input autocomplete="off" class="form-control underline"
                               name="job_functions[]" id="job_functions" value="" type="text">
                    </td>

                    <td></td>
                </tr>
            @endif
            </tbody>
        </table>

        <div class="more_work" style="margin-bottom: 25px">
            <span class="btn btn-primary">Click to Add More Work Experience <i class="fa fa-plus"></i></span>
        </div>
    </div>

    <!-- Educational Details Details Ends-->
    <div class="row">
        <span class="label label-info" style=" font-size: 17px !important; text-transform: uppercase">Education Details</span>
        <br /><br />
        <small>Enter Education Details from oldest to recent</small>
        <br /><br />


        <table class="table table-hover education">
            <thead>
            <tr>
                <td>S/N</td>
		<th>Upload</th>
                <th>Qualification</th>
                <th>Start Year</th>
                <th>End Year</th>
                <th>Name of Institution</th>
                <th>Course/Certification</th>
	       <th>Education Type</th>
                <th>Class</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if(Session::has('workEducation'))
                <?php $counter = 1;?>
                @for ($i = 0; $i < sizeof(Session::get('workEducation')['education_type']); $i++)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td><input type="file" name="document_photo[]" class="form-control" /></td>

                       <td>
                            <!-- <input type="text" name="education_type[]" class="form-control" {{-- value="{{ Session::get('workEducation')['education_type'][$i] ?? '' }}" --}} /> -->
                            <select class="form-select" aria-label="Default select example"{{-- value="{{Session::get('workEducation')['qualification'][$i] ?? '' }}" --}}
                                   id="course" type="text" name="qualification[]" >
				<option selected>---Select qualification  type---</option>
			      
	<option value="others"@if (old('qualification') == 'others') selected="selected" @endif>Others/Not application</option>
                                <option value="primary"@if (old('qualification') == 'primary') selected="selected" @endif>PRIMARY</option>
                                <option value="waec"@if (old('qualification') == 'waec') selected="selected" @endif>WAEC</option>
				<option value="neco"@if (old('qualification') == 'neco') selected="selected" @endif>NECO</option>
                                  <option value="nabtech"@if (old('qualification') == 'nabtech') selected="selected" @endif>NABTECH</option>
                                <option value="ond"@if (old('qualification') == 'ond') selected="selected" @endif>OND</option>
				<option value="hnd"@if (old('qualification') == 'hnd') selected="selected" @endif>HND</option>
                                  <option value="nce"@if (old('qualification') == 'nce') selected="selected" @endif>NCE</option>
				<option value="bsc"@if (old('qualification') == 'bsc') selected="selected" @endif>B.sc</option>
				 <option value="msc"@if (old('qualification') == 'msc') selected="selected" @endif>Msc</option>
				  <option value="beng"@if (old('qualification') == 'beng') selected="selected" @endif>B.eng</option>
                                  <option value="ond"@if (old('qualification') == 'phd') selected="selected" @endif>PHD</option>
                                <option value="master"@if (old('qualification') == 'master') selected="selected" @endif>MASTER</option>
                              
                            </select>
                        </td>

                        <td>
                            <div class="mb-3 position-relative" id="start_year">
			   
                               <select id="startYear" name="start_year[]" class="form-control select select2" data-toggle="select2">
				  @include('admin.includes.year-options')
				</select>
                             
                            </div>
                        </td>

                        <td>
                            <div class="mb-3 position-relative" id="end_year">
			    <select id="startYear" name="end_year[]" class="form-control select select2" data-toggle="select2" > 
					@include('admin.includes.year-options')
                               </select>
                            </div>
                        </td>

                        <td>
                            <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                                   {{-- value="{{ Session::get('workEducation')['institution_name'][$i] ?? '' }}" --}}
                                   id="institution_name" type="text" name="institution_name[]">
                        </td>

                        <td>
                            <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                                   {{-- value="{{ Session::get('workEducation')['course_name'][$i] ?? '' }}" --}}
                                   id="course" type="text" name="course_name[]">
                        </td>
                      
                         <td>
                            <!-- <input type="text" name="education_type[]" class="form-control" {{-- value="{{ Session::get('workEdu
cation')['education_type'][$i] ?? '' }}" --}} /> -->
               <select class="form-select" aria-label="Default select example"{{-- value="{{Session::get('workEducation')['qualification'][$i] ?? '' }}" --}}
                                id="course" type="text" name="education_type[]" >
                                <option selected>---Select qualification  type---</option>
        <option value="primary"@if (old('education_type') == 'primary') selected="selected" @endif>Primary</option>
                                <option value="secondary"@if (old('education_type') == 'secondary') selected="selected" @endif>Second
ary</option>
                                <option value="tertiary"@if (old('education_type') == 'tertiary') selected="selected" @endif>TERTIARY
</option>
                                <option value="professional"@if (old('education_type') == 'professional') selected="selected" @endif>
PROFESSIONAL/CERTIFICATION</option>
                            </select>
                        </td>
                     <!--   <td>
                            <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                                   {{-- value="{{Session::get('workEducation')['qualification'][$i] ?? '' }}" --}}
                                   id="course" type="text" name="qualification[]">
			</td>-->
                          <td>
                           

                        {{--                    <td>--}}
                        {{--                        <select class="form-control" name="education_class_id[]"--}}
                        {{--                                id="education_class_id">--}}
                        {{--                            <option--}}
                        {{--                                    value="{{ Session::get('workEducation')['education_class_id'][$i] ?? '' }}"--}}
                        {{--                                    selected>{{ Session::has('workEducation') ?--}}
                        {{--                                                        Session::get('workEducation')['education_class_id'][$i] ?? '' }}--}}
                        {{--                            </option>--}}
                        {{--                            @if(isset($education_class_collection))--}}
                        {{--                                @if(!$education_class_collection->isEmpty())--}}
                        {{--                                    @foreach($education_class_collection as $val)--}}
                        {{--                                        <option value="{{ $val->id }}">{{ $val->type }} </option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                @endif--}}
                        {{--                            @endif--}}
                        {{--                        </select>--}}
                        {{--                    </td>--}}
                    </tr>
                @endfor
            @else
                <tr>
                    <td>1</td>
                   <!-- <td>
                        <input type="text" name="education_type[]" class="form-control" />
                    </td>-->

                    <td>
                        <div class="mb-3 position-relative" id="start_year">
                            <div class="mb-3 position-relative" id="start_year">
                                <select id="startYear" name="start_year[]" class="form-control select select2" data-toggle="select2">
                                    @include('admin.includes.year-options')
                                </select>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="mb-3 position-relative">
                            <select id="startYear" name="end_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </td>

                    <td>
                        <input autocomplete="off" placeholder="Ignore if not applicable"
                               {{-- value="{!! old('institution_name') !!}" --}}
                               class="form-control underline" id="institution_name" type="text"
                               name="institution_name[]">
                    </td>

                    <td>
                        <input autocomplete="off" placeholder="Ignore if not applicable"
                               {{-- value="{!! old('course_name') !!}" --}}
                               class="form-control underline" id="course_name" type="text"
                               name="course_name[]">
                    </td>
                       <td>
                            <!-- <input type="text" name="education_type[]" class="form-control" {{-- value="{{ Session::get('workEdu
cation')['education_type'][$i] ?? '' }}" --}} /> -->
                            <select class="form-select" aria-label="Default select example"{{-- value="{{Session::get('workEducation'
)['qualification'][$i] ?? '' }}" --}}
                                   id="course" type="text" name="education_type[]" >
                                <option selected>---Select qualification  type---</option>
        <option value="primary"@if (old('education_type') == 'primary') selected="selected" @endif>Primary</option>
                                <option value="secondary"@if (old('education_type') == 'secondary') selected="selected" @endif>Secondary</option>
                                <option value="tertiary"@if (old('education_type') == 'tertiary') selected="selected" @endif>TERTIARY</option>
                                <option value="professional"@if (old('education_type') == 'professional') selected="selected" @endif>PROFESSIONAL/CERTIFICATION</option>
                            </select>
                        </td>
                   <!-- <td>
                        <select class="form-control" name="qualification[]" id="qualification">
                            <option selected value="">--Select Type--</option>
                            @if(isset($education_qual_collection))
                                @if(!$education_qual_collection->isEmpty())
                                    @foreach($education_qual_collection as $val)
                                        <option value="{{ $val->id }}">{{ $val->type }} </option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </td>-->

                   <!-- <td>
                        <select class="form-control" name="education_class_id[]"
                                id="education_class_id">
                            <option selected value="">--Select Type--</option>
                            @if(isset($education_class_collection))
                                @if(!$education_class_collection->isEmpty())
                                    @foreach($education_class_collection as $val)
                                        <option value="{{ $val->id }}">{{ $val->type }} </option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                    </td>-->
		    
                     <td>

                          <select class="form-control" name="education_class_id[]"
                               id="education_class_id">
                            <option selected value="">--Select Type--</option>
                            <option value="first_class">First Class</option>
                                <option value="second_class/upper_division">Second Class/Upper Division</option>
                                <option value="second_class/lower_division">Second Class/Lower Class</option>
                                <option value="Third_class">Third Class</option>
                                <option value="distinction">Distinction</option>
                                <option value="credit">Credit</option>
                                <option value="merit">Merit</option>
                                <option value="pass">Pass</option>
                                <option value="Fail">Fail</option>
                                <option value="others/Not_Applicable">Others/Not Applicable</option>
                        </select>
                    </td

                </tr>
            @endif
            </tbody>
        </table>

        <div class="more_education" style="margin-bottom: 25px">
        <span class="btn btn-primary">Click to Add More Education <i class="ti-plus"></i>
        </span>
        </div>
    </div>

</div>

<div class="row" style="margin-top:10px">
    <div class="row" style="margin-top:30px">
        <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
            <button type="button" class="btn btn-primary" name="back" value="Back" id="btnBack">Back</button>
        </div>
        <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
            <input type="button" class="btn btn-primary" name="proceed" value="Proceed" id="btnProceedPreview">
        </div>
    </div>
</div>
<!-- end row -->

<script>

    $("#btnBack").click(function (e) {
        $('.nav-tabs a[href="#company"]').tab('show');
    });

    $("#btnProceedPreview").click(function (e) {
        //Append the personal Info form to the preview
	    var personalInfo = $("#personalInfoForm").html();
	    //console.log("personalInfo",personalInfo);
	    let firstname =$("#firstName").val();
	    $('#firstName_x').html(firstname);
	    var middlename = $("#middleName").val();
	    $('#middleName_x').html(middlename);
	    var lastname = $("#lastName").val();
	    $('#lastName_x').html(lastname);
	    var address = $("#prefetch").val();
	     $('#residentialAddress_x').html(address);
	    var address2 = $("#homeAddress").val();
	    $('#homeAddress_x').html(address2);
	    var phone = $("#phone").val();
	    $('#phone_x').html(phone);
	    var email = $("#emailAdd").val();
	    console.log(email);
	    $('#email_x').html(email);
	    var state = $("#state").val();
	    $('#state_x').html(state);
	    var lga = $("#lgas").val();
	    $('#lgas_x').html(lga);
	    var dob = $("#d_o_b").val();
	    $('#dob_x').html(dob);
	    var gender = $("#gender").val();
	    $('#gender_x').html(gender);
	    var mstatus = $("#marital_status").val();
	    $('#m_status_x').html(mstatus);
	    var photo = $("#nokPhoto").val();
	    $('#nokPhoto_x').html(photo);
	    var nok = $("#nextofkinName").val();
        //console.log('#nextofkinName');
        //console.log('nok',nok);
	    $('#nextofkinName_x').html(nok);
	    var nokRelation = $("#nextOfkinRelation").val();
	    $('#nextOfkinRelation_x').html(nokRelation);
	    var kinPhone = $("#nextofkin_Phone").val();
	    $('#nextofkinPhone_x').html(kinPhone);
	    var kinAddress = $("#nextofkinAddress").val();
	    $('#nextofkinAddress_x').html(kinAddress);
	    var e_phone = $("#emmergencyPhone").val();
	    $('#emmergencyPhone_x').html(e_phone);
	    var e_address = $("#emmergencyAddress").val();
	    $('#emmergencyAddress_x').html(e_address);
        //  console.log("firstname", firstname, "lastname", lastname "status" , mstatus , "phone" , phone , "gender", gender);
	    //assumption date js
        var assumpDate = $("#assumptionDate").val();
        $('#assumptionDate_x').html(assumpDate);
        
        var resumpDate = $("#resumptionDate").val();
        $('#resumptionDate_x').html(resumpDate);

        var stafflev = $("#staffLevel").val();
        $('#staffLevel_x').html(stafflev);
        
        var resumpType = $("#resumptionType").val();
        $('#resumptionType_x').html(resumpType);
        

        //work experience
        var g_name_g = $("#g_name").val();
        $('#g_name_x').html(g_name_g);
        

        var g_phone_g = $("#g_phone").val();
        $('#g_phone_x').html(g_phone_g);
        

        var g_email_g = $("#g_email").val();
        $('#g_email_x').html(g_email_g);
    

        var g_office_address_g = $("#g_office_address").val();
        $('#g_office_address_x').html(g_office_address_g);
        

        var g_home_address_g = $("#g_home_address").val();
        $('#g_home_address_x').html(g_home_address_g);
        
        
        //work experience
        var g_institute_g = $("#institution_name").val();
        $('#institution_name_x').html(g_institute_g);
        //console.log('g_instutute_g',g_institute_g);

        var g_work_start_year_g = $("#work_start_year").val();
        $('#work_start_year_x').html(g_work_start_year_g);
        //console.log('g_work_start_year_g ',g_work_start_year_g);

        var g_work_end_year_g = $("#work_end_year").val();
        $('#work_end_year_x').html(g_work_end_year_g );
       // console.log('g_work_end_year_g ',g_work_end_year_g);

        var g_position_held_g = $("#position_held").val();
        $('#position_held_x').html(g_position_held_g );
       // console.log('g_position_held_g',g_position_held_g);

        var g_job_function_g = $("#job_function").val();
        $('#job_function_x').html(g_job_function_g );
        //console.log('g_job_function_g',g_job_function_g);
        
        
        

        var personalPreview = $("#personalPreview");
        personalPreview.html("");
        personalPreview.append(personalInfo);
        //Disable all fields
        $("#personalPreview input").prop('disabled', true);
        $("#personalPreview .btn").remove();

        //Append the Company Info form to the preview
	var companyInfo = $("#companyInfoForm").html();

	var staffcode = $("#staffCode").val();
	$('#staffCode_x').html(staffcode);
	var s_status = $("#status").val();
    $('#status_x').html(s_status);
	var staffbranch = $("#staffBranch").val();
	$('#staffBranch_x').html(staffbranch);
	var bank = $("#bank").val();
	$('#bank_x').html(bank);
	var acctName = $("#accountName").val();
	$('#accountName_x').html(acctName);
	var acctNum = $("#accountNumber").val();
	$('#accountNumber_x').html(acctNum);
	var accessLevel = $("#accessLevel").val();
	$('#accessLevel_x').html(accessLevel);
	var staffRole = $("#staffDepartmentRole").val();
	$('#staffDepartmentRole_x').html(staffRole);
	var staffDept = $("#staffDepartment").val();
	$('#staffDepartment_x').html(staffDept);
	 var staffUnit = $("#staffUnit").val();
	$('#staffUnit_x').html(staffUnit);
	 var staffDept = $("#staffDepartment").val();
        $('#staffDepartment_x').html(staffDept);

        var companyPreview = $("#companyPreview");
        companyPreview.html("");
        companyPreview.append(companyInfo);
        //Disable all fields
        $("#companyPreview input").prop('disabled', true);
        $("#companyPreview .btn").remove();


        //Append the Experience Info form to the preview
	var experienceInfo = $("#experienceForm").html();

        var experiencePreview = $("#experiencePreview");
        experiencePreview.html("");
        experiencePreview.append(experienceInfo);
        //Disable all fields
        $("#experiencePreview input").prop('disabled', true);
        $("#experiencePreview .btn").remove();


        $('.nav-tabs a[href="#summary"]').tab('show');
    });

    //more work functionality
    $('div.more_work').click(function (e) {
        //look for previous delete button and remove
        $('table.work_experience tr:last').find('td:last').html("");

        var last_tr = $('table.work_experience tr:last').clone();
        //implement changes and clear all data
        last_tr.find(':text').val('');
        last_tr.find('textarea').val("");
        first_td_data = last_tr.find('td:first').html();
        first_td_data++;
        last_tr.find('td:first').html(first_td_data);
        last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");

        $('table.work_experience tr:last').after(last_tr);

    });

    //more education functionality
    $('div.more_education').click(function (e) {
        //look for previous delete button and remove
        $('table.education tr:last').find('td:last').html("");

        var last_tr = $('table.education tr:last').clone();
        //implement changes and clear all data
        last_tr.find(':text').val('');
        last_tr.find('select').val('');
        first_td_data = last_tr.find('td:first').html();
        first_td_data++;
        last_tr.find('td:first').html(first_td_data);
        last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");

        $('table.education tr:last').after(last_tr);

    });
</script>

