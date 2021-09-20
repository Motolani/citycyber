    <div id="container" class="row form-group" style="margin-top: 20px">
        <div class="col-md-4">
            <div id="staff-container">
                <img src="http://www.fao.org/fileadmin/templates/experts-feed-safety/images/profile-img03.jpg"
                     id="profilepic" alt="Profile Photo" />

                <label for="formFileSm" class="form-label">
                    Select a Staff Image.Only JPEG, PNG &amp;
                    GIF formats. Image should not be larger than 300 KB
                </label>
                <input onchange="loadFile(event)" class="form-control form-control-sm" id="formFileSm" type="file" required name="imgUrl"/>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="firstName" class="form-control"
                       value="{{Session::get('personalInfo')['firstName'] ?? '' }}" data-provide="typeahead" id="firstName" placeholder="First Name" required>
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input required id="middleName"
                       value="{{Session::get('personalInfo')['middleName'] ?? '' }}"
                       name="middleName" class="form-control" type="text"
                       placeholder="Middle Name">
            </div>
        </div> <!-- end col -->

        <div class="col-lg-4 mt-3">
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input required id="lastName" name="lastName"
                       value="{{Session::get('personalInfo')['lastName'] ?? '' }}"
                       class="form-control" type="text" placeholder="Last Name">
            </div>
        </div> <!-- end col -->

        <!-- end row -->

        <div class="col-lg-6 mt-3">
            <div class="mb-3">
                <label class="form-label">Residential Address</label>
                <input type="text" class="form-control"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['residentialAddress']:'' }}"
                       data-provide="typeahead" id="prefetch" name="residentialAddress"
                       placeholder="please enter Residential Address">
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-3">
                <label class="form-label">Home Address</label>
                <input name="homeAddress" required type="text" class="form-control"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['homeAddress']:'' }}"
                       data-provide="typeahead" id="homeAddress"
                       placeholder="Please enter Home Address" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Phone</label>
                <input name="phone" required type="text"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['phone']:'' }}"
                       class="form-control" data-provide="phone" id="phone" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Email</label>
                <input name="email" type="text"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['email']:'' }}"
                       class="form-control" data-provide="typeahead" id="email" name="email" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <label class="mb-1 fw-bold">
                Select State
            </label>

            <select id="state" class="form-control select select2" name="state" data-toggle="select" required>
                <option value="{{Session::get('personalInfo')['state'] ?? '' }}">
                    {{Session::has('personalInfo')?Session::get('personalInfo')['state']:'Select State'}}
                </option>
            </select>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <p class="mb-1 fw-bold">
                Select Lga
            </p>

            <select id="lgas" class="form-control select select2" name="lga" data-toggle="select2">
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}" required>
                    {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select Lga'}}
                </option>
            </select>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-3 position-relative" id="datepicker1">
                <label class="form-label">Date of Birth</label>
                <input type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['dob']:'' }}"
                       class="form-control" name="dob" data-provide="datepicker" data-date-container="#datepicker1">
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <label for="example-date" class="form-label">Select Gender</label>
            <select id="gender" class="form-control select select2" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}"
                    name="gender" data-toggle="select2" required>
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}">
                    {{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'Select Gender' }}
                </option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <!-- end col -->

        <div class="col-lg-6 mt-3">
            <label for="example-date" class="form-label">Select Marital Status</label>
            <select id="maritalStatus" class="form-control select2" name="maritalStatus" data-toggle="select2" required>
                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:'Select Marital Status' }}">
                    {{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:'Select Marital Status' }}
                </option>
                <option>Single</option>
                <option>Married</option>
                <option>Divorced</option>
            </select>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Photo</label>
                <input name="nok_photo" required type="file" class="form-control" id="nokPhoto" />
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Name</label>
                <input name="nextofkinName" value="{{Session::get('personalInfo')['nextofkinName'] ?? '' }}" required type="text" class="form-control" data-provide="phone" id="nextofkinName" />
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of kin Relationship</label>
                <input name="nextofkinRelationship" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}"
                       type="text" class="form-control" data-provide="typeahead" id="nextOfkinRelation" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next Of Kin Phone</label>
                <input name="nextofkinPhone" type="text"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinPhone']:'' }}"
                       class="form-control" data-provide="typeahead" id="multiple-ddatasets" required>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next of Kin Address</label>
                <input name="nextofkinAddress" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinAddress']:'' }}"
                       type="text" class="form-control" data-provide="typeahead" id="nextofkinAddress" required>
            </div>
        </div> <!-- end col -->


        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Next Of Kin Contact Address</label>
                <input name="nextofkinContact"
                       value="{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinContact']:'' }}"
                       required type="text" class="form-control" data-provide="phone"
                       id="nextofkin">
            </div>
        </div> <!-- end col -->


        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Emergency Phone</label>
                <input name="emmergencyPhone" value="{{Session::get('personalInfo')['emmergencyPhone'] ?? '' }}"
                       type="text" class="form-control" data-provide="typeahead" id="emmergencyPhone" required>
            </div>
        </div>
        <!-- end col -->

        <div class="col-lg-6 mt-3">
            <div class="mb-0">
                <label class="form-label">Emergency Address</label>
                <input name="emergencyAddress" value="{{Session::get('personalInfo')['emergencyAddress'] ?? '' }}"
                       type="text" class="form-control" data-provide="typeahead" id="emmergencyAddress" required>
            </div>
        </div>
        <!-- end col -->

        <div class="row mt-3">
            <div class="pull-right">
                <button name="proceed" value="proceed" class="btn btn-primary" style="float: right;" id="proceedPersonal">Proceed</button>
            </div>
        </div>
    </div>


<script>
    // $("#newStaffForm").validate();

    $("#proceedPersonal").click(function (e) {
        $('.nav-tabs a[href="#company"]').tab('show');
    });
</script>
