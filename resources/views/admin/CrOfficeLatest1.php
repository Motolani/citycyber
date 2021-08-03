
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
            <h4 class="header-title" id = "headerShow">Create Office</h4>
                <p class="text-muted font-14">
                    Here you can created Offices e.g(Hub,Hq,Branches,Areas etc)
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Create Office
                        </a>
                    </li>
                </ul> <!-- end nav-->

		
                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                        <div class="row">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select Office level
                                </p>
                                <select class="form-control select2" name = "level" data-toggle="select2" data-toggle="select2" id="level">
                                    <option>Select Level</option>
                                    @if(isset($levels))
                                        @foreach($levels as  $level)
                                            <option value="{{$level->name}}|{{$level->level}}">{{$level->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> <!-- end col -->
			                <div style="margin-top:43px;" class="col-lg-6">
                                    <button class="btn btn-primary" style="" id="resetBtn">Create</button>
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
                    Here you can created Offices e.g(Hub,Hq,Branches,Areas etc)
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Create Office
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">

                        <div class="row">

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select Office Type
                                </p>
                                <select class="form-control select2" data-toggle="select2">
                                    <option>Select</option>
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                    
                                </select>
                            </div> <!-- end col -->


                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select Head
                                </p>
                                <select class="form-control select2" data-toggle="select2">
                                    <option>Select</option>
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                    
                                </select>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->  


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="the-basics" placeholder="Name">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input id="bloodhound" class="form-control" type="text" placeholder="Email">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="prefetch" placeholder="phone">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="Location">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Manager</label>
                                    <input id="custom-templates" class="form-control" type="text" placeholder="States of USA">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="default-suggestions">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
                         
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="multiple-datasets">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-6">
                                <div class="mb-0">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" data-provide="typeahead" id="multiple-datasets">
                                </div>
                            </div> <!-- end col -->
                        </div>


                        <div class="row" style="margin-top:10px">


                            <div class="col-lg-6">
                                <div class="mb-0">

                                </div>
                            </div> <!-- end col -->


                            <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                <button class="btn btn-primary" style="float: right;" id="resetBtn">Submit</button>
                            </div>
                        </div>
                        <!-- end row --> 
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
     $(document).ready(function(){
        let aa =$('#h_div');
        let header = $('headerShow');
	console.log("h_div logger ----",aa);
       	header.hide();
        aa.hide();
        $('#h_div_status').text('hide div successfully');
    });
 </script>

@endsection




