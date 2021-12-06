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
                        {{-- <div class="col-12"> --}}
                            <h4>Search Profit and Loss</h4>
                        {{-- </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">From:</label>
                                <select name="from" class="form-control">
                                    <option value="1">January</option>
                                    <option value="2">Febuary</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
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
                                    <option value="1">January</option>
                                    <option value="2">Febuary</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
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
                            <div class="mb-3">
                                <input name="year" type="text" id="year" class="form-control">
                            </div>
                        </div>
                    </div>

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


