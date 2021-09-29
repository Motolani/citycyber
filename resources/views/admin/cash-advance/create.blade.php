
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request Cash Advance</li>
                    </ol>
                </div>
                <h4 class="page-title">Request Cash Advance</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="header-title" style = "">
                        Here you can request Cash Advance
                    </h4>

                    {{--                    <ul class="nav nav-tabs nav-bordered mb-3">--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">--}}
                    {{--                                Create Office--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul> <!-- end nav-->--}}

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('cash-advance.create')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Amount</label>
                                            <input type="text" name = "amount" class="form-control" data-provide="typeahead" id="the-basics" placeholder="₦20000" required>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12">
                                        <label class="form-label">Category</label>
                                        <select class="form-control select2" name="category" data-toggle="select2" required>
                                            <option>Select Category</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea required name= "description" class="form-control" placeholder="Description">
                                            </textarea>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
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
@endsection







