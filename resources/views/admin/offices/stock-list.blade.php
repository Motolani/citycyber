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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">Stocks</li>
                    </ol>
                </div>
                <h4 class="page-title">View Stocks for {{$office->name}}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <!-- <li class="nav-item">
                                <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Preview
                                </a>
                            </li> -->

                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($items))
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{$item->item->name ?? ""}}</td>
                                            <td>{{$item->item->category ?? ""}}</td>
                                            <td>{{$item->item->description ?? ""}}</td>
                                            <td>
                                                    {{$item->status ?? ""}}
                                                @if($item->status == 'rejected')
                                                    <br />
                                                    <strong>Reason:</strong>
                                                    {{$item->reason->name}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status == "processing")
                                                    <a href="{{route('office.acceptStock',$item->id)}}" class="btn btn-primary btn-sm accept"><span class="uil-check"></span></a>
                                                    <a href="{{route('office.rejectStock',$item->id)}}" class="btn btn-danger btn-sm rejectButton" data-toggle="modal" data-target="#rejectModal"><span class="uil-multiply"></span></a>
                                                @endif
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


    <div class="modal" id="rejectModal" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Why do you want to reject this</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="POST" action="" aria-hidden="true" id="rejectForm">
                    @csrf
                    <div class="modal-body">
                        <label>Reason</label>
                        <select class="form-control select2 mt-1" name="reason_id" data-toggle="select2" required>
                            <option>Select Reason</option>
                            @if(isset($reasons))
                                @foreach($reasons as $reason)
                                    <option value="{{$reason->id}}" >{{$reason->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>
        $(function() {
            $(".rejectButton").click(function (e){
                e.preventDefault();
                $("#rejectForm").attr("action", e.target.href);
            });
        });
    </script>

    @include('admin.includes.view-pending-scripts');

@endsection