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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Bonus</li>
                </ol>
            </div>
        <h4 class="page-title">BALANCE SHEET</h4>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">


                @if (isset($message))
                <div class="alert alert-success">
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>
                @endif

		        @if (\Session::has('message'))
                <div class="alert alert-success">
                        <ul>
                                <li>{!! \Session::get('message') !!}</li>
                        </ul>
                </div>
                @endif

                <p style="margin-top: 10px" class="text-muted font-14">
                    Balance Sheet
                </p>

                <div class="row">
                    <div class="col-5">
                        <h4>Search Balancesheet</h4>
                    </div>
                </div>
                <form action="{{route('view.balanceSheetPost')}}" method="POST">
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
                </form>
                
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link active">
                            Preview
                        </a>
                    </li>
                </ul> <!-- end nav-->
                @if (isset($startDate))
                        <div class="pr-5">
                            <input value="{{ $startDate .' to '. $endDate}}" type="text" id="year" class="form-control" disabled>
                           
                        </div>
                    @endif
                <div class="tab-content">
                    <div class="tab-pane show active" id="buttons-table-preview">
                        <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th colspan="4">Name</th>
				                    <th>Asset</th>  
                                    <th>Liability</th>
				                    <th>View Detail</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
				                    <td colspan="4">Salary Advances</td>
                                    <td>-</td>
				                    <td>{{$totalSalaryAdvances}}</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.salaryAdvances')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Deductions</td>
                                    <td>{{$totalDeductions}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.deductions')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Loans</td>
                                    <td>{{$totalLoans}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.loans')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Bonuses</td>
                                    <td>-</td>
				                    <td>{{$totalBonuses}}</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.bonues')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Cash Advance</td>
                                    <td>-</td>
				                    <td>{{$totalCashAdvance}}</td>                    
                                    <td>
                                        <form method="get" action="{{ route('balanceSheet.detail.cashAdvance')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Lateness</td>
                                    <td>{{$totalLateness}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{ route('balanceSheet.detail.lateness')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Loss & Damages</td>
                                    <td>{{$totalLossDamages}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.lossDamages')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Offences</td>
                                    <td>{{$totalOffences}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.offences')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Office Stock</td>
                                    <td>{{$totalOfficeStocks}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.officeStocks')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Petty Cash</td>
                                    <td>-</td>
				                    <td>{{$totalPettyCash}}</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.pettyCash')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Pool Wallet</td>
                                    <td>{{$totalPoolWallet}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.poolWallet')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Cashier Wallet</td>
                                    <td>-</td>
				                    <td>{{$totalCashierWallet}}</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.cashierWallet')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Cash Reserve Wallet</td>
                                    <td>{{$totalCashReserveWallet}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.cashReserveWallet')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Shop Wallet</td>
                                    <td>{{$totalShopWallet}}</td>
				                    <td>-</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.shopWallet')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Wins</td>
                                    <td>-</td>
				                    <td>{{$totalWins}}</td>                    
                                    <td>
                                        <form method="get" action="{{ route('balanceSheet.detail.wins')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">Inventories </td>
                                    <td>-</td>
				                    <td>{{$totalInventoryStore}}</td>                    
                                    <td>
                                        <form method="get" action="{{route('balanceSheet.detail.inventoryStore')}}">
                                            @csrf
                                            <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
				                    <td colspan="4">TOTAL </td>
                                    <td>{{$totalAsset}}</td>
				                    <td >{{$totalLiability}}</td>                    
                                    <td>
                                        -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->
                
                {{-- <div class="tab-content">
                    <div class="tab-pane show active" id="modal-position-preview">
                        <div id="edit-modal1" class="modal fade" tabindex="-1"
                            role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-top">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="topModalLabel">Create Bonus
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form class="ps-3 pe-3"
                                        action="{{url('viewCreateBonus')}}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$user_id}}" >
                                            <label for="example-email" class="form-label">Staff Bonus</label>
                                            <select id="offe" class="form-control" name="bonus_id" data-toggle="select" required>
                                                
                                                <option value="">Select Bonus</option>
                                                @if(isset($bonuses))
                                                @foreach($bonuses as $bonus)
                                                <option value="{{$bonus->id}}">{{$bonus->bonus}}</option>
        
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Comment</label>
                                            <input type="text" id="example-email" name="comment" class="form-control" placeholder="Enter Comment" value="" required>
                                        </div>

                                        <button type="submit" name="submit" value = "createBonus"
                                            class="btn btn-primary mt-2 mb-2 ">Create Bonus
                                        </button>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div> --}}

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


@endsection


@section('script')
<script>





    $(function () {
        $(document).ready(function () {
            let aa = $('#h_div');
            console.log("h_div logger ----", aa);
            

            $("#createIncidence").click(function () {
                
                // let levels = $('#level').val();
                // let level = levels.split('|', 1)[0];
                // let levelName = levels.split('|', 2)[1];
                // $("#officeType").val(levelName);

                //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                // $("#parentOfficeId").val(level);
                // console.log("level_iddddPhil", level);
                getParent(1);



                //$("#kdd").html(total);
                //$("div").show();
            });
        });

        function getParent(level_id) {
            let url = "{{url('api/getOffences')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: { level: level_id },

                success: function (data) {
                    //$('#addons option:not(:first)').remove();
                    loadOffence(data);

                    console.log("response", data);
                },
                error: function (xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });

        }
        function loadOffence(data) {
            console.log('thisadata', data);
            $.each(data.data, function (key, offence) {
                console.log("offence", offence);
                let option = `<option value="${offence.id}"> ${offence.name}</option>`;
                console.log(option);
                $("#offence").append(option);
            });

            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }

    });

</script>

@endsection

