@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class=" page-title-left">
                    <ol class="breadcrumb m-0">
                        <h4>Game List</h4>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <div class="col-md-3 offset-md-9">
                            <li class="nav-item">
                                <a href="{{url('create-game-name')}}" class="btn btn-primary mb-1 text-white">Add Game Name</a>
                              </li>
                        </div>
                        
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        @if (session('status'))
                         <div class="alert alert-success">{{(session('status'))}}</div>
                         @endif
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Game Name</th>                                  
                                    <th>Action</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @if(isset($gameName))
                                      @foreach($gameName as $row)
                                    <tr>
                                        <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>
                                      <td>{{$row->name}}</td>                                   
                                      <td>
                                          <a href="{{url('edit-game-name/'.$row->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                         
                                          <a href="{{url('delete-game-name/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a> 
                                      </td>
                                    </tr>
                                      @endforeach
                                @endif
                                </tbody>
                            </table>
                                {{-- end of pagination --}} 
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection




