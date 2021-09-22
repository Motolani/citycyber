
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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit Office</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Available Table</h4>
                    <p class="text-muted font-14">
                        Below are the lists of Staff availabe within City Cyber. You can also be View More details about selected Staff
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
                            </a>
                        </li>

                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>View More</th>
                                    <th>Date Created</th>
                                    <th>Staff Name</th>
                                    <th>Level</th>
                                    <th>Office</th>
                                    <th>Status</th>
                                    <th>Phone</th>
                                    <th>Resumption Date</th>
                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($staff))
                                    @foreach($staff as $user)
                                        <tr>
                                            <td>
                                                <form method="get" action="{{url('viewStaffProfile')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="description" value="{{$user->id}}">
                                                    <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                                </form>
                                            </td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->firstname.' '.$user->firstname}}</td>
                                            <td>{{$user->level}}</td>
                                            <td>{{$user->office->name ?? "No Office"}}</td>
                                            <td>{{$user->status}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->resumptionDate}}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td>
                                            <a href="{{url('viewStaffProfile/$user->id')}}"  rel="tooltip" class="btn btn-info"  data-created="">
                                                <i class="uil-eye"></i>
                                            </a>
                                        </td>
                                        <td>18-06-2021</td>
                                        <td>Faith Akindele</td>
                                        <td>Managing Director</td>
                                        <td>Managing Director</td>
                                        <td>Head Office</td>
                                        <td>Regular</td>
                                        <td>07035666498</td>
                                        <td>18-06-2021</td>
                                    </tr>
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


@section('script')
    <script>


    </script>

@endsection



