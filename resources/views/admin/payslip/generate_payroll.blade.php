

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
                <h4 class="page-title">View Payroll</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <h4>Search Payroll</h4>
                        </div>
                    </div>
                    <form action="{{route('queryPayroll')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">From:</label>
                                    <select name="from" class="form-control">
                                        <option value="01">January</option>
                                        <option value="02">Febuary</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">To:</label>
                                    <select name="to" class="form-control">
                                        <option value="01">January</option>
                                        <option value="02">Febuary</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Year:</label>
                                    <input name="year" type="text" id="year" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mt-3">
                                    <button type="submit" class= "btn btn-primary">submit</button>
                                </div>
                            </div>                    
                        </div>
                    </form> <!-- end nav-->
                    
                        

                            <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <!-- <th><input type="checkbox" id="all" /></th> -->
                                    <!-- <th>Issuer</th> -->
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th></th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>

                                    <tbody>
                                    @if(isset($payRolls))
                                        @foreach($payRolls as $payRoll)
                                            <tr>
                                                <td>{{$payRoll->created_at}}</td>
                                                <td>{{$payRoll->firstname." ".$payRoll->lastname}}</td>
                                                <td></td>
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
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

    @include('admin.includes.view-pending-scripts');

@endsection