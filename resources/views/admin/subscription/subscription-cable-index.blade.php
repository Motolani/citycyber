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
                        <h4>Cable Subscription  List</h4>
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
                                <a href="{{url('create-cable-subscription')}}" class="btn btn-primary mb-1 text-white">Add New Subscriber</a>
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
                                    <th>Branch Office</th>
                                    <th>Cable Plane </th>
                                    <th>Cable Type </th>
                                    <th>Smart Card Number</th>
                                    <th>Amount</th>
                                    <th>Subscription Date</th>
                                    <th>Expiry Date</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @if(isset( $cablesubscription))
                                      @foreach($cablesubscription as $row)
                                    <tr>
                                      <td>{{$row->branch_office}}</td>
                                      <td>{{$row->cable_plan}}</td>
                                      <td>{{$row->cable_tv_type}}</td>
                                      <td>{{$row->smart_card}}</td>
                                      {{-- <td>{{$row->subscription_type}}</td> --}}
                                      <td>{{$row->amount}}</td>
                                      <td>{{$row->subscription_date}}</td>
                                      <td>{{$row->expiring_date}}</td>
                                      <td>{{$row->remarks}}</td>
                                      <td>
                                          <a href="{{url('edit-cable-subscription/'.$row->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                         
                                          <a href="{{url('delete-cable-subscription/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a> 
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




