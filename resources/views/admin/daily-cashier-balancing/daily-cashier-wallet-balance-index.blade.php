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
                        <h4>Cashier Daily Balancing  Cash List</h4>
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
                        <div class="col-md-4 offset-md-8">
                            <li class="nav-item">
                                <a href="{{url('create-daily-cashier-wallet-balance')}}" class="btn btn-primary mb-1 text-white">Create Sport Cashier Daily Cash </a>
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
                                    <th>Date </th>
                                    <th>Branch Office</th>
                                    <th>Cashier Name</th>
                                    <th>Total Cash</th>
                                     <th>total Stake</th>
                                    <th>Total Bet No</th>
                                    <th>Total Cash Bet</th>
                                    <th>Total Cash Remitted</th>
                                    {{-- <th></th> --}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                 @if(isset($dailycashier))
                                      @foreach($dailycashier as $row)
                                    <tr>
                                    <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>
                                      <td>{{$row->office}}</td>
                                      <td>{{$row->cashier}}</td> 
                                      <td>{{$row->total_cash}}</td>
                                      <td>{{$row->total_stake}}</td>
                                      <td>{{$row->total_bet_number}}</td>
                                      <td>{{$row->total_cash_bet}}</td>
                                      <td>{{$row->total_cash_remit}}</td>
                                      {{-- <td>{{$row->total_stake}}</td> --}}
                                      <td>
                                          <a href="{{url('view-daily-cashier-wallet-balance/'.$row->id)}}" class="btn btn-primary btn-sm">View</a> 
                                          {{-- <a href="{{url('view-daily-cashier-wallet-balance/'.$row->cashierid)}}" class="btn btn-primary btn-sm">View</a> --}}
                                         
                                          <a href="{{url('delete-daily-cashier-wallet-balance/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a> 
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




