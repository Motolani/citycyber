@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')


    <br/>
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{$totalOffice}}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Office</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{$totalTransactions}}</span></h3>
                                    <p class="text-muted font-15 mb-0">Transactions today</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{$totalStaff}}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Members</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{$bankAccountsCount}}</span></h3>
                                    <p class="text-muted font-15 mb-0">Accounts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Staff Present Today</h4>

                        <div dir="ltr">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Level</th>
                                    <th>Branch</th>
                                    <th>Phone</th>
                                    <th>Date Created</th>
                                    <th>View More</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($staffPresent))
                                    @foreach($staffPresent as $user)
                                        <tr>
                                            <td>{{$user->firstname.' '.$user->firstname}}</td>
                                            <td>{{$user->level}}</td>
                                            <td>{{$user->office->name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>
                                                <form method="get" action="{{url('viewStaffProfile')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="description" value="{{$user->id}}">
                                                    <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->




            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">This Month Birthdays</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                @foreach($birthdaysToday as $user)
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">{{$user->getFullName()}}</a></h5>
                                            <span class="text-muted font-13">{{$user->age()}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
    <!-- end row-->


@endsection

