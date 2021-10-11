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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">View/Edit Petty Cash</li>
                    </ol>
                </div>
                <h4 class="page-title">Your Petty Cash Requests</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                            </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <form action="/petty-cash/bul-action" method="POST" id="form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="action" value="" id="bulkActionField" />
                                    <tbody>
                                    @if(isset($items))
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->ticket_id}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>
                                                    @if($item->status == 'approved' && $item->upload_path == null )
                                                        <a href="/pettycash/submit-expense/{{$item->id}}" class="btn btn-success btn-sm"><span class="uil-envelope-add"></span> Submit Expense</a>
                                                    @elseif($item->status == 'approved')
                                                        <a href="/retire/{{$item->id}}" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></a>
                                                    @else
                                                        <a href="/retire/{{$item->id}}" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></a>
                                                    @endif
                                                </td>

                                            <!-- <td>{{--
                                           <a href="{{url('officeInfo')}}"  rel="tooltip" class="btn btn-info"  data-created="{{$incident->created_at}}">
                                             <i class="uil-pen"></i>
                                           </a>--}}

                                                    <form method="get" action="{{url('officeInfo')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <input type="hidden" name="description" value="{{$item->name}}">
                                                    <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                            </form>
                                        </td> -->
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </form>
                            </table>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
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