
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
            <h4 class="page-title">Staff Form Preview</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    
    <div class="col-12" id = "h_div" style = "align-content:right, float:right">
        <div class="card">
            <div class="card-body" >
                <!-- Personal Information starts -->
                <form method = "POST" action = "{{route('newStaff')}}">
                @csrf
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Personal Information 
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                    
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name = "firstName" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['firstName']:'' }}" data-provide="typeahead" id="the-basics" placeholder="First Name" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Middle Name</label>
                                    <input required id="middleName" value = "{{ Session::get('personalInfo')['middleName'] }}" name = "middleName" class="form-control" type="text" placeholder="Middle Name" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input required id="lastName" name = "lastName" value = "{{ Session::get('personalInfo')['lastName'] }}" class="form-control" type="text" placeholder="Last Name" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Residential Address</label>
                                    <input type="text" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['residentialAddress']:'' }}"  data-provide="typeahead" id="prefetch" name = "residentialAddress" placeholder="please enter Residential Address" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Home Address</label>
                                    <input name = "homeAddress" required type="text" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['homeAddress']:'' }}" data-provide="typeahead" id="homeAddress" placeholder="Please enter Home Address" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                         
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Phone</label>
                                    <input name = "phone" required type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['phone']:'' }}" class="form-control" data-provide="phone" id="phone" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Email</label>
                                    <input name = "email" type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['email']:'' }}" class="form-control" data-provide="typeahead" id="email" name = "email" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">State</label>
                                    <input name = "state" type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['state']:'' }}" class="form-control" data-provide="typeahead" id="state"  readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Lga</label>
                                    <input name = "lga" type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}" class="form-control" data-provide="typeahead" id="lga"  readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label for="example-date" class="form-label">Date of Birth</label>
                                    <input class="form-control" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['dob']:'' }}" id="example-date" type="text" name="dob" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label for="example-date" class="form-label">Gender</label>
                                    <input class="form-control" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}" id="example-date" type="text" name="gender" readonly>
                                </div>
                            </div> <!-- end col -->
                            
                            
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label for="example-date" class="form-label">Marital Status</label>
                                    <input class="form-control" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:''}}" id="example-date" type="text" name="maritalStatus" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <br/>



                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of Kin Name</label>
                                    <input name = "nextofkinName" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinName']:'' }}" required type="text" class="form-control" data-provide="phone" id="nextofkinName" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of kin Relationship</label>
                                    <input name = "nextofkinRelationship" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}" type="text" class="form-control" data-provide="typeahead" id="nextOfkinRelation" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next Of Kin Phone</label>
                                    <input name = "nextofkinPhone" type="text" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinPhone']:'' }}" class="form-control" data-provide="typeahead" id="multiple-ddatasets" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of Kin Address</label>
                                    <input name = "nextofkinAddress" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinAddress']:'' }}" type="text" class="form-control" data-provide="typeahead" id="nextofkinAddress" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Next Of Kin Contact Address</label>
                                    <input name = "nextofkinContact" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinContact']:'' }}" required type="text" class="form-control" data-provide="phone" id="nextofkin" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Emmergency Phone</label>
                                    <input name = "emmergencyPhone" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['emmergencyPhone']:'' }}" type="text" class="form-control" data-provide="typeahead" id="emmergencyPhone" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Emergency Address</label>
                                    <input name = "emergencyAddress" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['emergencyAddress']:'' }}" type="text" class="form-control" data-provide="typeahead" id="emmergencyAddress" readonly>
                                </div>
                            </div> <!-- end col -->

                        </div>

                        


                        <!-- end row --> 
		            
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->


                <!-- Personal Information Ends -->


                <!-- company Information Starts -->
                <br/>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            COMPANY INFORMATION
                        </a>
                    </li>
                </ul> <!-- end nav-->


                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Staff Status</label>
                                    <input type="text" name = "firstName" class="form-control" value="{{Session::has('companyInfo') ? Session::get('companyInfo')['status'] : '' }}" data-provide="typeahead" id="the-basics" placeholder="First Name" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Staff Branch</label>
                                    <input required id="middleName" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffBranch'] : '' }}" name = "middleName" class="form-control" type="text" placeholder="Middle Name" readonly>
                                </div>
                            </div> <!-- end col -->

                            
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['bank'] : '' }}"  data-provide="typeahead" id="prefetch" name = "residentialAddress" placeholder="please enter Residential Address" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Account Name</label>
                                    <input name = "homeAddress" required type="text" class="form-control" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}" data-provide="typeahead" id="homeAddress" placeholder="Please enter Home Address" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Account Number</label>
                                    <input name = "homeAddress" required type="text" class="form-control" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountNumber'] : '' }}" data-provide="typeahead" id="homeAddress" placeholder="Please enter Home Address" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                         
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Staff Unit</label>
                                    <input name = "phone" required type="text" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffUnit'] : '' }}" class="form-control" data-provide="phone" id="phone" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Staff Department</label>
                                    <input name = "email" type="text" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartment'] : '' }}" class="form-control" data-provide="typeahead" id="email" name = "email" readonly>
                                </div>
                            </div> <!-- end col -->



                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Staff Role</label>
                                    <input name = "email" type="text" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartmentRole'] : '' }}" class="form-control" data-provide="typeahead" id="email" name = "email" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        


                        <table class="table table-hover guarantor">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Guarantor's Name</th>
                                    <th>Guarantor's Phone</th>
                                    <th>Guarantor's Email</th>
                                    <th>Guarantor's Office Address</th>
                                    <th>Guarantor's Home Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::has('companyInfo') && Session::get('companyInfo')['g_name'])
                                <?php $counter = 1;?>
                                    @for ($i = 0; $i < sizeof(Session::get('companyInfo')['g_name']); $i++)
                                    <tr>
                                        <td>{{$counter++}}</td>

                                        <td>
                                            <input placeholder="FirstName  LastName" autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_name'][$i] : '' }}"
                                                class="form-control underline" id="g_name" type="text" name="g_name[]" readonly>
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_phone'][$i] : '' }}"
                                                class="form-control underline" id="g_phone" type="text"
                                                name="g_phone[]" readonly>
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_email'][$i] : '' }}"
                                                class="form-control underline" id="g_email" type="text"
                                                name="g_email[]" readonly>
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_office_address'][$i] : '' }}"
                                                class="form-control underline" id="g_office_address" type="text"
                                                name="g_office_address[]" readonly>
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_home_address'][$i] : '' }}"
                                                class="form-control underline" id="g_home_address" type="text"
                                                name="g_home_address[]" readonly>
                                        </td>

                                    </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>

                        <br/>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Resumption Date</label>
                                    <input name="resumptionDate"
                                        value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                        placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" required type="text"
                                        class="form-control" data-provide="phone" id="resumptionDate" readonly>
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Assumption date</label>
                                    <input name="assumptionDate" type="text"
                                        value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                        placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" class="form-control"
                                        data-provide="typeahead" id="assumptionDate" readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Termination Date</label>
                                    <input name="terminationDate"
                                        value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                        placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" type="text"
                                        class="form-control" data-provide="typeahead" id="terminationDate" readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Staff Level</label>
                                    <input name = "state" type="text" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffLevel'] : '' }}" class="form-control" data-provide="typeahead" id="state"  readonly>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Resumprion Type</label>
                                    <input name = "lga" type="text" value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['resumptionType'] : '' }}" class="form-control" data-provide="typeahead" id="lga"  readonly>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
		            
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->


                 <!-- Work Experiences Begin -->

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Work Experience
                        </a>
                    </li>
                </ul> 


                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                            <!-- Work Experience Details Ends-->
                            <div class="row">
                                
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
                                       @if(Session::has('workEducation') && Session::get('workEducation')['establishment_name'])
                                        <?php $counter = 1;?>
                                            @for ($i = 0; $i < sizeof(Session::get('workEducation')['establishment_name']); $i++)
                                            <tr>
                                                <td>{{$counter++}}</td>

                                                <td>
                                                    <input autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['establishment_name'][$i] : '' }}"
                                                        class="form-control underline" id="establishment_name" type="text"
                                                        name="establishment_name[]" readonly>
                                                </td>

                                                <td>
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['work_start_year'][$i] : '' }}"
                                                        class="form-control underline" id="work_start_year" type="text"
                                                        name="work_start_year[]" readonly>
                                                </td>

                                                <td>
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['work_end_year'][$i] : '' }}"
                                                        class="form-control underline" id="work_end_year" type="text"
                                                        name="work_end_year[]" readonly>
                                                </td>

                                                <td>
                                                    <input autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['position_held'][$i] : '' }}" class="form-control underline"
                                                        id="position_held" type="text" name="position_held[]" readonly>
                                                </td>

                                                <td>
                                                    <textarea autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['job_functions'][$i] : '' }}" class="form-control underline"
                                                        name="job_functions[]" id="" readonly></textarea>
                                                </td>

                                                <td></td>
                                            </tr>
                                            @endfor
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end row -->
                        
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->






                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Education Qualifications
                        </a>
                    </li>
                </ul> 


                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                        
                            <!-- Education Details Starts-->
                            <div class="row">
                                
                            <table class="table table-hover education">
                                    <thead>
                                        <tr>
                                            <td>S/N</td>
                                            <th>Education Type</th>
                                            <th>Start Year</th>
                                            <th>End Year</th>
                                            <th>Name of Institution</th>
                                            <th>Course/Certification</th>
                                            <th>Qualification</th>
                                            <th>Class</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(Session::has('workEducation'))
                                         <?php $counter = 1;?> 
                                            @for ($i = 0; $i < sizeof(Session::get('workEducation')['education_type_id']); $i++)
                                            <tr>

                                                <td>{{$counter++}}</td>
                                                <td>
                                                        <input autocomplete="off" value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_type_id'][$i] : '' }}"
                                                        class="form-control underline" id="g_name" type="text" name="g_name[]" readonly>
            

                                                </td>

                                                <td>
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['start_year'][$i] : '' }}"
                                                        class="form-control underline datepicker" id="start_year"
                                                        type="text" name="start_year[]" readonly>
                                                </td>

                                                <td>
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['end_year'][$i] : '' }}"
                                                        class="form-control underline datepicker" id="end_year" type="text"
                                                        name="end_year[]" readonly>
                                                </td>

                                                <td>
                                                    <input autocomplete="off" 
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['institution_name'][$i] : '' }}"
                                                        class="form-control underline" id="institution_name" type="text"
                                                        name="institution_name[]" readonly>
                                                </td>

                                                <td>
                                                    <input autocomplete="off" 
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['course_name'][$i] : '' }}"
                                                        id="course_name" type="text" name="course_name[]" readonly>
                                                </td>

                                                <td>
                                                <input autocomplete="off" 
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_qual_id'][$i] : '' }}"
                                                        id="course_name" type="text" name="course_name[]" readonly>
                                                    
                                                </td>

                                                <td>


                                                <input autocomplete="off" 
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_class_id'][$i] : '' }}"
                                                        id="course_name" type="text" name="course_name[]" readonly>
                                                    
                                                </td>

                                                <td></td>
                                            </tr>
                                            @endfor
                                    
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                            <div class="row" style="margin-top:10px">
                                <div class="row" style="margin-top:30px">
                                    <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                                        <button class="btn btn-primary" name="back" value="Back"
                                            id="submit">Back</button>
                                    </div>
                                    <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                                        <button class="btn btn-primary" name="proceed" value="Proceed"
                                            id="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
                <!-- end nav-->

                <!-- Work Experiences Ends -->

                <!-- company Information Ends -->

                <div class="row" style="margin-top:10px">
                    <div class="row" style="margin-top:30px">
                        <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                            <button class="btn btn-primary" name="back" value="Back"
                                id="submit">Back</button>
                        </div>
                        <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                            <button class="btn btn-primary" name="proceed" value="Proceed"
                                id="submit">Submit</button>
                        </div>
                    </div>
                </div>
                

            </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection


@section('script')
 
<script>
$(function () {

    let url = "{{url('api/get-states')}}";
    console.log('mymessage' + url);
    $.ajax({
        url: url,
        type: 'get',
        data: {level: '1'},

        success: function (data) {
            
            console.log('thisadata',data);
            $.each(data, function(key, states){
                console.log("CountryState", states);
                let option = `<option value="${states.name}"> ${states.name}</option>`;
                $("#state").append(option);
            });

            //Change the text of the default "loading" option.
            //$('#addons-select').removeClass('d-none').addClass('d-block')
            //$('#addon-loader').removeClass('d-block').addClass('d-none');
            //$('#submit').removeClass('d-none').addClass('d-block');


            console.log("response",data);
        },
        error: function (xhr, err) {
            var responseTitle= $(xhr.responseText).filter('title').get(0);
            alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
        }

    });


    $('#state').change(function () {
        let selectedState = $(this).val();
        console.log("thisIsMySelectedState",selectedState)

//        alert("The paragraph was clicked.");

        
        if (selectedState!==''){
            //$('#addon-loader').removeClass('d-none').addClass('d-block');
            //$('#submit').removeClass('d-block').addClass('d-none');
            // getAddon(code);


            let url = "{{url('api/get-lga')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: {state: selectedState},

                success: function (data) {
                    // $('#addons option:not(:first)').remove();
                    console.log('thisadata',data);
                    $.each(data, function(key, lga){
                        console.log("CountryState", lga);
                        let option = `<option value="${lga}"> ${lga}</option>`;
                        $("#lgas").append(option);
                    });


                },
                error: function (xhr, err) {
                    var responseTitle= $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
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

@endsection











