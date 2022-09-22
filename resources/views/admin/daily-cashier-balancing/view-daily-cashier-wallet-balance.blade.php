
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Office</li>
                    </ol>
                </div>
                <h4 class="page-title ">Create Cashier Daily Cash</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Create cashier daily cash balancing form
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here the sport cashier create a sport daily cash balancing 
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('store-daily-cashier-wallet-balance')}}">
                                @csrf
                              
                                <div class="row ">
                                    
                                    <div class="col-md-4 mb-3 mb-3 ">
                                    <label for="branch ">Branch Office</label>
                                    <span class="text-primary">
                                        <p><b>{{$getOffice->name}}</b></p>
                                       </span>
                                      
                                    </div> 

                                    <div class="col-md-4 mb-3 ">
                                     <label for="cashier">Cashier Name</label>
                                     <span class="text-primary">
                                     <p><b>{{Auth::user()->firstname}}</b></p>
                                    </span>
                                    </div>
                                   
                                    <div class="col-md-4 mb-3 mb-3">
                                        <label for="cable plane">Dates</label>
                                        <span class="text-primary">
                                            <b>{{ $dailycashierbalancing->date}}</b>
                                        </span>
                                     
                                    </div>
                                    {{-- drawer row --}}
                                    <div class="row">
                                        <div class="col-md-6 border">
                                        <h4 class="text-primary text-align:center ">BREAKDOWN OF CASH REMIT</h4>
                                        <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>1000 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->one_thousand}}</b>
                                                            </span>
                                                    </div>
                                                        {{-- <label for="oneThousand"><b>&#8358;</b>1000</label>
                                                        <input type="number" min="0" name="one_thousand" value="{{old('one_thousand')}}" class="form-control" placeholder="Enter quantity">  --}}
                                                    </div>
                                                    <div class="col-md-6 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>500 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->five_hundred}}</b>
                                                            </span>
                                                    </div>
                                                    {{-- <label for="fiveHundred "><b>&#8358;</b>500</label>
                                                    <input type="number" min="0" name="five_hundred" value="{{old('five_hundred')}}"class="form-control" placeholder="Enter quantity ">  --}}
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>200 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->two_hundred}}</b>
                                                            </span>
                                                    </div>
                                                        {{-- <label for="oneThousand"><b>&#8358;</b>1000</label>
                                                        <input type="number" min="0" name="one_thousand" value="{{old('one_thousand')}}" class="form-control" placeholder="Enter quantity">  --}}
                                                    </div>
                                                    <div class="col-md-6 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>100 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->one_hundred}}</b>
                                                            </span>
                                                    </div>
                                                    {{-- <label for="fiveHundred "><b>&#8358;</b>500</label>
                                                    <input type="number" min="0" name="five_hundred" value="{{old('five_hundred')}}"class="form-control" placeholder="Enter quantity ">  --}}
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>50 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->fifty_naira}}</b>
                                                            </span>
                                                    </div>
                                                        {{-- <label for="oneThousand"><b>&#8358;</b>1000</label>
                                                        <input type="number" min="0" name="one_thousand" value="{{old('one_thousand')}}" class="form-control" placeholder="Enter quantity">  --}}
                                                    </div>
                                                    <div class="col-md-6 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>20 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->twenty_naira}}</b>
                                                            </span>
                                                    </div>
                                                    {{-- <label for="fiveHundred "><b>&#8358;</b>500</label>
                                                    <input type="number" min="0" name="five_hundred" value="{{old('five_hundred')}}"class="form-control" placeholder="Enter quantity ">  --}}
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>10 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->ten_naira}}</b>
                                                            </span>
                                                    </div>
                                                        {{-- <label for="oneThousand"><b>&#8358;</b>1000</label>
                                                        <input type="number" min="0" name="one_thousand" value="{{old('one_thousand')}}" class="form-control" placeholder="Enter quantity">  --}}
                                                    </div>
                                                    <div class="col-md-6 mb-3 ">
                                                        <div class="form-group">
                                                            <label for="oneThousand"><b>&#8358;</b>5 :</label>
                                                            <span class="text-primary">
                                                            <b>{{ $dailycashierbalancing->five_naira}}</b>
                                                            </span>
                                                    </div>
                                                    {{-- <label for="fiveHundred "><b>&#8358;</b>500</label>
                                                    <input type="number" min="0" name="five_hundred" value="{{old('five_hundred')}}"class="form-control" placeholder="Enter quantity ">  --}}
                                                </div>

                                                <div class="form-group row">

                                                    <div class="form-group">
                                                        <label for="totalCash"><b>TOTAL CASH &#8358;</b> :</label>
                                                        <span class="text-primary">
                                                        <b>{{ $dailycashierbalancing->total_cash}}</b>
                                                        </span>
                                                    </div>
                                                    
                                                </div>

                                        </div>

                                    </div>
                                    


                                     {{-- book keeping row --}}
                                        <div class="col-md-6 border">

                                            <div class="form-group row mb-3 mt-3">
                                                <div class="form-group">
                                                    <label for="totalCash"><b>TOTAL STAKE &#8358;</b> :</label>
                                                    <span class="text-primary">
                                                    <b>{{ $dailycashierbalancing->total_stake}}</b>
                                                    </span>
                                                </div>
                                                
                                          </div>

                                        <div class="form-group row">

                                            <div class="form-group mb-3">
                                                <label for="totalCash"><b>TOTAL BET NUMBER</b> :</label>
                                                <span class="text-primary">
                                                <b>{{ $dailycashierbalancing->total_bet_number}}</b>
                                                </span>
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row">
                                            <div class="form-group mb-3">
                                                <label for="totalCash"><b>TOTAL BET CASH  &#8358;</b>:</label>
                                                <span class="text-primary">
                                                <b>{{ $dailycashierbalancing->total_cash_bet}}</b>
                                                </span>
                                            </div>
                                           
                                        </div>
                                        {{-- <h5 class="text-primary text-align:center ">(CASH TOTAL PLUS(+) TOTAL OTHER CASH)</h5>
                                        <h5 class="text-primary text-align:center ">EQUALS(=)</h5> --}}

                                        <div class="form-group row">
                                            <div class="form-group mb-3">
                                                <label for="totalCash"><b>TOTAL CASH REMIT  &#8358;</b>:</label>
                                                <span class="text-primary">
                                                <b>{{ $dailycashierbalancing->total_cash_remit}}</b>
                                                </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    </div>
                                     <div class="row">
                                           
                                            <div class="col-md-12 mt-3 mb-3">
                                                
                                                <h5 class="text-primary ">CASHIER FUNDING</h5>
                                             {{-- <p>{{$cashier_fund_request->amount}}</p>  --}}
                                             <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                <tr>
                                                    <th>Date Created</th>
                                                    <th>Funding Amount</th>
                                                    <th>Description</th>
                                                    <th>Staus</th>
                                                </tr>
                                                </thead>
                                                
                                                <tbody>
                                                 @if(isset($cashier_fund_request))
                                                      @foreach($cashier_fund_request as $row)
                                                    <tr>
                                                    <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>
                                                      <td>{{$row->amount}}</td> 
                                                      <td>{{$row->description}}</td>
                                                      <td>{{$row->status}}</td>
                                                    </tr>
                                                      @endforeach
                                                @endif 
                                                </tbody>
                                            </table>
                                            </div> 
                                            {{-- <div class="col-md-12 mt-3 mb-3"> --}}
                                                {{-- this workfor the get method --}}
                                               
                                                 {{-- @foreach ($cashier_fund_request as $row )
                                                    <label for="funding">SECOND FUNDING</label>
                                                    <p>{{date('d-m-Y', strtotime($row->created_at))}}--<b>&#8358;</b>:{{$row->amount}}</p>
                                                @endforeach 
                                                --}}
                                                {{-- <input type="text" name="date" id="expdate" value="{{old('amount')}}" class="form-control" placeholder="" autocomplete="0ff"> --}}


                                               
                                            {{-- </div> --}}
                                    </div>
                                         
                                    <div class="col-md-12 mb-3 mt-3">
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('/daily-cashier-wallet-balance-index')}}" class="btn btn-outline-primary float-right">Go Back</a>
                                        <button type="submit" class="btn btn-primary">Send To Printer</button>
                                    </div>
                                    </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
 @section('script')
<script type="text/javascript">
  
$(document).ready(function () {
                $('#subdate').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });

                $('#expdate').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });
            });
 </script>
@endsection 









