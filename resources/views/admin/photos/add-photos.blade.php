
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
                <h4 class="page-title">Add Photos to {{$office->name}} Office</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Add Photos to {{$office->name}} Office</h4>
                    <p class="text-muted font-14">
                        Here you can add Photos to Offices
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('doAddPhotos', [$office->id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Upload File</label>
                                    <input type="file" class="form-control" name="photo" />
                                </div>

                                <div class="form-group">
                                    <button type="submit" value="Upload" class="btn btn-success mt-3"> Upload </button>
                                </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div>

            <div class="card">
                <div class="card-body" >
                    @include('admin.includes.photo-gallery')
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection


@section('script')
@endsection







