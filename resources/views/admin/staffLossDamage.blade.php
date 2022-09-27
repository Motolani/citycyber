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
                <h4 class="page-title">View Pending Damages</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <button value="creates" class="btn bg-primary btn-sm" style = "color:white" data-bs-toggle="modal"
                                data-bs-target="#create-modal"><span style="color: #fff"
                                    class="uil-plus"></span>Create Loss/Damage </button> 

                    <div class="tab-content">
                        <div class="tab-pane show active" id="modal-position-preview">
                            <div id="create-modal" class="modal fade" tabindex="-1"
                                role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-top">
                                    <div class="row">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="topModalLabel">Create leave request
                                                </h4>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('create.staff.damages') }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$user_id}}" >    

                                                <div class="mb-3">            
                                                    <label for="property_lost" class="form-label">Property Damaged/Lost</label>
                                                    <input id="property_lost" type="text" name="property_lost" class="form-control" placeholder="Enter Property Damaged/Lost">
                                                </div>
            
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">Enter Comment</label>
                                                    <input id="comment" type="text" name="comment" class="form-control" placeholder="Comment">
                                                </div>
            
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Fee</label>
                                                    <input type="number" id="amount" name="amount"class="form-control" placeholder="Enter Fee    Cost" required>
                                                </div>
            
                                                <button type="submit" name="submit" value = "submit" class="btn btn-primary mt-2 mb-2 ">Submit
                                                </button>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div>
                                    
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                    </div>
                    <p class="text-muted font-14">
                        <!-- Below are the lists of Offices availabe within City Cyber. Offices can also be edited -->
                    </p>
                    

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
                            </div> 
                            @endif 
                        

                            <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="all" /></th>
                                    <th>Date Created</th>
                                    <th>Property Loss/Damaged</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Fee</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>

                                <form action="/loss-damage/bulk-action" method="POST" id="form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="action" value="" id="bulkActionField" />
                                    <tbody>
                                    @if(isset($damages))
                                        @foreach($damages as $damage)
                                            <tr>
                                                <td><input type="checkbox" class="checkable" name="items[]" value="{{$damage->id}}" /></td>
                                                <td>{{$damage->created_at}}</td>
                                                <td>{{$damage->property_lost}}</td>
                                                <td>{{$damage->status}}</td>
                                                <td>{{$damage->comment}}</td>
                                                <td>{{$damage->amount}}</td>
                                                {{-- <td>{{$damage->admin->property_lost}}</td> --}}
                                                {{-- <td>
                                                    @if($damages->status == 'pending')
                                                        <a href="/loss-damage/approve/{{$damages->id}}" class="btn btn-primary btn-sm accept"><span class="uil-check"></span></a>
                                                        <a href="/loss-damage/deny/{{$damages->id}}" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></a>
                                                    @endif
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </form>
                            </table>

                            {{-- <button class="btn btn-primary btn-sm" id="bulkAccept"><span class="uil-check"></span>Accept Selected</button>
                            <button class="btn btn-danger btn-sm" id="bulkDeny"><span class="uil-multiply"></span>Deny Selected</a> --}}


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
        $(function() {
            $(document).ready(function() {
                let aa = $('#h_div');
                console.log("h_div logger ----", aa);
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
