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
                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Create Office</li>
                </ol>
            </div>
            <h4 class="page-title">Create Office</h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Creat an office
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <!-- <div id="erroMessage" class="alert alert-success">
            <p id="msg"> </p>
        </div>-->

        <form class="row g-3" method = "POST" action = "{{route('createOffice')}}">
   
            @csrf
            <div class="col-md-3 offset-9">
                <label class="form-label">Office Id</label>
                <input type="text" class="form-control" name="office_code" data-provide="typeahead" id="officeId" placeholder="">
            </div>
            <div class="col-md-6">
                <label class="form-label">Office Type</label>
                <span class="text-primary">pick office type then select office name<b>&#10230;</b></span>
                <select class="main form-control " name="type" data-toggle="select2" data-toggle="select2" id="level">
                    <!-- <option selected>--Select Ofice--</option> -->
                    <!-- <option value="head_office">HEAD OFFICE</option> -->
                    <option value="region">REGION</option>
                    <option value="area">AREA</option>
                    <option value="hub1">HUB1</option>
                    <option value="hub2">HUB2</option>
                    <option value="branchArea">BRANCH(AREA)</option>
                    <option value="branchHub1">BRANCH(HUB1)</option>
                    <option value="branchHub2">BRANCH(HUB2)</option>
                </select>


            </div>
            <div class="col-md-6 mt-auto">
                <!-- region -->

                <label class="form-label">Select REGION OFFICE</label>

                <!-- <input type="text" class="form-control" name="name" id="inputPassword4"> -->
                <select class="region form-control " name="name" data-toggle="select2" id="level">
                <option selected>--Select Office Name--</option>
                    @if(isset($getRegion))
                    @foreach($getRegion as $getReg)
                    <option value="{{$getReg->id}}|{{$getReg->name}}">{{$getReg->name}}</option>
                    @endforeach
                    @endif
                </select>
                <!-- area -->
                <label class="form-label">Select AREA OFFICE</label>
                <select class="area form-control" name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Area Name--</option>
                    @if(isset($getArea))
                    @foreach($getArea as $getAre)
                    <option value="{{$getAre->id}}|{{$getAre->name}}">{{$getAre->name}}</option>
                    @endforeach
                    @endif

                </select>
                <!-- hub1 -->
                <label class="form-label">Select HUB1 OFFICE</label>

                <select class="hub1 form-control " name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Hub1 Name--</option>
 
                    @if(isset($getHubOne))
                    @foreach($getHubOne as $getHubO)
                    <option value="{{$getHubO->id}}|{{$getHubO->name}}">{{$getHubO->name}}</option>
                    @endforeach
                    @endif

                </select>
                <!-- hub2 -->
                <label class="form-label">Select HUB2 OFFICE</label>

                <select class="hub2 form-control " name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Hub2 Name--</option>
                    <@if(isset($getHubTwo))
                     @foreach($getHubTwo as $getHubT) 
                     <option value="{{$getHubT->id}}|{{$getHubT->name}}">{{$getHubT->name}}</option>
                        @endforeach
                        @endif

                </select>
                <!-- branch -->
                <label class="form-label">Select BRANCH(AREA) OFFICE</label>

                <select class="branchArea form-control " name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Branch Area Name--</option>
                    @if(isset($getBranchArea)) @foreach($getBranchArea as $getBranchAre ) <option value="{{$getBranchAre->id}}|{{$getBranchAre->name}}">{{$getBranchAre->name}}</option>
                        @endforeach
                        @endif

                </select>
                <!-- branch -->
                <label class="form-label">Select BRANCH(HUB1) OFFICE</label>

                <select class="branchHub1 form-control " name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Branch Hub1 Name--</option>
                    @if(isset($getBranchHubOne)) 
                    
                    @foreach($getBranchHubOne as $getBranchHubO) 
                    <option value="{{$getBranchHubO->id}}|{{$getBranchHubO->name}}">{{$getBranchHubOne->name}}</option>
                        @endforeach
                        @endif

                </select>
                <!-- branch -->
                <label class="form-label">Select BRANCH(HUB2) OFFICE</label>

                <select class="branchHub2 form-control " name="name" data-toggle="select2" data-toggle="select2" id="level">
                <option selected>--Select Hub2 Name--</option>
                    @if(isset($getBranchHubTwo)) 
                    @foreach($getBranchHubTwo as $getBranchHubT) 
                    <option value="{{$getBranchHubT->id}}|{{$$getBranchHubT->name}}">{{$getBranchHubT->name}}</option>
                        @endforeach
                        @endif

                </select>


            </div>
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input required id="bloodhound" name="emailAddress" class="form-control" type="text" placeholder="email">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" data-provide="typeahead" id="prefetch" name="phone" placeholder="phone">
            </div>
            <!-- <div class="col-md-6">
                <label for="PhoneNumber2" class="form-label">Phone Number</label>
                <input type="number" class="form-control" name="phone_number" id="phone_number">
            </div> -->
            <!-- <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input name = "location" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="10 John str, Ipaja">
            </div> -->
            <div class="col-12">
                <label class="form-label">Address</label>
                <input name="location" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="10 John str, Ipaja">
            </div>
            <!-- <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div> -->
            <div class="col-md-4">
                <label class="form-label">Country</label>
                {{-- <input name = "country" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="Enter Country"> --}}

                <select name="country" class="form-control select2 country" data-toggle="select2">

                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{$country->id == 160 ? 'selected' : ''}}>{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">State</label>
                <select id="state" class="form-control select select2" name="state" data-toggle="select" required>
                    <option value="{{Session::get('personalInfo')['state'] ?? '' }}">
                        {{Session::has('personalInfo')?Session::get('personalInfo')['state']:'Select State'}}
                    </option>
                </select>
                {{-- <select name="state" class="form-control select2 state" data-toggle="select2">
                                        </select> --}}
            </div>
            <div class="col-md-4">
                <div class="mb-0">
                    <p class="mb-1 fw-bold">
                        Select City
                    </p>

                    <select id="lgas" class="form-control select select2" name="lga" data-toggle="select2">
                        <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}" required>
                            {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select Lga'}}
                        </option>
                    </select>
                    {{-- <select name="city" class="form-control select2 city" data-toggle="select2">
                                            </select> --}}
                </div>
            </div>

            <div style="justify-content:flex-end" class="col-md-3 offset-9">
            <button class="btn btn-primary" style="float: right;" id="submit">Submit</button>

            </div>
        </form>
    </div>
</div>


@endsection


@section('script')
<script>
    // ajax function to load a state
    let url = "{{url('api/get-states')}}";
    console.log('mymessage' + url);
    $.ajax({
        url: url,
        type: 'get',
        data: {
            level: '1'
        },

        success: function(data) {

            console.log('thisadata', data);
            $.each(data, function(key, states) {
                console.log("CountryState", states);
                let option = `<option value="${states.name}"> ${states.name}</option>`;
                $("#state").append(option);
            });

            console.log("response", data);
        },
        error: function(xhr, err) {
            var responseTitle = $(xhr.responseText).filter('title').get(0);
            alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
        }

    });
    // end of state javascript
    // ajax function for city
    $('#state').change(function() {
        let selectedState = $(this).val();
        console.log("thisIsMySelectedState", selectedState)

        if (selectedState !== '') {

            let url = "{{url('api/get-lga')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    state: selectedState
                },

                success: function(data) {
                    // $('#addons option:not(:first)').remove();
                    console.log('thisadata', data);
                    $.each(data, function(key, lga) {
                        console.log("CountryState", lga);
                        let option = `<option value="${lga}"> ${lga}</option>`;
                        $("#lgas").append(option);
                    });


                },
                error: function(xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });
        } else {
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#addons option:not(:first)').remove();

            $('#addons-select').removeClass('d-block').addClass('d-none')
            $('#submit').removeClass('d-block').addClass('d-none');
        }

    });




    // end of function for city

    $(".country").change(function() {
        var countryId = $(".country").val();
        var url = "/address/get-states-by-country/";

        $.ajax({
            url: url + countryId,
            type: 'get',
            success: function(response) {
                console.log(response);
                var d = response.data;
                var html = "";
                for (var i = 0; i < d.length; i++) {
                    html += "<option value='" + d[i].id + "' > " + d[i].name + " </option>";
                }
                $(".state").html(html);
            },
            error: function(xhr, err) {
                console.log(err);
            }

        });
    });

    $(".state").change(function() {
        var stateId = $(".state").val();
        var url = "/address/get-cities-by-state/";

        $.ajax({
            url: url + stateId,
            type: 'get',
            success: function(response) {
                console.log(response);
                var d = response.data;
                var html = "";
                for (var i = 0; i < d.length; i++) {
                    html += "<option value='" + d[i].id + "' > " + d[i].name + " </option>";
                }
                $(".city").html(html);
            },
            error: function(xhr, err) {
                console.log(err);
            }

        });
    });

    $(".main").change(function() {
        $("." + $(this).val()).show().siblings().not(".main").hide()
    }).trigger("change");
</script>

@endsection
