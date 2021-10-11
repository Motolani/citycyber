@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">View Submitted Petty Cash</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div>
                        @endif

                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    {{--                                    <th><input type="checkbox" id="all" /></th>--}}
                                    <th>Staff Name</th>
                                    <th>Ticket ID</th>
                                    <th>Balance</th>
                                    <th>Receipt</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <form action="" method="POST" id="form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="action" value="" id="bulkActionField" />
                                    <tbody>
                                    @if(isset($items))
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->staff->firstname}}</td>
                                                <td>{{$item->ticket_id}}</td>
                                                <td>{{$item->balance}}</td>
                                                <td><img src="{{url($item->upload_path)}}" class="img-thumbnail img-table" /> </td>
                                                <td>
                                                    @if($item->status != 'receipt-accepted' && $item->status != 'receipt-rejected')
                                                        <a href="{{route('pettycash.acceptReceipt', $item->id)}}" class="btn btn-primary btn-sm accept"><span class="uil-check"></span></a>
                                                        <a href="{{route('pettycash.rejectReceipt', $item->id)}}" class="btn btn-danger btn-sm rejectButton" data-bs-toggle="modal" data-bs-target="#rejectModal"><span class="uil-multiply"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </form>
                            </table>

                            {{--  <button class="btn btn-primary btn-sm" id="bulkAccept"><span class="uil-check"></span>Accept Selected</button>--}}
                            {{--  <button class="btn btn-danger btn-sm" id="bulkDeny"><span class="uil-multiply"></span>Deny Selected</button>--}}


                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


@endsection

@include('admin.includes.reject-modal')


@section('script')
    <script>
        $(function() {
                $(".rejectButton").click(function (e) {
                    e.preventDefault();
                    $("#rejectForm").attr("action", $(this).attr('href'));
                });
            });
    </script>
    @include('admin.includes.view-pending-scripts');
@endsection