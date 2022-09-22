@extends('admin.layout')
@section('title')
Dashboard
@endsection
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Profile</h4>
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-sm-12">
        <!-- Profile -->
        <div class="card bg-primary">
            <div class="card-body profile-user-box">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="avatar-lg">
                                    <img src="{{$office->getDefaultPhotoPath()}}" style="height: 100px; width:100px;" alt="" class="rounded-circle img-thumbnail">
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <h4 class="mt-1 mb-1 text-white">{{$office->name}}</h4>
                                    <ul class="mb-0 list-inline text-light">
                                        <li class="list-inline-item me-3">
                                            <p class="mb-0 font-13 text-white-50"> {{isset($office)? $office->location:''}}</p>
                                        </li>
                                        {{-- <li class="list-inline-item">--}}
                                        {{-- <h5 class="mb-1">Parent Office</h5>--}}
                                        {{-- <p class="mb-0 font-13 text-white-50">{{isset($office)? $office->type:''}} </p>--}}
                                        {{-- </li>--}}
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end col-->

                    <div class="col-sm-4">
                        <div class="text-center mt-sm-0 mt-3 text-sm-end">
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#top-modal">
                                <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                            </button>
                        </div>
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end card-body/ profile-user-box-->
        </div>
        <!--end profile/ card -->
    </div> <!-- end col-->
</div>
<!-- end row -->

<div class="row">
    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-user float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Total Staff</h6>
                <h2 class="m-b-20"><a href="#" data-bs-target="#all-staff-modal" data-bs-toggle="modal"> {{$office->staffs_count}} </a></h2>
                <!-- <span class="badge bg-primary"> +11% </span> <span class="text-muted">From previous period</span> -->
            </div> <!-- end card-body-->
        </div>
        <!--end card-->
    </div><!-- end col -->

    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-box float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Staffs On Leave</h6>

                <h2 class="m-b-20">
                    @if(count($staffsOnLeave) > 0)
                    <a href="#" data-bs-target="#staff-leave-modal" data-bs-toggle="modal">{{count($staffsOnLeave)}}</a>
                    @else
                    <span>{{count($staffsOnLeave)}}</span>
                    @endif
                </h2>
                <!-- <span class="badge bg-primary"> +89% </span> <span class="text-muted">Last year</span> -->
            </div> <!-- end card-body-->
        </div>
        <!--end card-->
    </div><!-- end col -->

    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-user float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Staff Absent</h6>
                <h2 class="m-b-20">{{$staffAbsent ?? 0}}</h2>
            </div> <!-- end card-body-->
        </div>
        <!--end card-->
    </div>

    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-jewel float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Balance</h6>
                <h2 class="m-b-20">₦<span>{{$office->shopWallet->balance ?? "No Wallet"}}</span></h2>
                <input type="hidden" id="level_id" value="{{$office->level}}" />
                <!-- <span class="badge bg-danger"> -29% </span> <span class="text-muted">From previous period</span> -->
            </div> <!-- end card-body-->
        </div>
        <!--end card-->
    </div><!-- end col -->

    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-jewel float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Stock</h6>
                <h2 class="m-b-20">
                    <a href="{{route('office.viewStocks', $office->id)}}">{{$stockCount}}</a>
                </h2>
            </div>
        </div>
    </div>


    <div class="col-sm-3">
        <div class="card tilebox-one">
            <div class="card-body">
                <i class="dripicons-jewel float-end text-muted"></i>
                <h6 class="text-muted text-uppercase mt-0">Debts</h6>
                <h2 class="m-b-20">
                    {{$debts}}
                </h2>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-xl-4 max-height">
        <!-- End Toll free number box-->
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Head Of Departments</h4>
                @if(isset($departments))
                <table class="table table-borderless table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Department </th>
                            <th>HOD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$department->title}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <!-- end inbox-widget -->
            </div> <!-- end card-body-->
        </div>
    </div>
    <div class="col-xl-8">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#basic" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#photos" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                PHOTOS
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="aboutme">
                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                Additional Info</h5>
                            <!-- end timeline -->

                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title </th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{$office->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Manager</td>
                                            <td>{{$office->manager->name ?? 'none'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email Address</td>
                                            <td>{{$office->emailAddress}}</td>
                                        </tr>
                                        <tr>
                                            <td>Office Phone</td>
                                            <td>{{$office->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{$office->location}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{$office->status == 0 ? "Active" : "Inactive"}}</td>
                                        </tr>
                                        {{-- <tr>--}}
                                        {{-- <td>Parent Office</td>--}}
                                        {{-- <td>{{$office->parent}}</td>--}}
                                        {{-- </tr>--}}
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane" id="photos">
                            <div class="table-responsive">
                                <a href="{{route('viewAddPhotos', ['officeid'=>$office->id])}}" value="edit" class="btn btn-primary btn-sm mt-1 mb-4">
                                    Add more Photos
                                </a>
                                <div class="photos">
                                    @include('admin.includes.photo-gallery')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($stocks) > 0)
    <div class="col-xl-4">
        <!-- End Toll free number box-->
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Stocks Due for Payment</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Due on</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $stock)
                        <tr>
                            <td> {{$stock->item->name}} </td>
                            <td> {{$stock->due_date}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="tab-content">
    <div class="tab-pane show active" id="modal-position-preview">
        <!-- Top modal content -->
        <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="topModalLabel">Edit Office</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="ps-3 pe-3" action="{{url('updateOffice')}}" method="post">
                        @csrf
                        <div class="modal-body">


                            <div class="mb-3">
                                <label for="username" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{isset($office)? $office->name:''}}" required="" placeholder="Office Name">
                            </div>

                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" name="emailAddress" value="{{isset($office)? $office->emailAddress:''}}" required="" placeholder="john@deo.com">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">phone</label>
                                <input class="form-control" type="text" name="phone" value="{{isset($office)? $office->phone:''}}" required="" id="phone" placeholder="Enter Phone">
                            </div>


                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Address </label>
                                <input class="form-control" type="text" name="address" value="{{isset($office)? $office->location:''}}" required="" placeholder="Enter Address">
                            </div>

                            @if ($office->level =="2")
                            <!-- REGION div to hid and show based on selection -->
                            <div class="region_acronym" id="see_region">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 ">
                                            <label class="form-label">Region Acronym </label>
                                            <input type="text" class="form-control" name="region_acronym" id="region_acronym" value="{{isset($office)? $office->region_acronym:''}}" id="" placeholder="enter region acronym" required autocomplete="off">
                                            <small class="error" id="regionErr"></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                            </div>
                            <!-- div to hid and show based on selection -->
                            <!-- @dd($office); -->
                            @elseif ($office->level =="3")
                            <!-- AREA div to hid and show based on selection -->
                            <div class="area_acronym" id="see_area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Area Acronym </label>
                                            <input type="text" class="form-control" name="area_acronym" id="area_acronym" value="{{isset($office)? $office->area_acronym:''}}" id="" placeholder="enter area acronym" required autocomplete="off">
                                            <small class="error" id="areaErr"></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                            </div>
                            <!-- div to hid and show based on selection -->
                            @else
                            <div class="branch-office ">
                                <div class="row g-3">
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Bet9ja Code</label>
                                        <input type="text" name="bet_code" id="bet_code" value="{{isset($office)? $office->bet_code:''}}" class="form-control @error('bet_code') is-invalid @enderror" placeholder="bet9ja code" required autocomplete="off">
                                        <small class="error" id="betCodeErr"></small>
                                    </div>
                                    @error('bet_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Bet9ja Id</label>
                                        <input type="text" name="bet_id" id="bet_id" value="{{isset($office)? $office->bet_id:''}}" class="form-control @error('bet_id') is-invalid @enderror" placeholder="bet9ja id" required autocomplete="off">
                                        <small class="error" id="betIdErr"></small>
                                    </div>
                                    @error('bet_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Branch Report To</label>
                                        <select id="report" class="form-control select2" data-toggle="select2" required>
                                            <option value="">--Select--</option>
                                        </select>

                                        @error('branch_report')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="error" id="branchRepoErr"></small>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Landlord Name</label>
                                        <input type="text" name="land_name" id="land_name" value="{{isset($office)? $office->bet_id:''}}" class="form-control @error('land_name') is-invalid @enderror" placeholder="landlord name " required autocomplete="off">
                                        <small class="error" id="landNameErr"></small>
                                    </div>
                                    @error('land_lord')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Landlord Phone</label>
                                        <input type="number" name="land_phone" id="land_phone" value="{{isset($office)? $office->land_phone:''}}" class="form-control @error('land_phone') is-invalid @enderror" placeholder="landlord phone" required autocomplete="off">
                                        <small class="error" id="landPhoneErr"></small>
                                    </div>
                                    @error('land_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Landlord Email</label>
                                        <input type="email" name="land_email" id="land_email" value="{{isset($office)? $office->land_email:''}}" class="form-control @error('land_email') is-invalid @enderror" placeholder="landlord email" required autocomplete="off">
                                        <small class="error" id="landEmailErr"></small>
                                    </div>
                                    @error('land_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Caretaker Name</label>
                                        <input type="text" name="care_name" id="care_name" value="{{isset($office)? $office->care_name:''}}" class="form-control @error('care_name') is-invalid @enderror" placeholder="caretaker name" required autocomplete="off">
                                        <small class="error" id="careNameErr"></small>
                                    </div>
                                    @error('care_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Caretaker Phone</label>
                                        <input type="number" name="care_phone" id="care_phone" value="{{isset($office)? $office->care_phone:''}}" class="form-control @error('care_phone') is-invalid @enderror" placeholder="caretaker phone">
                                        <small class="error" id="carePhoneErr"></small>
                                    </div>
                                    @error('care_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-md-6 py-2">
                                        <label class="form-label">Caretaker Email</label>
                                        <input type="email" name="care_email" id="care_email" value="{{isset($office)? $office->care_email:''}}" class="form-control @error('care_email') is-invalid @enderror" placeholder="caretaker email" required autocomplete="off">
                                        <small class="error" id="careEmailErr"></small>
                                    </div>
                                    @error('care_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif


                            <input class="form-control" type="hidden" id="officeType" value="{{isset($level)? $level->id:''}}">
                            <input class="form-control" type="hidden" id="level" value="{{isset($office)? $office->level:''}}">
                            <input class="form-control" type="hidden" name="id" value="{{isset($office)? $office->id:''}}" required="" placeholder="john@deo.com">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end preview-->
</div> <!-- end tab-content-->

<div id="all-staff-modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="topModalLabel">All Staff</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($office->staffs as $staff)
                <div class="mb-2">
                    <h4><a href="{{route('viewStaffProfile', ['user_id'=>$staff->id])}}"> {{$staff->firstname}} </a></h4>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="staff-leave-modal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-top">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="topModalLabel">Staffs on Leave</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($staffsOnLeave as $staff)
                <div class="mb-2">
                    <h4>{{$staff->name}}</h4>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
    $(function() {
        $(document).ready(function() {
            // alert('hyhyh')
            let aa = $('#h_div');
            console.log("h_div logger ----", aa);
            aa.hide();
            $("#hide").click(function() {
                $("div").hide();
            });

            let level_id = $('#level_id').val();
            getParents(level_id)


            $("#getParents").click(function() {
                let header = $('headerShow');
                let level_id = $(this).val();


                let levels = $('#level').val();
                let level = levels.split('|', 1)[0];
                let levelName = levels.split('|', 2)[1];
                $("#officeType").val(levelName);

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



                //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                $("#parentOfficeId").val(level);
                console.log("level_iddddPhil", level);
                getParent(level);



                //$("#kdd").html(total);
                //$("div").show();
            });
        });

        function getParents(level_id) {
            let url = "{{url('api/loadParent')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    level: level_id
                },

                success: function(data) {
                    //$('#addons option:not(:first)').remove();
                    loadParent(data);

                    console.log("response", data);
                },
                error: function(xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });

        }

        function loadParent(data) {
            console.log('thisadata', data);
            let aa = $('#h_div');
            let startcad = $('#first_card');

            console.log("h_div loggererere ----", aa);
            aa.show();
            $('#first_cardB').hide();
            startcad.hide();
            $.each(data.data, function(key, lev) {
                console.log("level", lev);
                let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.name}</option>`;
                // $("#types").append(option);
                $("#report").append(option);
                // $("#myreport").append(option);
                console.log('okok', 'report');



            });


            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }



    });
</script>

@endsection