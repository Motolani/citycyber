@extends('admin.layout')
@section('title')
Dashboard
@endsection
@section('content')
<style>
    label.error
{
color:red;
font-family:verdana, Helvetica;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">View/Edit Office</li>
                </ol>
            </div>
            <h4 class="page-title">View/Edit User</h4>
        </div>
    </div>
</div>
<!-- end page title -->




<!-- <form > -->

<div class="row">
    <!-- modal pop button -->
    <!-- <div class="col-md-8" style="width: 400px; padding:9px;border:1px solid #4d4dff"> -->
    <div class="col-md-4 py-2">
        <button type="button" id="Mybtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> CLICK HERE TO FILTER
            <i class="uil-filter"></i>
        </button>
    </div>
    <!-- end of modal pop up button  -->
</div>

<!-- <input type="text" name="branch" id="formBranch" class="form-control" placeholder="enter branch name" /> -->
<div class="row show_table" id="table_card">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <!-- end nav-->
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                        <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Level</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Phone</th>
                                    <th>Resumption Date</th>
                                    <th>Operation
                                    <th>
                                        <!-- <th>Department</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                @if(isset($staff))
                                @foreach($staff as $user)
                                <tr>
                                    <td>{{$user->firstname.' '.$user->lastname}}</td>
                                    <td>{{$user->level}}</td>
                                    <td>{{$user->office->name ?? "No Office"}}</td>
                                    <td>{{$user->status}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
                                    <!-- <td>{{$user->department}}</td> -->

                                    <td>
                                        <form method="get" action="{{url('viewStaffProfile')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="description" value="{{$user->id}}">
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="get" action="{{route('createstaff')}}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <button class="btn btn-primary btn-sm mt-1"><span class="uil-postcard"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <p>no data found</p>
                                @endif
                               
                                
                                
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<!-- start of modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <!-- <div class="modal-body"> -->

            <form class="card" id="MyForm" method="GET" action="{{route('filterStaffTable')}}" >
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Click to select your filter</h5>
                    <div class="row">
                        <div class="col">
                            <!-- checkbox start  -->
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox"  id="check_status"  style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Status
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_number" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Staff Number
                                </label>

                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_bank" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Bank
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_marital" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Marital Status
                                </label>
                            </div>

                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_resumption_year" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Resumption Year
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_department" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Department
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_gender" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Gender
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_lga" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Staff LGA
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_email" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Email
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_firstname" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    First Name
                                </label>
                            </div>

                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_level" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Staff Level
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_branch" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Branch
                                </label>
                            </div>
                        </div>
                        <div class="col">

                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_unit" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Unit
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_phone" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Phone
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_lastname" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Last Name
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_origin" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    State Of Origin
                                </label>
                            </div>

                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_role" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Role
                                </label>
                            </div>
                            <div class="form-check py-1">
                                <input class="form-check-input p-2 " type="checkbox" value="" id="check_birth" style="border-radius:none;">
                                <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                    Birth Month
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                                <div class="form-check py-1">
                                    <input class="form-check-input p-2 " type="checkbox" value="" id="check_resumption_type" style="border-radius:none;">
                                    <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                        Resumption Type
                                    </label>
                                </div>
                                <!-- <div class="form-check py-1">
                                    <input class="form-check-input p-2 " type="checkbox" value="" id="check_branch" style="border-radius:none;">
                                    <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                        Branch
                                    </label>
                                </div>
                                <div class="form-check py-1">
                                    <input class="form-check-input p-2 " type="checkbox" value="" id="check_resumption" style="border-radius:none;">
                                    <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                        Resumption Type
                                    </label>
                                </div>
                                <div class="form-check py-1">
                                    <input class="form-check-input p-2 " type="checkbox" value="" id="check_gender" style="border-radius:none;">
                                    <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                        Gender
                                    </label>
                                </div> -->


                            </div> 
                    <div class="col"></div>
                <!-- end of checkbox -->

                    <!-- search form input start -->
                    <div class="single select py-2" id="status_input">
                        <label>Status</label>
                        <input type="text" name="status"  class="form-control" placeholder="enter status" required/>
                        @error('status')
                           <div class="alert alert-danger"></div>
                        @enderror
                        <!-- @error('status')
                           <div class="alert alert-danger">{{$message}}</div>
                        @enderror -->
                    </div>
                    <div class="single select py-2" id="staff_input">
                        <label>Staff Number</label>
                        <input type="text" name="staff_number"  class="form-control" placeholder="enter staff number" required/>
                        @error('staff_number')
                           <div class="alert alert-danger"></div>
                        @enderror
  
                    </div>
                    <div class="single select py-2" id="bank_input">
                        <label>Banks</label>
                        <select  class="form-select form-select-md py-1" aria-label="form-select-lg example" name="bank" required>

                            @if(isset($banks))
                            <option value="">--Select Bank--</option>
                            @foreach($banks as $bank)
                            <option value="{{$bank->id}}|{{$bank->bank_name}}">{{$bank->bank_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('bank')
                           <div class="alert alert-danger"></div>
                        @enderror
  
                    </div>
                    <div class="single select py-2" id="marital_input">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Marital Status</label>
                                <!-- <input type="text" name="branch" id="formBranch" class="form-control" placeholder="enter branch name" /> -->
                                <select  class="form-select form-select-md py-1" name="maritalstatus" aria-label="form-select-lg example" required>
                                    <option>--Select Marital Status--</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                </select>
                                @error('maritalStatus')
                                  <div class="alert alert-danger"></div>
                                @enderror
  
                            </div>
                        </div>
                    </div>

                    <div class="team select py-2" id="department_input">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Department</label>
                                <!-- <input type="text" name="branch" id="formBranch" class="form-control" placeholder="enter branch name" /> -->
                                <select name="department" class="form-select form-select-md py-1" aria-label="form-select-lg example" required>
                                    <option value="">---Select Status---</option>
                                    @if(isset($departments))
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}|{{$department->title}}">{{$department->title}}</option>
                                    @endforeach
                                    @else
                                    <option>Branch Management</option>
                                    <option>Director's Office</option>
                                    @endif
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="single select py-2" id="lga_input">
                        <label>Staff LGA</label>
                        <input type="text" name="lga"  class="form-control" placeholder="enter staff local government" required/>

                    </div>
                    <!-- need to tell isaac about this later -->
                    <!-- <div class="team select py-2">
                      <label>Staff LGA</label>
                      <select id="lgas" class="form-control select select2" name="lga" data-toggle="select2">
                       <option value="{{ Session::has('personalInfo')?Session::get('personalInfo')['lga']:'' }}">
              
                        {{-- {{Session::has('personalInfo')?Session::get('personalInfo')['lga']:'Select Lga'}} --}} 
                            </option>
                      </select>

                      </div> -->
                    <!-- </div> -->
                    <div class="single select py-2" id="email_input">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email</label>
                                <input type="text" name="email"  class="form-control" placeholder="enter email  e.g adams@citycyber.com"  required/>
                            </div>
                        </div>
                    </div>
                    <div class="single select py-2" id="firstName_input">
                        <label>First Name</label>
                        <input type="text" name="firstname"  class="form-control" placeholder="enter first name" required/>

                    </div>

                    <div class="single select py-2" id="staffUnit_input">
                        <label>Unit</label>
                        <select  class="form-select form-select-md py-1" aria-label="form-select-lg example" name="unit" required>

                            <option value="">--Select Unit--</option>

                            @if(isset($units))
                            @foreach($units as $unit)
                            <option value="{{$unit->id}}|{{$unit->title}}">{{$unit->title}}</option>
                            @endforeach
                            @else

                            <option>Regular Spot</option>
                            <option>VIP</option>
                            @endif


                        </select>

                    </div>
                    <div class="single select py-2" id="phone_input">
                        <label>Phone</label>
                        <input type="text" name="phone"  class="form-control" placeholder="enter phone number" required/>

                    </div>
                    <div class="single select py-2" id="last_input">
                        <label>Last Name</label>
                        <input type="text" name="lastname"  class="form-control" placeholder="enter last name" required/>

                    </div>
                    <div class="single select py-2" id="state_origin_input" >
                        <label>State Of Origin</label>
                        <input type="text" name="state" class="form-control" placeholder="enter state of origin" required/>

                    </div>

                    <div class="single select py-2" id="date_input">
                        <label>Birth Month</label>
                        <input type="date" name="dob"  class="form-control" placeholder="enter date" required />
                    </div>

                    <div class="single select py-2" id="staff_branch_input">
                        <label>Staff Branch</label>
                        <select  class="form-select form-select-md py-1" name="branchId " aria-label="form-select-lg example" required>
                            <option value=""> --Select Branch--</option>
                            @if(isset($offices))
                            @foreach($offices as $office)
                            <option value="{{$office->id}}|{{$office->name}}">{{$office->name}}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="single select py-2" id="resumptiontype_input">
                        <label>Resumption Type</label>
                        <select  class="form-select form-select-md py-1" name="resumptionType " aria-label="form-select-lg example" required>
                            <option value=""> --Select Resumption Type--</option>
                            @if(isset($resumptionTypes))
                            @foreach($resumptionTypes as $resumptionType)
                            <option value="{{$resumptionType->id}}|{{$resumptionType->title}}">{{$resumptionType->title}}</option>
                            @endforeach
                            @else

                            @endif
                        </select>

                    </div>
                    <div class="single select py-2" id="gender_input">
                        <label>Gender</label>
                        <select  class="form-select form-select-md py-1" name="gender" aria-label="form-select-lg example" required>
                            <option value=""> --Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                    </div>

                    <div class="single select py-2" id="resumptiondate_input" >
                        <label>Resumption Year</label>
                        <input type="date" name="resumptionDate" class="form-control" required/>
                    </div>

                    <div class="team select py-2" id="stafflevel_input">
                        <label>Staff Level</label>
                        <select  class="form-select form-select-md py-1" name="level" aria-label="form-select-lg example"required>
                            <option value=""> --Select Staff Level--</option>
                            @if(isset($levels))
                            @foreach($levels as $level)
                            <option value="{{$level->id}}|{{$level->title}}">{{$level->title}}</option>
                            @endforeach
                            @else

                            @endif
                        </select>

                    </div>
                    <div class="team select py-2" id="role_input">
                        <label>Role</label>
                        <select  class="form-select form-select-md py-1" name="role_id" aria-label="form-select-lg example " required>
                            <option value=""> --Select Role--</option>
                            @if(isset($role))
                            @foreach($role as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <!-- search form input end  -->
                    <!-- <button type="submit" class="btn btn-primary btn-block w-100 my-2">SEARCH</button> -->
                </div>


                <!-- </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" value="submit" id="submitBtn">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of modal -->
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
       //hide all the form input
        $('.select').css('display','none');

    });

    //validate the form 
    $(document).ready(function() {
    //  $("#MyForm").validate();
    $("#MyForm").validate(
      {
       rules: 
       {
          item: 
         {
            required: true
         }
       }
      });	
    });
    $(function () {
        $("#check_status").click(function () {
            if ($(this).is(":checked")) {
                $("#status_input").show();
            } else {
                $("#status_input").hide();
            }
        });
    });

    $(function () {
        $("#check_number").click(function () {
            if ($(this).is(":checked")) {
                $("#staff_input").show();
            } else {
                $("#staff_input").hide();
            }
        });
    });

    $(function () {
        $("#check_bank").click(function () {
            if ($(this).is(":checked")) {
                $("#bank_input").show();
            } else {
                $("#bank_input").hide();
            }
        });
    });

    $(function () {
        $("#check_marital").click(function () {
            if ($(this).is(":checked")) {
                $("#marital_input").show();
            } else {
                $("#marital_input").hide();
            }
        });
    });

    $(function () {
        $("#check_department").click(function () {
            if ($(this).is(":checked")) {
                $("#department_input").show();
            } else {
                $("#department_input").hide();
            }
        });
    });

    $(function () {
        $("#check_lga").click(function () {
            if ($(this).is(":checked")) {
                $("#lga_input").show();
            } else {
                $("#lga_input").hide();
            }
        });
    });

    $(function () {
        $("#check_email").click(function () {
            if ($(this).is(":checked")) {
                $("#email_input").show();
            } else {
                $("#email_input").hide();
            }
        });
    });

    $(function () {
        $("#check_firstname").click(function () {
            if ($(this).is(":checked")) {
                $("#firstName_input").show();
            } else {
                $("#firstName_input").hide();
            }
        });
    });
    $(function () {
        $("#check_unit").click(function () {
            if ($(this).is(":checked")) {
                $("#staffUnit_input").show();
            } else {
                $("#staffUnit_input").hide();
            }
        });
    });

    $(function () {
        $("#check_phone").click(function () {
            if ($(this).is(":checked")) {
                $("#phone_input").show();
            } else {
                $("#phone_input").hide();
            }
        });
    });

    $(function () {
        $("#check_lastname").click(function () {
            if ($(this).is(":checked")) {
                $("#last_input").show();
            } else {
                $("#last_input").hide();
            }
        });
    });

    $(function () {
        $("#check_origin").click(function () {
            if ($(this).is(":checked")) {
                $("#state_origin_input").show();
            } else {
                $("#state_origin_input").hide();
            }
        });
    });

    $(function () {
        $("#check_birth").click(function () {
            if ($(this).is(":checked")) {
                $("#date_input").show();
            } else {
                $("#date_input").hide();
            }
        });
    });

    $(function () {
        $("#check_branch").click(function () {
            if ($(this).is(":checked")) {
                $("#staff_branch_input").show();
            } else {
                $("#staff_branch_input").hide();
            }
        });
    });

    $(function () {
        $("#check_resumption_type").click(function () {
            if ($(this).is(":checked")) {
                $("#resumptiontype_input").show();
            } else {
                $("#resumptiontype_input").hide();
            }
        });
    });

    $(function () {
        $("#check_gender").click(function () {
            if ($(this).is(":checked")) {
                $("#gender_input").show();
            } else {
                $("#gender_input").hide();
            }
        });
    });

    $(function () {
        $("#check_resumption_year").click(function () {
            if ($(this).is(":checked")) {
                $("#resumptiondate_input").show();
            } else {
                $("#resumptiondate_input").hide();
            }
        });
    });

    $(function () {
        $("#check_level").click(function () {
            if ($(this).is(":checked")) {
                $("#stafflevel_input").show();
            } else {
                $("#stafflevel_input").hide();
            }
        });
    });

    $(function () {
        $("#check_role").click(function () {
            if ($(this).is(":checked")) {
                $("#role_input").show();
            } else {
                $("#role_input").hide();
            }
        });
    });
//submission
$(document).ready(function(){
    $("#submitBtn").click(function(){  
            
        $("#MyForm").submit(); // Submit the form
        
    });
});











</script>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
