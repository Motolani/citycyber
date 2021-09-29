@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')

    @if(count($docsNotUploaded))
        <div class="alert alert-danger mt-3">
            This staff has not uploaded the following documents.
            <ol>
            @foreach($docsNotUploaded as $docs)
                <li>{{$docs->name}}</li>
            @endforeach
            </ol>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CityCyber</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Staff Profile</h4>
            </div>
        </div>
    </div>
    <!-- end page ti<tl-->

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    @if(isset($staff->imgUrl) && strpos($staff->imgUrl, "data") !== false)
                        <img width="200" height="200" src="{{$staff->imgUrl}}" class="rounded-circle avatar-lg " alt="profile-image">
                    @else
                        <img width="200" height="200" src='https://via.placeholder.com/200x200?text=Profile+Pictures' class="rounded-circle avatar-lg " alt="profile-image">
                    @endif

                    <h4 class="mb-0 mt-2">{{isset($staff->firstname)?$staff->firstname." ". $staff->lastname:"nill"}}</h4>
                    <p class="text-muted font-14">{{isset($staff->departmentrole)?$staff->departmentrole: "nill"}}</p>

                    <!-- <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                    <button type="button" class="btn btn-danger btn-sm mb-2">Message</button> -->

                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">About User :</h4>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">{{isset($staff->phone)?$staff->phone:'Nill'}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">{{isset($staff->email)?$staff->email:'Nill'}}</span></p>

                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">{{isset($staff->state)?$staff->state:'Nill'}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Branch :</strong> <span class="ms-2 ">{{isset($staff->state)?$staff->state:'Nill'}}</span></p>

                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">{{isset($staff->state)?$staff->state:'Nill'}}</span></p>
                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <form method="get" action="{{url('viewCreateIncidence')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{isset($staff->id)?$staff->id:''}}">

                                    <button class="btn btn-primary btn-sm" style="width: 100%;"><span class="uil-eye"></span>View/Create Incidence</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <form method="get" action="{{url('viewCreateBonus')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{isset($staff->id)?$staff->id:''}}">

                                    <button class="btn btn-primary btn-sm" style="width: 100%;"><span class="uil-eye"></span>View/Create Bonus</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <form method="get" action="{{url('viewCreateSuspension')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{isset($staff->id)?$staff->id:''}}">

                                    <button class="btn btn-primary btn-sm" style="width: 100%;"><span class="uil-eye"></span>View/Create Suspension</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#aboutme" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#jobdetails" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Job Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#accountDetails" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Account Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#emmergencyContact" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                Emergency Contact
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#emmergencyContact" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                Next Of Kin Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#staffDocument" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Documents
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
                                        <td>Birthday</td>
                                        <td>{{isset($staff->DOB)?$staff->DOB:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Gender</td>
                                        <td>{{isset($staff->gender)?$staff->gender:'Nill'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Marital Status</td>
                                        <td>{{isset($staff->maritalstatus)?$staff->maritalstatus:'Nill'}}</td>
                                    </tr>

                                    <!-- <tr>
                                        
                                        <td>Spouse Phone</td>
                                        <td>07035666498</td>
                                    </tr> -->

                                    <tr>
                                        <td>State of Origin</td>
                                        <td>{{isset($staff->state)?$staff->state:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>LGA</td>
                                        <td>{{isset($staff->lga)?$staff->lga:'Nill'}}</td>
                                    </tr>



                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="jobdetails">

                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                Job Details</h5>
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
                                        <td>Status</td>
                                        <td>{{isset($staff->status)?$staff->status:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Branch</td>
                                        <td>{{isset($staff->branchId)?$staff->branchId:'Nill'}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Branch Address</td>
                                        <td>32 Summit Road, Asaba, Delta State</td>
                                    </tr> -->
                                    <!-- <tr>
                                        
                                        <td>Branch Type</td>
                                        <td>  </td>
                                    </tr> -->
                                    <!-- <tr>
                                        
                                        <td>Branch Region</td>
                                        <td>25/05/2021</td>
                                    </tr> -->

                                    <!-- <tr>
                                        <td>Branch Area</td>
                                        <td></td>
                                    </tr> -->
                                    <tr>

                                        <td>Role</td>
                                        <td>{{isset($staff->departmentrole)?$staff->departmentrole:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Level</td>
                                        <td>{{isset($staff->level)?$staff->level:'Nill'}}</td>
                                    </tr>



                                    <tr>

                                        <td>Resumption Type</td>
                                        <td>{{isset($staff->resumptionType)?$staff->resumptionType:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>View Scope</td>
                                        <td>{{isset($staff->departmentrole)?$staff->departmentrole:'Nill'}}</td>
                                    </tr>

                                    <tr>
                                        <td>Department</td>
                                        <td>{{isset($staff->department)?$staff->department:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Unit</td>
                                        <td>{{isset($staff->unit)?$staff->unit:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Resumption Date</td>
                                        <td>{{isset($staff->resumptionDate)?$staff->resumptionDate:'Nill'}}</td>
                                    </tr>





                                    <!-- <tr>
                                        
                                        <td>Assumption Date</td>
                                        <td>NIL</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Termination Date</td>
                                        <td>NIL</td>
                                    </tr> -->


                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="accountDetails">

                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                Account Details</h5>
                            <!-- end timeline -->

                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>

                                        <th>Account Name </th>
                                        <th>{{isset($staffBankAcc->acc_name)?$staffBankAcc->acc_name:'Nill'}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>{{isset($staffBankAcc->bankname)?$staffBankAcc->bankname:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Account Number</td>
                                        <td>{{isset($staffBankAcc->acc_num)?$staffBankAcc->acc_num:'Nill'}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Account Type</td>
                                        <td>Savings</td>
                                    </tr> -->

                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="emmergencyContact">

                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                EMERGENCY CONTACT</h5>
                            <!-- end timeline -->

                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>

                                        <th>Name </th>
                                        <th>{{isset($emmergencyContact->name)?$emmergencyContact->name:'Nill'}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{isset($emmergencyContact->phone)?$emmergencyContact->phone:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Address</td>
                                        <td>{{isset($emmergencyContact->address)?$emmergencyContact->address:'Nill'}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="nextOfKinInfo">

                            <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                                Next Of Kin </h5>
                            <!-- end timeline -->

                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap mb-0">
                                    <thead class="table-light">
                                    <tr>

                                        <th>Name </th>
                                        <th>{{isset($nextOfKin->name)?$nextOfKin->name:'Nill'}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Relationship</td>
                                        <td>{{isset($nextOfKin->relationship)?$nextOfKin->relationship:'Nill'}}</td>
                                    </tr>
                                    <tr>

                                        <td>Address</td>
                                        <td>{{isset($nextOfKin->address)?$nextOfKin->address:'Nill'}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form>
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Enter last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="userbio" class="form-label">Bio</label>
                                            <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                            <span class="form-text text-muted"><small>If you want to change email please <a href="javascript: void(0);">click</a> here.</small></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                            <span class="form-text text-muted"><small>If you want to change password please <a href="javascript: void(0);">click</a> here.</small></span>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="companyname" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="companyname" placeholder="Enter company name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cwebsite" class="form-label">Website</label>
                                            <input type="text" class="form-control" id="cwebsite" placeholder="Enter website url">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>
                        </div> <!-- end tab-pane -->

                        <div class="tab-pane" id="staffDocument">
                            <form action="{{url('uploaddocs')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="requireddocuments" value="{{json_encode($docsNotUploaded)}}" />
                                <input type="hidden" name="staffid" value="{{$staff->id}}" />
                                <input type="hidden" name="levelid" value="{{$staff->level}}" />

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Staff Documents</h5>
                                <div class="row">
                                    @if(count($docsNotUploaded) > 0)
                                        @foreach($docsNotUploaded as $document)
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">{{$document->name}}</label>
                                                    <input name="doc{{$document->id}}" onchange="loadFile(event)" class="form-control form-control-sm" type="file" />
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <span>Staff has uploaded all documents</span>
                                    @endif
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2">
                                        <i class="mdi mdi-content-save"></i> Upload
                                    </button>
                                </div>
                            </form>
                        </div> <!-- end tab-pane -->

                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-8 col-lg-7">
            <!-- <div class="card">
                <div class="card-body">
                </div>
            </div> -->


        </div>
    </div>
    <!-- end row-->

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




    </script>

@endsection











