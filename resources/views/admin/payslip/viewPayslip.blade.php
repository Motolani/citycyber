<?php
    $totalStaff = App\User::where('id', '>', 0)->count();
?>

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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow"></li>
                    </ol>
                </div>
                <h4 class="page-title">View All Payslips</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @if($totalStaff === $totalPayslip)
                                <a href="{{url('generatepayroll')}}" class="btn bg-primary btn-sm" style = "color:white"><span style="color: #fff"
                                    class="uil-plus"></span>Generate Payroll </a>
                            @endif
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h3 style="float: right;">Number of Staff : {{$totalStaff}}</h3>
                        </div>
                    </div>
                    

                        <br><br>
                        <br><br>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Basic Salary</th>
                                    <th>Advance</th>
                                    <th>Allowance</th>
                                    <th>Bonus</th>
                                    <th>Deduction</th>
                                    <th>Offence	</th>
                                    <th>Pension</th>
                                    <th>Tax</th>
                                    <th>Loan</th>
                                    <th>Net Salary</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($payslip))
                                    @foreach($payslip as $pay)
                                    <tr>
                                        <td>{{$pay->created_at}}</td>
                                        <td>{{$pay->basic_salary}}</td>
                                        <td>{{$pay->advance}}</td>
                                        <td>{{$pay->allowance}}</td>
                                        <td>{{$pay->bonus}}</td>
                                        <td>{{$pay->deduction}}</td>
                                        <td>{{$pay->offence}}</td>
                                        <td>{{$pay->pension}}</td>
                                        <td>{{$pay->tax}}</td>
                                        <td>{{$pay->loan}}</td>
                                        <td>{{$pay->net_salary}}</td>
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
    <!-- end row-->
@endsection