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
                        <h4>Game Commission Table List</h4>
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
                                <a href="{{url('create-game-commission')}}" class="btn btn-primary mb-1 text-white">Create Game Commission</a>
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
                                    {{-- <th>Office</th>
                                    <th>Cashier Name</th> --}}
                                    <th>Game Type</th>
                                    <th>Amount</th>
                                    <th>Date Range From</th>
                                    <th>Date Range To</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                 @if(isset($gameComm))
                                      @foreach($gameComm as $row)
                                    <tr>
                                      <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                                      {{-- <td>{{$row->office}}</td>
                                      <td>{{$row->cashier}}</td>  --}}
                                      <td>{{$row->game_name}}</td>
                                      <td>{{$row->amount}}</td>
                                      <td>{{date('Y-m-d', strtotime($row->date_range_from))}}</td>
                                      <td>{{date('Y-m-d', strtotime($row->date_range_to))}}</td>
                                      <td>
                                           {{-- <a href="{{url('view-game-commission/'.$row->id)}}" class="btn btn-secondary btn-sm">view</a>  --}}
                                           <a href="{{url('edit-game-commission/'.$row->id)}}" class="btn btn-primary btn-sm">Edit</a> 
                                          <a href="{{url('delete-game-commission/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a>  
                                      </td>
                                    </tr>
                                      @endforeach
                                @endif 
                                </tbody>
                            </table>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection




