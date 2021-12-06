
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
                <h4 class="page-title ">Create Cable Television</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Create cable 
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can create cable branch, cable tv and cable plan 
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('store-cable-providers')}}">
                                @csrf

                                <div class="row ">
                                    <div class="col-md-6 mb-3">
                                    <label for="card number">Smart Card Number</label>
                                        <input type="number" min="0" name="smart_card" class="form-control" placeholder="enter smart card number" autocomplete="off">
                                    </div>
                                    {{-- <label for="smart number">Smart Number</label>
                                    <input type="number" min="0"  name="smart_number"class="form-control" placeholder="Enter smart number">
                                    </div> --}}

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="branch ">Branch Office</label>
                                    <select  name ="branch_office" class="form-select form-control" >
                                        @foreach($getOffice as  $office)
                                        <option  value="{{$office->name}}">{{$office->name}}</option>
                                        @endforeach 
                                      </select> 
                                      {{-- <input type="text" name="branch_office" class="form-control" placeholder="Enter smart number"> --}}
                                    </div> 

                                    <div class="col-md-6 mb-3">
                                     <label for="cable type">Cable Television Type</label>
                                   
                                      <select  name="cable_tv_type" class="form-select form-control" >
                                        @foreach($cable_tv as $row)
                                        <option  value="{{$row->cable_type_name}}">{{$row->cable_type_name}}</option>
                                        @endforeach 
                                      </select> 
                                      {{-- <input type="text" name="cable_tv_type" class="form-control" placeholder="cable type"> --}}
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="cable plane">Cable Plan Type</label>
                                    <select  name="cable_plan_type" class="form-select form-control" >
                                        @foreach($getPlan as $row)
                                        <option  value="{{$row->cable_plan_name}}">{{$row->cable_plan_name}}</option>
                                        @endforeach 
                                      </select>
                                      {{-- <input type="text" name="cable_plan_type" class="form-control" placeholder="cable plan" > --}}
                                    </div>

                                    <div class="col-md-12 mb-3">
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('/cable-index')}}" class="btn btn-outline-primary float-right">Back to index</a>
                                        <button type="submit" class="btn btn-primary">Create Cable</button>
                                    </div>


                                    {{-- <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control  border @error('name') border-danger @enderror p-4 bg-light"
                                        placeholder="Enter  Name"autocomplete="off" value="{{old('name')}}">
                                        @error('name')
                                        <div class=" text-danger mt-2 text-sm">
                                            {{$message}}
                                        </div>
                                        @enderror
                                     --}}
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










