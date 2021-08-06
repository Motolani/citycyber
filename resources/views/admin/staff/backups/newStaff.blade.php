
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
		@if(isset($message))
                <div class="alert alert-success">
                {{ $message }}
                </div>
            	@endif

                <h4 class="header-title" style = "">Staff Management</h4>
                <p class="text-muted font-14">
                    Here if the first level where you can insert all personal staff's Information
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Personal Information 
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
		    <form method = "POST" action = "{{route('newStaff')}}">
			@csrf
                        
                      {{--dd(Session::get('personalInfo'))--}}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name = "firstName" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['firstName']:'' }}" data-provide="typeahead" id="the-basics" placeholder="First Name" required>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Middle Name</label>
                                    <input required id="middleName" value = "{{ Session::get('personalInfo')['middleName'] }}" name = "middleName" class="form-control" type="text" placeholder="Middle Name">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input required id="lastName" name = "lastName" value = "{{ Session::get('personalInfo')['lastName'] }}" class="form-control" type="text" placeholder="Last Name">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Residential Address</label>
                                    <input type="text" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['residentialAddress']:'' }}"  data-provide="typeahead" id="prefetch" name = "residentialAddress" placeholder="please enter Residential Address">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Home Address</label>
                                    <input name = "homeAddress" required type="text" class="form-control" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['homeAddress']:'' }}" data-provide="typeahead" id="homeAddress" placeholder="Please enter Home Address">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                         
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Phone</label>
                                    <input name = "phone" required type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['phone']:'' }}" class="form-control" data-provide="phone" id="phone">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Email</label>
                                    <input name = "email" type="text" value="{{ Session::has('personalInfo')?Session::get('personalInfo')['email']:'' }}" class="form-control" data-provide="typeahead" id="email" name = "email">
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        <div class="row">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select State
                                </p>
                                <select id = "state" class="form-control select" name = "state" data-toggle="select">
                                    <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['state']:'' }}"> {{Session::has('personalInfo')?Session::get('personalInfo')['state']:'Select State'}} </option>
                                    
                                </select>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select Lga
                                </p>
                                <select id = "lgas" class="form-control select" name = "lga" data-toggle="select">
                                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}"> {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select Lga'}} </option>
                                   
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label for="example-date" class="form-label">Date of Birth</label>
                                    <input class="form-control" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['dob']:'' }}" id="example-date" type="date" name="dob">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <label for="example-date" class="form-label">Select Gender</label>
                                <select id = "gender" class="form-control select2" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['gender']:'' }}" name = "gender" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-3 mt-lg-0">
                                <label for="example-date" class="form-label">Select Marital Status</label>
                                <select id = "maritalStatus" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['maritalStatus']:'Select Marital Status' }}" class="form-control select2" name = "maritalStatus" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <br/>



                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of Kin Name</label>
                                    <input name = "nextofkinName" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinName']:'' }}" required type="text" class="form-control" data-provide="phone" id="nextofkinName">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of kin Relationship</label>
                                    <input name = "nextofkinRelationship" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinRelationship']:'' }}" type="text" class="form-control" data-provide="typeahead" id="nextOfkinRelation">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next Of Kin Phone</label>
                                    <input name = "nextofkinPhone" type="text" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinPhone']:'' }}" class="form-control" data-provide="typeahead" id="multiple-ddatasets">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Next of Kin Address</label>
                                    <input name = "nextofkinAddress" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinAddress']:'' }}" type="text" class="form-control" data-provide="typeahead" id="nextofkinAddress" >
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Next Of Kin Contact Address</label>
                                    <input name = "nextofkinContact" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['nextofkinContact']:'' }}" required type="text" class="form-control" data-provide="phone" id="nextofkin">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Emmergency Phone</label>
                                    <input name = "emmergencyPhone" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['emmergencyPhone']:'' }}" type="text" class="form-control" data-provide="typeahead" id="emmergencyPhone">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Emergency Address</label>
                                    <input name = "emergencyAddress" value = "{{ Session::has('personalInfo')?Session::get('personalInfo')['emergencyAddress']:'' }}" type="text" class="form-control" data-provide="typeahead" id="emmergencyAddress">
                                </div>
                            </div> <!-- end col -->

                        </div>

                        <div class="row" style="margin-top:10px">


                            <div class="col-lg-6">
                                <div class="mb-0">

                                </div>
                            </div> <!-- end col -->


                            <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                <button name = "proceed" value = "proceed" class="btn btn-primary" style="float: right;" id="submit">Proceed</button>
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










