@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Slip Requests</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Viewing all Slip Requests</h4>

                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Office</th>
                                    <th>Cashier</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($slips))
                                    @foreach($slips as $slip)
                                        <tr>
                                            <td>{{$slip->id}}</td>
                                            <td>{{$slip->office->name}}</td>
                                            <td>{{$slip->cashier->user->firstname}}</td>
                                            <td>{{$slip->amount}}</td>
                                            <td>{{$slip->description}}</td>
                                            <td>{{$slip->comment}}</td>
                                            <td>{{$slip->status}}</td>
                                            <td>{{$slip->type}}</td>
                                            <td>
                                                @if($slip->status == "PENDING")
                                                    <a href="/cash-reserve/accept-cashier-request/{{$slip->id}}" class="btn btn-success btn-sm">
                                                        <span class="uil-check"></span> Accept
                                                    </a>

                                                    <a href="/cash-reserve/reject-cashier-request/{{$slip->id}}" class="btn btn-danger btn-sm rejectButton" data-toggle="modal" data-target="#rejectModal">
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
        </div>
    </div>

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