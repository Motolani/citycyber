 <div id="personalInfoForm"> 
<div"> 
    <!-- <div id="container" class="row form-group" style="margin-top: 20px"> -->
    <div id="container" class="row form-group" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-5">

                <div id="staff-container">
                    <img src="http://www.fao.org/fileadmin/templates/experts-feed-safety/images/profile-img03.jpg" id="profilepic" alt="Profile Photo" />
                    <label for="formFileSm" class="form-label">
                        Select a Staff Image.Only JPEG, PNG &amp;
                        GIF formats. Image should not be larger than 300 KB
                    </label>
                    <input onchange="loadFile(event)" class="form-control form-control-sm" id="formFileSm" type="file" name="imgUrl" />
                </div>

            </div>
            <div class="col-md-3">
                <label class="form-label">Staff Number</label>
                <span style="color:#ff0000">*</span>
                <input type="text" name="staff_number" class="form-control" {{-- value="{{Session::get('personalInfo')['staff_number'] ?? '' }}" --}}  value="{{ old('staff_number') }}" data-provide="typeahead" id="staffNumber" placeholder="Enter Staff Number ">
            </div>
            <!-- <div class="col-md-4">
                <label class="form-label">Resumption Date </label>
                <span style="color:#ff0000">*</span>
                <input type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['resumption_date']:'' }}" --}} value="" class="form-control" name="resumption_date" data-provide="datepicker" id="resumptionDate" data-date-container="#datepicker1">
            </div> ---->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <span style="color:#ff0000">*</span>
                <input type="text" name="firstName" class="form-control" {{-- value="{{Session::get('personalInfo')['firstName'] ?? '' }}" --}}  value="{{ old('firstName') }}"data-provide="typeahead" id="firstName" placeholder="First Name">
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input id="middleName" {{-- value="{{Session::get('personalInfo')['middleName'] ?? '' }}" --}} name="middleName" class="form-control" type="text"  value="{{ old('middleName') }}" placeholder="Middle Name">
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <span style="color:#ff0000">*</span>
                <input id="lastName" name="lastName" {{-- value="{{Session::get('personalInfo')['lastName'] ?? '' }}" --}}  value="{{ old('lastName') }}" class="form-control" type="text" placeholder="Last Name">
            </div>
        </div> <!-- end col -->

        <!-- end row -->

        <div class="col-lg-6 mt-3">
            <div class="mb-3">
                <label class="form-label">Residential Address</label>
                <span style="color:#ff0000">*</span>
                <input type="text" class="form-control" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['residentialAddress']:'' }}" --}} value="{{ old('residentialAddress') }}" data-provide="typeahead" id="prefetch" name="residentialAddress" value="" placeholder="please enter Residential Address">
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-3">
                <label class="form-label">Home Address</label>
                <span style="color:#ff0000">*</span>
                <input name="homeAddress" required type="text" class="form-control" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['homeAddress']:'' }}" --}}   value="{{ old('homeAddress')}}"data-provide="typeahead" id="homeAddress" value="" placeholder="Please enter Home Address" required>
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Phone</label>
                <span style="color:#ff0000">*</span>
                <input name="phone" required type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['phone']:'' }}" --}}  value="{{ old('phone') }}" class="form-control" data-provide="phone" id="phone" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Email</label>
                <span style="color:#ff0000">*</span>
                <input name="email" type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['email']:'' }}" --}} value="{{ old('email') }}"class="form-control" data-provide="typeahead" id="emailAdd" name="email" required>
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-6 mt-3">
            <label class="mb-1 fw-bold">
                Select State
                <span style="color:#ff0000">*</span>
            </label>
            <select id="state" class="form-control select select2" name="state" data-toggle="select" required  value="{{ old('state')}}">
                <option value="{{Session::get('personalInfo')['state'] ?? '' }}">
               
                    {{-- {{Session::has('personalInfo')?Session::get('personalInfo')['state']:'Select State'}} --}}
                </option>
            </select>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <p class="mb-1 fw-bold">
                Select Lga
                <span style="color:#ff0000">*</span>
            </p>
            <select id="lgas" class="form-control select select2" name="lga" data-toggle="select2">
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}" required   value="{{ old('lga') }}">
              
                    {{-- {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select Lga'}} --}} 
                </option>
            </select>
        </div> <!-- end col -->

        <div class="col-lg-4 mt-3">
            <div class="mb-3 position-relative" id="datepicker1">
                <label class="form-label">Date of Birth</label>
                <span style="color:#ff0000">*</span>
                <input type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['dob']:'' }}" --}}  value="{{ old('dob') }}" class="form-control" name="dob" data-provide="datepicker" id="d_o_b" data-date-container="#datepicker1">
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4 mt-3">
            <label for="example-date" class="form-label">Select Gender</label>
            <span style="color:#ff0000">*</span>
            <select id="gender" class="form-control select select2"   value="{{ old('gender')}}" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}" --}} name="gender" data-toggle="select2" required>
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}">
               
                    {{-- {{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'Select Gender' }} --}}
                </option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <div class="col-lg-4 mt-3">
            <label for="example-date" class="form-label">Select Marital Status</label>
            <span style="color:#ff0000">*</span>
            <select id="marital_status" class="form-control select2" name="maritalStatus"   value="{{ old('maritalStatus')}}" data-toggle="select2" required>
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:'Select Marital Status' }}">
               
                    {{-- {{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:'Select Marital Status' }} --}}
                </option>
                <option>Single</option>
                <option>Married</option>
                <option>Divorced</option>
            </select>
        </div> <!-- end col -->
        <!-- end col -->

        <!======next of kin======>


            <div class="row">
             <!--   <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of Kin Photo</label>
                        <input value="" name="nok_photo" type="file" class="form-control" id="nokPhoto" />
                    </div>
                </div>-->

                <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of Kin Name</label>
                        <span style="color:#ff0000">*</span>
                        <input value="" name="nextofkinName" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinName']:'' }}" --}}  value="{{ old('nextofkinName') }}" type="text" class="form-control" data-provide="typeahead"  id="nextofkinName" required>
                    </div>
                </div>

              <!--  <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of kin Relationship</label>
                        <span style="color:#ff0000">*</span>
                        <input value="" name="nextofkinRelationship" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}" --}}  value="{{ old('nextofkinRelationship') }}" type="text" class="form-control" data-provide="typeahead" id="nextOfkinRelation" required>
                    </div>
                </div>-->
                       
                <div class="col-lg-6 mt-3">
                    <div class="mb-0">

                        <label class="form-label">Next Of Kin Phone</label>
                        <span style="color:#ff0000">*</span>
                        <input value="" name="nextofkinPhone" type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinPhone']:'' }}" --}} value="{{ old('nextofkinPhone') }}" class="form-control" data-provide="typeahead" id="nextofkin_Phone" required>

                    </div>
                </div>

                <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of Kin Contact  Address</label>
                        <span style="color:#ff0000">*</span>
                        <input value="" name="nextofkinAddress" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinAddress']:'' }}" --}} value="{{ old('nextofkinAddress') }}"type="text" class="form-control" data-provide="typeahead" id="nextofkinAddress" required>

                    </div>
                </div>

               <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next Of Kin Phone Number</label>
                            <span style="color:#ff0000">*</span>
                            <input value="" name="emmergencyPhone" {{-- value="{{Session::get('personalInfo')['emmergencyPhone'] ?? '' }}" --}}  value="{{ old('emergencyPhone') }}"type="text" class="form-control" data-provide="typeahead" id="emmergencyPhone" required>

                    </div>
                </div>

                <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of kin Relationship</label>
                        <span style="color:#ff0000">*</span>                                                                                                   
                        <input value="" name="nextofkinRelationship" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}" --}} type="text" class="form-control" data-provide="typeahead" value="{{old('nextofkinRelationship')}}"id="nextOfkinRelation" required>
                    </div>
                </div> 
                <div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of Kin Photo</label>
                        <input value="" name="nok_photo" type="file" class="form-control" id="nokPhoto" />
                    </div>
                </div>
            
	    <!--<div class="col-lg-6 mt-3">
                    <div class="mb-0">
                        <label class="form-label">Next of kin Relationship</label>
                        <span style="color:#ff0000">*</span>
                       <input value="" name="nextofkinRelationship" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}" --}} type="text" class="form-control" data-provide="typeahead" id="nextOfkinRelation" required>
                    </div>
                </div>-->
  
                <!-- <div class="row">
                    <div class="col-lg-6 mt-3">
                        <div class="mb-0">
                            <label class="form-label">Next Of Kin Phone</label>
                            <span style="color:#ff0000">*</span>
                            <input value="" name="nextofkinPhone" type="text" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinPhone']:'' }}" --}} class="form-control" data-provide="typeahead" id="nextofkin_Phone" valur="{{('nextofkinPhone')}}" required>
                        </div>
                    </div> -->

               <!--     <div class="col-lg-6 mt-3">
                        <div class="mb-0">
                            <label class="form-label">Next of Kin Contact  Address</label>
                            <span style="color:#ff0000">*</span>
                            <input value="" name="nextofkinAddress" {{-- value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinAddress']:'' }}" --}} type="text" class="form-control" data-provide="typeahead" id="nextofkinAddress" vlaue="{{old('nextofkinAddress')}}" required>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                          <div class="col-lg-6 mt-3">
                            <div class="mb-0">
                                <label class="form-label">Emergency Address</label>
                                <span style="color:#ff0000">*</span>
                                <input value="" name="emergencyAddress" {{-- value="{{Session::get('personalInfo')['emergencyAddress'] ?? '' }}" --}} type="text" class="form-control" data-provide="typeahead" id="emmergencyAddress" value="{{old('emergencyAddress')}}" required>
                            </div>
                        </div>
                    <div class="col-lg-6 mt-3">
                        <div class="mb-0">
                            <label class="form-label">Emergency Phone</label>
                            <span style="color:#ff0000">*</span>
                            <input value="" name="emmergencyPhone" {{-- value="{{Session::get('personalInfo')['emmergencyPhone'] ?? '' }}" --}} type="text" class="form-control" data-provide="typeahead" id="emmergencyPhone" value="{{old('emergencyPhone')}}"  required >
                        </div>
                    </div>
                 
          
                    <!====== end of next of kin========>

                        <div class="row mt-3">
                            <div class="pull-right">
                                <button name="proceed" type="button" value="proceed" class="btn btn-primary" style="float: right;" id="proceedPersonal">Proceed</button>
                            </div>
                        </div>
                </div>
            </div>
    </div>
</div>


<script>
    // $("#newStaffForm").validate();
    jQuery().ready(function() {
        var v = jQuery("#newStaffForm").validate({
            rules: {
                staffNumber: {
                    required: true,
                    minlength: 4,
                },
                resumptionDate: {
                    required: true,
                },
                firstName: {
                    required: true,
                    minlength: 2,
                },
                lastName: {
                    required: true,
                    minlength: 2,
                    maxlength: 100,
                },
                // middleName: {
                //     required: true,
                // },
                residentialAddress: {
                    required: true,
                },
                homeAddress: {
                    required: true,
                },
                maritalStatus: {
                    required: true,
                },
                imgUrl: {
                    // required: true,
                },
                nok_photo: {
                    // required: true,
                },
                nextofkinName: {
                    required: true,
                },
                nextofkinRelationship: {
                    required: true,
                },
                nextofkinPhone: {
                    required: true,
                },
                nextofkinAddress: {
                    required: true,
                },
                emmergencyPhone: {
                    required: true,
                },
                emergencyAddress: {
                    required: true,
                },
            },
            errorElement: "span",
            errorClass: "help-inline",
        });

        $("#proceedPersonal").click(function(e) {
            if (v.form()) {
                $('.nav-tabs a[href="#company"]').tab('show');
            }
        });
    });
</script>
