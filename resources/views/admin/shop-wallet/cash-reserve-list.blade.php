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
                <h4 class="page-title">Cash Reserves</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">List of all Cash Reserves</h4>
{{--                <a href="/cashier/add" aria-expanded="false" class="btn btn-success">--}}
{{--                        Add New--}}
{{--                    </a>--}}
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div @endif <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Staff</th>
                                    <th>Office</th>
                                    <th>Balance</th>
                                    <th>Wallet Code</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($cashReserves))
                                    @foreach($cashReserves as $item)
                                        <tr>
                                            <td>{{$item->branchManager->firstname}}</td>
                                            <td>{{$item->office->name}}</td>
                                            <td>{{$item->balance}}</td>
                                            <td>{{$item->wallet_code}}</td>
                                            <td>
{{--                                                <a href="/cashier/fund/{{$item->id}}" class="btn btn-success btn-sm">--}}
{{--                                                    <span class="uil-envelope-add"></span> Fund--}}
{{--                                                </a>--}}
                                                <a href="/cash-reserve/callback/{{$item->id}}" class="btn btn-warning btn-sm">
                                                    <span class="uil-backward"></span> Callback
                                                </a>
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