@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">View Pending Petty Cash</h4>
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
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <form action="{{route('bulkActionPettyCash')}}" method="POST" id="form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="action" value="" id="bulkActionField" />
                                    <tbody>
                                    @if(isset($items))
                                        @foreach($items as $item)
                                            <tr>
{{--                                                <td><input type="checkbox" class="checkable" name="items[]" value="{{$item->id}}" /></td>--}}
                                                <td>{{$item->staff->firstname}}</td>
                                                <td>{{$item->ticket_id}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>
                                                    @if($item->status == 'pending')
                                                        <a href="/pettycash/approve/{{$item->id}}" class="btn btn-primary btn-sm accept"><span class="uil-check"></span></a>
                                                        <a href="/pettycash/deny/{{$item->id}}" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </form>
                            </table>

{{--                            <button class="btn btn-primary btn-sm" id="bulkAccept"><span class="uil-check"></span>Accept Selected</button>--}}
{{--                            <button class="btn btn-danger btn-sm" id="bulkDeny"><span class="uil-multiply"></span>Deny Selected</button>--}}


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