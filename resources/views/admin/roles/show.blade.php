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

                    
                    </ol>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">

                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <li>{!! \Session::get('success') !!}</li>
                            </div 
                        @endif 
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <h2>
                                                <strong>Name:</strong>
                                                {{ $role->name }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <h4>
                                                <strong>Permissions:</strong>
                                                <br> <br>
                                                @if(!empty($rolePermissions))
                                                <ul style="list-style-type:disc;">
                                                    @foreach($rolePermissions as $v)
                                                    <li>{{ $v->name }}</li>
                                                    @endforeach
                                                </ul> 
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                    
                                </div> <!-- end col -->
                                
                            </div>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


@endsection
