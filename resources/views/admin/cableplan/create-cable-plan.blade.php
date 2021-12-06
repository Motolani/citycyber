
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
                <h4 class="page-title ">Create Plan</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Create Plan 
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can create cable plan name and amount 
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('store-cable-plan')}}">
                                @csrf

                                <div class="row ">
                                    <div class="col-md-6 mb-3">
                                    <label for="card number">Cable Plan Name</label>
                                        <input type="text"  name="cable_plan_name" class="form-control" placeholder="please enter the cable name with its cable plan">
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                        <label for="card number">Amount</label>
                                        <input type="number" min="0" name="amount" class="form-control" placeholder="please enter cable plan amount">
                                    </div>
                                    </div> 

                                    <div class="col-md-12 mb-3">
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('/cable-plan-index')}}" class="btn btn-outline-primary float-right">Back to index</a>
                                        <button type="submit" class="btn btn-primary">Create Cable plan</button>
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










