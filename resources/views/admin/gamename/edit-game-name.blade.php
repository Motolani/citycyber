
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
                <h4 class="page-title ">Update Game Name</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-8 offset-2" id = "h_div" style = "align-content:center, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Update Name
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can Update game name  
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('update-game-name/'.$gameName->id)}}">
                                @csrf
                                
                                <div class="row ">
                                    <div class="col-md-8  mb-3">
                                    <label for="cable type">Game Name</label>

                                    <input type="text"  name="name" value="{{ $gameName->name}}" class="form-control" placeholder="please enter the cable type">
                                        {{-- <input type = "hidden" name = "id" value="{{ $gameName->id}}"> --}}
                                    </div>                       
                                    </div> 

                                    <div class="col-md-12 mb-3">
                                    <div class="col-md-12 ">
                                        <a href="{{url('/game-name-index')}}" class="btn btn-outline-primary ">Back</a>
                                        <button type="submit" class="btn btn-primary">Update </button>
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










