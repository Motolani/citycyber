
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
                <h4 class="page-title ">Update Cable Television</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">update cable 
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can create cable branch, cable tv and cable plan 
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('update-cable-providers')}}">
                               @csrf
                           
                                <div class="row ">
                                    <div class="col-md-6 mb-3">
                                    <label for="smart number">Smart Number</label>
                                    <input type="number" min="0"  name="smart_card" value="{{$cableprovider->smart_card}}" class="form-control" placeholder="Enter smart number">
                                    <input type = "hidden" name = "id" value="{{$cableprovider->id}}">
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="branch ">Branch Office</label>
                                    {{-- <select id="inputState" class="form-control">
                                        <option selected>Select offices...</option>
                                        <option>...</option>
                                      </select> --}}
                                      <input type="text" name="branch_office"  value="{{$cableprovider->branch_office}}" class="form-control" placeholder="branch office">
                                    </div> 

                                    <div class="col-md-6 mb-3">
                                     <label for="cable type">Cable Television Type</label>
                                     {{-- <select id="inputState" class="form-control">
                                        <option selected>Select cable type...</option>
                                        <option>...</option>
                                      </select> --}}
                                      <input type="text" name="cable_tv_type"   value="{{$cableprovider->cable_tv_type}}" class="form-control" placeholder="cable type">
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="cable plane">Cable Plan Type</label>
                                    {{-- <select id="inputState" class="form-control">
                                        <option selected>Select cable  plan type...</option>
                                        <option>...</option>
                                      </select> --}}
                                      <input type="text" name="cable_plan_type" value="{{$cableprovider->cable_plan_type}}" class="form-control" placeholder="cable plan">
                                    </div>

                                   
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('cable-index')}}" class="btn btn-outline-primary float-right">Back to index</a>
                                        <button type="submit" class="btn btn-primary">update Cable</button>
                                    </div>
                                    
                                  </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection










