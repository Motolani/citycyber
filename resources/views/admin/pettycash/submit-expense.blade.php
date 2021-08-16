
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request PettyCash</li>
                    </ol>
                </div>
                <h4 class="page-title">Request PettyCash</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="header-title" style = "">
                        Submit the receipt of your expenditure
                    </h4>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('submitExpense')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Ticket ID</label>
                                            <input type="text" name="ticketID" value="{{$data->ticket_id}}" class="form-control" required disabled>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12">
                                        <div class="mb-3 ">
                                            <label class="form-label">Upload Receipt</label>
                                            <input type="file" name ="file" class="form-control" required>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Balance</label>
                                            <input type="text" name="balance" value="{{$data->balance}}" class="form-control">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')
@endsection







