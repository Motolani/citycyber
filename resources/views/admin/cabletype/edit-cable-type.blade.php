
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
                <h4 class="page-title ">Update Cable Type</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-8 offset-2" id = "h_div" style = "align-content:center, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Update Type
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can Update cable type  
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('update-cable-type')}}">
                                @csrf
                                
                                <div class="row ">
                                    <div class="col-md-8  mb-3">
                                    <label for="cable type">Cable Type Name</label>
                                        <input type="text"  name="cable_type_name" value="{{$cabletype->cable_type_name}}" class="form-control" placeholder="please enter the cable type">
                                        <input type = "hidden" name = "id" value="{{$cabletype->id}}">
                                    </div>                       
                                    </div> 

                                    <div class="col-md-12 mb-3">
                                    <div class="col-md-12 ">
                                        <a href="{{url('/cable-type-index')}}" class="btn btn-outline-primary ">Back to index</a>
                                        <button type="submit" class="btn btn-primary">Update type</button>
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










