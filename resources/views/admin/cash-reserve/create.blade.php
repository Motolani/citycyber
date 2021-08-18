
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Shop Wallet</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Cash Reserve</h4>
            </div>
        </div>
    </div>

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
                        Here you can Create a Cash Reserve
                    </h4>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action="{{route('cash.create')}}">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Office Name</label>
                                            <select class="form-control select2" name = "office" data-toggle="select2" data-toggle="select2" id="level">
                                                @foreach($offices as $office)
                                                    <option value="{{$office->id}}">{{$office->name}}</option>
                                                @endforeach
                                            </select>

                                            <label class="form-label mt-3">Wallet Code</label>
                                            <input type="text" name= "wallet_code" class="form-control" placeholder="LAG5039" required>
                                            <input type="hidden" name= "id" class="form-control" value="{{$office->id}}" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
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


@section('script')
@endsection







