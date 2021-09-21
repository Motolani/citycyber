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
            <h4 class="page-title">View Pending Suspensions</h4>
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
                    Below are the lists of Offices availabe within City Cyber. Offices can also be edited
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
                    </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                    <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="all" /></th>
                                <th>Date Created</th>
                                <th>Staff Name</th>
                                <th>Comment</th>
                                <th>Raised By</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <form action="/suspension/bulk-action" method="POST" id="form">
                            {{csrf_field()}}
                            <input type="hidden" name="action" value="" id="bulkActionField" />
                            <tbody>
                                @if(isset($incidents))
                                @foreach($incidents as $incident)
                                <tr>
                                    <td><input type="checkbox" class="checkable" name="items[]" value="{{$incident->id}}" /></td>
                                    <td>{{$incident->created_at}}</td>
                                    <td>{{$incident->staff->firstname}}</td>
                                    <td>{{$incident->comment}}</td>
                                    <td>{{$incident->admin->firstname}}</td>
                                    <td>{{$incident->startDate}}</td>
                                    <td>{{$incident->endDate}}</td>
                                    <td>
                                        @if($incident->status == 'pending')
                                        <a href="/suspension/approve/{{$incident->id}}" class="btn btn-primary btn-sm accept"><span class="uil-check"></span></a>
                                        <a href="/suspension/deny/{{$incident->id}}" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></a>
                                            @endif
                                    </td>

                                    <!-- <td>{{--
                                           <a href="{{url('officeInfo')}}"  rel="tooltip" class="btn btn-info"  data-created="{{$incident->created_at}}">
                                             <i class="uil-pen"></i>
                                           </a>--}}
				
					   <form method="get" action="{{url('officeInfo')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$incident->id}}">
                                                    <input type="hidden" name="description" value="{{$incident->name}}">
                                                    <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                            </form>
                                        </td> -->
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </form>
                    </table>

                    <button class="btn btn-primary btn-sm" id="bulkAccept"><span class="uil-check"></span>Accept Selected</button>
                    <button class="btn btn-danger btn-sm" id="bulkDeny"><span class="uil-multiply"></span>Deny Selected</a>


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