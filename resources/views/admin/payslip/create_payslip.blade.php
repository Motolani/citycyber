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
                <h4 class="page-title">View {{$users->firstname ." ".$users->lastname}}'s Payslip</h4>
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
                                    class="uil-plus"></span>Create Payslip </button> 
                    

                    <div class="tab-content">
                        <div class="tab-pane show active" id="modal-position-preview">
                            <div id="create-modal" class="modal fade" tabindex="-1"
                                role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-top">
                                    <div class="row">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="topModalLabel">Create Payslip for {{$users->firstname ." ".$users->lastname }}
                                                </h4>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('staffdetails')}}" class="form-container" method="post">
                                            <!-- <form method="POST" action="{{route('createstaff')}}"> -->
                                                @csrf
                                                <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{isset($user_id)?$user_id:NULL}}" >
                                                <div class="mb-3">
                                                    <label class="form-label">basic salary</label>
                                                    <input name="basic_salary" type="number" class="form-control" value="{{isset($staffSalary)}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">advance</label>
                                                    <select class="js-example-basic-multiple" name="advances[]" multiple="multiple">
                                                        <option value="0">select Advances</option>
                                                        @if($advances)
                                                            @foreach($advances as $advance)
                                                                <option>{{$advance->amount}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Bonus</label>
                                                    <select class="js-example-basic-multiple" name="bonuses[]" multiple="multiple">
                                                        <option value="0">select Bonuses</option>
                                                        @if($bonuses)
                                                            @foreach($bonuses as $bonus)
                                                                <option>{{$bonus->bonuses->amount}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label select-label">offence</label>
                                                    <select class="js-example-basic-multiple" name="offences[]" multiple="multiple">
                                                        <option value="0">select Offences</option>
                                                        @if($offences)
                                                            @foreach($offences as $offence)
                                                                <option>{{$offence->offences->amount}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                <div class="mb-3">
                                                    <label class="form-label select-label">Deduction</label>
                                                    <select class="js-example-basic-multiple" name="deductions[]" multiple="multiple">
                                                        <option value="0">select Deduction</option>
                                                    @if($deductions)
                                                        @foreach($deductions as $deduction)
                                                            <option>{{$deduction->deductions->amount}}</option>
                                                        @endforeach
                                                    @endif
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Allowance</label>
                                                    <select name="allowance" class="form-control">
                                                        <option value="0">select allowance</option>
                                                        @if($allowances)
                                                            @foreach($allowances as $allowance)
                                                                <option>{{$allowance->allowances->amount}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Pension</label>
                                                    <input type="pension" placeholder="Enter pension" class="form-control" name="pension" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label"> Tax</label>
                                                    <input type="tax" placeholder="Enter tax" class="form-control" name="tax" required>
                                                    
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Loan</label>
                                                    <select name="loan" class="form-control">
                                                        <option value="0">select loan</option>
                                                        @if($loans)
                                                            @foreach($loans as $loan)
                                                                <option >{{$loan->loans->amount}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                {{-- <div class="mb-3">
                                                    <label class="form-label">Net Salary</label>
                                                    <input type="number" placeholder="Enter net_salary" name="net_salary" class="form-control" required>    
                                                </div> --}}

                                                

                                                <button class="btn btn-primary" name="proceeds" id="submit">Save</button>

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
                                    <!-- <th><input type="checkbox" id="all" /></th> -->
                                    <!-- <th>Issuer</th> -->
                                    <th>Date</th>
                                    <th>Basic Salary</th>
                                    <th>Advance</th>
                                    <th>Allowance</th>
                                    <th>Bonus</th>
                                    <th>Deduction</th>
                                    <th>Offence	</th>
                                    <th>Pension</th>
                                    <th>Tax</th>
                                    <th>Loan</th>
                                    <th>Net Salary</th>

                                    {{-- <th>Action</th> --}}
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($payslips))
                                        @foreach($payslips as $payslip)
                                            <tr>
                                                <!-- <td><input type="checkbox" class="checkable" name="items[]" value="{{$payslip->id}}" /></td> -->
                                                <!-- <td>{{$payslip->created_at}}</td> -->
                                                <td>{{$payslip->created_at}}</td>
                                                <td>{{$payslip->basic_salary}}</td>
                                                <td>{{$payslip->advance}}</td>
                                                <td>{{$payslip->allowance}}</td>
                                                <td>{{$payslip->bonus}}</td>
                                                <td>{{$payslip->deduction}}</td>
                                                <td>{{$payslip->offence}}</td>
                                                <td>{{$payslip->pension}}</td>
                                                <td>{{$payslip->tax}}</td>
                                                <td>{{$payslip->loan}}</td>
                                                <td>{{$payslip->net_salary}}</td>
                                                <td>
                                                    <form action="{{route('deletePayslip', $payslip->id)}} "method="POSt">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{$payslip->id}}">
                                                        <button type="delete" class="btn btn-danger">X</button>
                                                    </form>
                                                </td> 
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
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
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

    @include('admin.includes.view-pending-scripts');

@endsection
