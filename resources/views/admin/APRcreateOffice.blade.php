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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Office</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Office</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-6" id = "first_card">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id = "erroMessage" class="alert alert-success">
                        <p id = "msg"> </p>
                    </div>


                    <h4 class="header-title" id = "headerShow">Create Office</h4>
                    <p class="text-muted font-14">
                        Here you can create Offices e.g(Hub,Hq,Branches,Areas etc)
                    </p>

                    <div id = "startCard" class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <div class="row">      
                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Select Office Type
                                    </p>
                                    <select class="form-control select2" name = "level" data-toggle="select2" data-toggle="select2" id="level">
                                        <option>Select Type</option>
                                        @if(isset($levels))
                                            @foreach($levels as  $level)
                                                <option value="{{$level->level}}|{{$level->name}}">{{$level->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div> <!-- end col -->
                                <div style="margin-top:43px;" class="col-lg-6">
                                    <button class="btn btn-primary" style="" name="getParents" id="getParents">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Create Office</h4>
                    <p class="text-muted font-14">
                        Here you can create Offices e.g(Hub,Hq,Branches,Areas etc)
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('createOffice')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <p class="mb-1 fw-bold text-muted"></p>
                                        <label class="form-label">
                                            Office ID
                                        </label>
                                        <input type="text" class="form-control" name="officeCode" data-provide="typeahead" id="officeId" placeholder="">
                                    </div>

                                    <div class="col-lg-6 mt-3 mt-lg-1">
                                        <label class="form-label">
					    <!--Select <span id="selectedParentOffice"></span> Office-->
                                             Select Parent Office
                                        </label>
                                        <select id = "types" class="form-control select2" data-toggle="select2">
                                            <option>Select</option>
                                        </select>
                                    </div> <!-- end col -->


                                    <div class="col-lg-6 mt-3">
                                        <label class="form-label">
                                            Office type
                                        </label>
                                        <input value="" type = "hidden" name = "officeLevel" id = "officeLevel"/>
                                        <input type="text" class="form-control" name = "officeType" data-provide="typeahead" value = "" readonly id="officeType" placeholder="">
                                    </div> <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name = "name" class="form-control" data-provide="typeahead" id="the-basics" placeholder="name" required value="{{old('name')}}">
                                        </div>
				    </div> <!-- end col -->
                                     <!-- REGION div to hid and show based on selection -->
                                <div class="region_acronym" id="see_region" style="display:none">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 ">
                                                <label class="form-label">Region Acronym</label>
                                                <input type="text" class="form-control" name="region_acronym" value="{{old('region_acronym')}}" id="" placeholder="" required>                                           </div>
                                        </div> <!-- end col -->
                                    </div>

                                </div>
                                <!-- div to hid and show based on selection -->
                                <!-- AREA div to hid and show based on selection -->
                                <div class="area_acronym" id="see_area" style="display: none;"> 
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Area Acronym</label>
                                                <input type="text" class="form-control" name="area_acronym" value="{{old('area_acronym')}}" id="" placeholder="" required>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                </div>
                                <!-- div to hid and show based on selection -->

                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
					    <!--<input required id="bloodhound" name = "email" class="form-control" type="text" placeholder="email">-->
                                             <input required id="bloodhound" name="emailAddress" class="form-control" type="text" placeholder="email" value="{{old('emailAddress')}}" >
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" data-provide="typeahead" id="prefetch" name = "phone" placeholder="phone"value="{{old('phone')}}" >
                                        </div>
				    </div> <!-- end col -->
                                      <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Second Phone</label>
                                        <input type="number" class="form-control" data-provide="typeahead" id="prefetch" name="phone_number" placeholder="phone" value="{{old('phone')}}">
                                    </div>
                                </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input name = "location" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="10 John str, Ipaja" value="{{old('location ')}}">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-4">
                                            <label class="form-label">Country</label>
                                            {{-- <input name = "country" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="Enter Country"> --}}
                                           
                                            <select name="country" class="form-control select2 country" data-toggle="select2">
                                           
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}" {{$country->id == 160 ? 'selected' : ''}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <label class="form-label">State</label>
                                        <select id="state" class="form-control select select2" name="state" data-toggle="select" required>
                                            <option value="{{Session::get('personalInfo')['state'] ?? '' }}">
                                                {{Session::has('personalInfo')?Session::get('personalInfo')['state']:'Select State'}}
                                            </option>
                                        </select>
                                        {{-- <select name="state" class="form-control select2 state" data-toggle="select2">
                                        </select> --}}
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <p class="mb-1 fw-bold">
                                                Select City
                                            </p>
                                
                                            <select id="lgas" class="form-control select select2" name="lga" data-toggle="select2">
                                                <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}" required>
                                                    {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select City'}}
                                                </option>
                                            </select>
                                            {{-- <select name="city" class="form-control select2 city" data-toggle="select2">
                                            </select> --}}
                                        </div>
                                    </div> <!-- end col -->

{{--                                    <div class="col-lg-3">--}}
{{--                                        <div class="mb-0">--}}
{{--                                            <label class="form-label">LGA</label>--}}
{{--                                            <input name="lga" required type="text" class="form-control" data-provide="typeahead">--}}
{{--                                        </div>--}}
{{--                                    </div> <!-- end col -->--}}


                                    <div class="col-lg-6">
                                        <div class="mb-0">

                                        </div>
                                    </div> <!-- end col -->
                                       <!--branch office form   -->
                                <div class="branch-office " style="display: none;">
                                    <div class="row g-3">
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Bet9ja Code</label>
                                    <input type="text" name="bet_code" class="form-control @error('bet_code') is-invalid @enderror" placeholder="bet9ja code " required>
                                        </div>
                                        @error('bet_code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Bet9ja Id</label>
                                            <input type="text" name="bet_id" class="form-control @error('bet_id') is-invalid @enderror" placeholder="bet9ja id"required>
                                        </div>
                                        @error('bet_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12" py-2>
                                            <label class="form-label">Branch Report To</label>
                                            <select name="branch_report" id="branch_report" class="form-control select2 @error('branch_report') is-invalid @enderror" data-toggle="select2" required>
                                                <option>Select</option>
                                            </select>
                                            @error('branch_report')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Landlord Name</label>
                                            <input type="text" name="land_name" class="form-control @error('land_lord') is-invalid @enderror" placeholder="landlord name "required>
                                        </div>
                                        @error('land_lord')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Landlord Phone</label>
                                            <input type="number" name="land_phone" class="form-control @error('land_phone') is-invalid @enderror" placeholder="landlord phone">
                                        </div>
                                        @error('land_phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Landlord Email</label>
                                            <input type="email" name="land_email" class="form-control @error('land_email') is-invalid @enderror" placeholder="landlord email" required>
                                        </div>
                                        @error('land_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Caretaker Name</label>
                                            <input type="text" name="care_name" class="form-control @error('care_name') is-invalid @enderror"  placeholder="caretaker name" required>
                                        </div>
                                        @error('care_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Caretaker Phone</label>
                                            <input type="number" name="care_phone" class="form-control @error('care_phone') is-invalid @enderror" placeholder="caretaker phone" required>
                                        </div>
                                        @error('care_phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="col-md-6 py-2">
                                            <label class="form-label">Caretaker Email</label>
                                            <input type="email" name="care_email" class="form-control @error('care_email') is-invalid @enderror" placeholder="caretaker email" required>
                                        </div>
                                        @error('care_email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--branch office form end   -->
                                   <div style="justify-content:flex-end" class="col-lg-12 pull-right mt-3">
                                    <button class="btn btn-primary w-100" style="float: right;" id="submit">Submit</button>
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
            $(document).ready(function(){
                let aa =$('#h_div');
                let message = $('#erroMessage');
                message.hide();
                console.log("h_div logger ----",aa);
                aa.hide();
                $("#hide").click(function(){
                    $("div").hide();
                });
// ajax function to load a state
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

                    console.log("response", data);
                },
                error: function (xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });
// end of state javascript


                $(".country").change(function () {
                    var countryId = $(".country").val();
                    var url = "/address/get-states-by-country/";

                    $.ajax({
                        url: url+countryId,
                        type: 'get',
                        success: function (response) {
                            console.log(response);
                            var d = response.data;
                            var html ="";
                            for(var i =0; i<d.length; i++) {
                                html += "<option value='"+d[i].id+"' > "+d[i].name+" </option>";
                            }
                            $("#state").html(html);
                        },
                        error: function (xhr, err) {
                            console.log(err);
                        }

                    });
                });

                $("#state")i.change(function () {
                    var stateId = $("#state").val();
                    var url = "/address/get-cities-by-state/";
                    
                    $.ajax({
                        url: url+stateId,
                       type: 'get',
                        success: function (response) {
                          console.log(response);
                            var d = response.data;
                            var html ="";
                            for(var i =0; i<d.length; i++) {
                                html += "<option value='"+d[i].id+"' > "+d[i].name+" </option>";
                           }
			    $("#lgas").html(html);
			     console.log('lgas',response);
                         },
                        error: function (xhr, err) {
                            console.log(err);
                        }

                    });
	     });
	           
            
                       



                $("#getParents").click(function(){
                    let header = $('headerShow');
                    let level_id = $(this).val();

                    let levels = $('#level').val();
                    //Set value of the select label
                    $("#selectedParentOffice").html($( "#level option:selected" ).text());
                    let level = levels.split('|', 1)[0];
		    let levelName = levels.split('|', 2)[1];
		    //console.log('akinlevel',level)
                if (level == "2") {
                    $("#see_region").show() //show region form
                    $("#see_area").hide();
                }
                if (level == "3") {
                    $("#see_region").hide() //show region form
                    $("#see_area").show();
		}
	        if (level == "6") {
                    $(".branch-office").show() //branch office(area) 
                    
                }
                if (level == "7") {
                    $(".branch-office").show() //show branch office(hub1) 
                    $("#see_region").hide() //show region form
                    $("#see_area").hide()
                }
                if (level == "8") {
                    $(".branch-office").show() //show branch office(hub1) 
                    $("#see_region").hide() //show region form
                    $("#see_area").hide()
                }
                    $("#officeType").val(levelName);
                    $("#officeLevel").val(level);
                    console.log("level_iddddPhil",level);
                    getParent(level);

                });
            });

            function getParent(level_id) {
                let url = "{{url('api/loadParent')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {level: level_id},

                    success: function (response) {
                        console.log("dataGOtenn",response)
                        //$('#addons option:not(:first)').remove();
                        return loadParent(response);

                        console.log("response",data);
                    },
                    error: function (xhr, err) {
                        var responseTitle= $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
                    }

                });

            }
            function loadParent(response) {

                console.log('thisadata',response.status);
                // return;
                // let data  = JSON.parse(response.data);
                let data  = response;
                let status = data.status;

                console.log("statusBelowCheck",data);
                if(status == "200"){

                    let aa =$('#h_div');
                    let startcad = $('#first_card');

                    console.log("h_div loggererere ----",aa);
                    aa.show();$('#first_cardB').hide();
                    startcad.hide();
                    $.each(data.data, function(key, lev){
                        console.log("level", lev);
                        let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.name}</option>`;
                        $("#types").append(option);
                    });

                }else{
                    let message = $('#erroMessage');
                    let ms = data.message;
                    console.log('myMessageResponseisHere',data)
                    $("#msg").append(ms)
;
                    message.show();
                }
                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }

        });
    </script>

@endsection
