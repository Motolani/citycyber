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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">View/Edit Office</li>
                    </ol>
                </div>
                <h4 class="page-title">Fund Requests</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Viewing all Fund Requests</h4>

                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Manager</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Comment</th>
                                    <th>Request Type</th>
                                    <th>Funding Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($fundRequests))
                                    @foreach($fundRequests as $fundRequest)
                                        <tr>
                                            <td>{{$fundRequest->id}}</td>
                                            <td>{{$fundRequest->cashier->firstname}}</td>
                                            <td>{{$fundRequest->amount}}</td>
                                            <td>{{$fundRequest->description}}</td>
                                            <td>{{$fundRequest->comment}}</td>
                                            <td>{{$fundRequest->send_type}}</td>
                                            <td>{{$fundRequest->type}}</td>
                                            <td>{{$fundRequest->status}}</td>
                                            <td>
                                                @if($fundRequest->status == "APPROVED")
                                                    <a href="/cashier/reject/{{$fundRequest->id}}" class="btn btn-danger btn-sm rejectButton" data-toggle="modal" data-target="#rejectModal">
                                                        <span class="uil-multiply"></span> Reject
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- end col-->


    </div>
    <!-- end row-->

@endsection
<!-- The Modal -->
@include('admin.includes.reject-modal')

@section('script')

    <script>
        $(function() {
            $(".rejectButton").click(function (e){
                e.preventDefault();
                $("#rejectForm").attr("action", e.target.href);
            });

            $(document).ready(function() {
                let aa = $('#h_div');
                aa.hide();
                $("#hide").click(function() {
                    $("div").hide();
                });

                $("#getParents").click(function() {
                    let header = $('headerShow');
                    let level_id = $(this).val();
                    //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                    ///.$("#addons").append(levelInput);
                    console.log("level_id", level_id);
                    getParent(level_id);



                    //$("#kdd").html(total);
                    //$("div").show();
                });
            });

            function getParent(level_id) {
                let url = "{{url('api/loadType')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        level: level_id
                    },

                    success: function(data) {
                        //$('#addons option:not(:first)').remove();
                        loadParent(data);

                        console.log("response", data);
                    },
                    error: function(xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });

            }

            function loadParent(data) {
                console.log('thisadata', data);
                $.each(data.product, function(key, product) {
                    let option = `<option value="${product.code}|${product.price}|${product.name}"> ${product.name}/  ${product.month} Month -N ${product.price} </option>`;
                    $("#addons").append(option);
                });

                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }

        });
    </script>

    @include('admin.includes.view-pending-scripts');

@endsection