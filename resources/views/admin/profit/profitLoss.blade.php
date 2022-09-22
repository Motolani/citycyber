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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Profit And Loss</li>
                    </ol>
                </div>
                <h4 class="page-title">Profit And Loss</h4>
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
                            <h4>Search Profit and Loss Account</h4>
                        </div>
                    </div>
                    <form action="{{route('profitLossAccount')}}" method="POST">
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
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table class="table table-bordered bordered-info">
                                <thead>
                                    <tr>
                                        <th colspan="2">Income</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">Unclaimed Winnings</td>
                                        <td>{{$wins}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><b>Total Income</b></td>
                                        {{-- <td></td> --}}
                                        <td>{{$totalIncome}}</td>
                                    </tr>
                                    <tr aria-rowspan="2">
                                        <td colspan="2"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr aria-rowspan="2">
                                        <td ></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <tr>
                                            <td colspan="2"><b>Expenses</b></td>
                                            <td scope="col"><b>Amount</b></td>
                                            <td scope="col"></td>
                                        </tr>
                                    </tr>
                                        
                                        <tr>
                                            <td colspan="2">Rents</td>
                                            <td>{{$rents}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Bills</td>
                                            <td>{{$bills}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><b>Total Expenses</b></td>
                                            {{-- <td></td> --}}
                                            <td>{{$totalExpenses}}</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2"></td>
                                            <td rowspan="2"></td>
                                            <td rowspan="2"></td>
                                        </tr>
                                        <tr>
                                            <tr>
                                                <td colspan="2"><b>Profit / Loss</b></td>
                                                <td></td>
                                                <td>{{$profit_or_loss}}</td>
                                            </tr>
                                        </tr>
                                        
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


