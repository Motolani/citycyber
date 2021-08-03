
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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CityCyber</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Profile</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            <div class="card-body">
                <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                alt="profile-image">

                <h4 class="mb-0 mt-2">Dominic Keller</h4>
                <p class="text-muted font-14">Ict Head</p>

                <!-- <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                <button type="button" class="btn btn-danger btn-sm mb-2">Message</button> -->

                <div class="text-start mt-3">
                    <h4 class="font-13 text-uppercase">About User :</h4>
                
                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">(123)
                            123 1234</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">user@email.domain</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">Lagos</span></p>
                    

                    <p class="text-muted mb-2 font-13"><strong>Branch :</strong> <span class="ms-2 ">user@email.domain</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">Lagos</span></p>
                </div>

                <ul class="social-list list-inline mt-3 mb-0">
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                class="mdi mdi-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                class="mdi mdi-google"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                class="mdi mdi-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                class="mdi mdi-github"></i></a>
                    </li>
                </ul>
            </div> <!-- end card-body -->
        </div> <!-- end card -->

        <!-- Messages-->
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>
                <h4 class="header-title mb-3">Messages</h4>

                <div class="inbox-widget">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Tomaslau</p>
                        <p class="inbox-item-text">I've finished it! See you so...</p>
                        <p class="inbox-item-date">
                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                        </p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Stillnotdavid</p>
                        <p class="inbox-item-text">This theme is awesome!</p>
                        <p class="inbox-item-date">
                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                        </p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Kurafire</p>
                        <p class="inbox-item-text">Nice to meet you</p>
                        <p class="inbox-item-date">
                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                        </p>
                    </div>

                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Shahedk</p>
                        <p class="inbox-item-text">Hey! there I'm available...</p>
                        <p class="inbox-item-date">
                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                        </p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg" class="rounded-circle" alt=""></div>
                        <p class="inbox-item-author">Adhamdannaway</p>
                        <p class="inbox-item-text">This theme is awesome!</p>
                        <p class="inbox-item-date">
                            <a href="#" class="btn btn-sm btn-link text-info font-13"> Reply </a>
                        </p>
                    </div>
                </div> <!-- end inbox-widget -->
            </div> <!-- end card-body-->
        </div> <!-- end card-->

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
                        JOB DETAILS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#accountDetails" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                        ACCOUNT DETAILS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#emmergencyContact" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                            EMERGENCY CONTACT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#nextOfKinInfo" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            NEXT OF KIN INFO
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    


                    <div class="tab-pane" id="aboutme">

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
                                        <td>12th September , 2017 | 3 years</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Gender</td>
                                        <td>Male</td>
                                    </tr>
                                    <tr>
                                        <td>Marital Status</td>
                                        <td>Married</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Spouse Name</td>
                                        <td>OK</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Spouse Phone</td>
                                        <td>07035666498</td>
                                    </tr>

                                    <tr>
                                        <td>State of Origin</td>
                                        <td>Imo</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>LGA</td>
                                        <td>Aboh Mbaise</td>
                                    </tr>
                                    

                                    
                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end tab-pane -->


                    <div class="tab-pane" id="jobdetails">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            Experience</h5>
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
                                        <td>REGULAR</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Branch</td>
                                        <td>HEAD OFFICE</td>
                                    </tr>
                                    <tr>
                                        <td>Branch Address</td>
                                        <td>32 Summit Road, Asaba, Delta State</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Branch Type</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Branch Region</td>
                                        <td>25/05/2021</td>
                                    </tr>

                                    <tr>
                                        <td>Branch Area</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Role</td>
                                        <td>Managing Director</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Level</td>
                                        <td>MANAGING DIRECTOR</td>
                                    </tr>



                                    <tr>
                                        
                                        <td>Resumption Type</td>
                                        <td>FIRST SHIFT (07:30:00 - 19:30:00 )</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>View Scope</td>
                                        <td>Managing Director</td>
                                    </tr>

                                    <tr>
                                        <td>Department</td>
                                        <td>NILL</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Unit</td>
                                        <td>NILL</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Resumption Date</td>
                                        <td>12th September , 2016 | 4 years , 9 months ago!</td>
                                    </tr>





                                    <tr>
                                        
                                        <td>Assumption Date</td>
                                        <td>NIL</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Termination Date</td>
                                        <td>NIL</td>
                                    </tr>

                                    
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
                                        
                                        <th>Title </th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>GTBank</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Account Number</td>
                                        <td>00023443</td>
                                    </tr>
                                    <tr>
                                        <td>Account Type</td>
                                        <td>Savings</td>
                                    </tr>
                                    
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
                                        <th>Faith Akindele</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Relationship</td>
                                        <td>Brother</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Address</td>
                                        <td>No 10 Gra Street</td>
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
                                        <th>Faith Akindele</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Relationship</td>
                                        <td>Brother</td>
                                    </tr>
                                    <tr>
                                        
                                        <td>Address</td>
                                        <td>No 10 Gra Street</td>
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
                                </div> <!-- end col -->
                            </div> <!-- end row -->

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

                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Social</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-fb" class="form-label">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                                            <input type="text" class="form-control" id="social-fb" placeholder="Url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-tw" class="form-label">Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                                            <input type="text" class="form-control" id="social-tw" placeholder="Username">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-insta" class="form-label">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                                            <input type="text" class="form-control" id="social-insta" placeholder="Url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-lin" class="form-label">Linkedin</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                                            <input type="text" class="form-control" id="social-lin" placeholder="Url">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-sky" class="form-label">Skype</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-skype"></i></span>
                                            <input type="text" class="form-control" id="social-sky" placeholder="@username">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="social-gh" class="form-label">Github</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                            <input type="text" class="form-control" id="social-gh" placeholder="Username">
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->

                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
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







