
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
                    <h4 class="header-title" style = "">Create  daily cashier balancing form
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
                                        <input type="text" name="date" id="expdate" value="{{old('date')}}" class="form-control" placeholder="Click to enter  date" autocomplete="0ff">     
                                    {{-- <p>{{$getOffice->name}}</p>  --}}
                                     
                                    </div>
                                    {{-- drawer row --}}
                                    <div class="row">
                                        <div class="col-md-6 border">
                                        <h4 class="text-primary text-align:center ">BREAKDOWN OF CASH REMIT</h4>
                                        <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="oneThousand"><b>&#8358;</b>1000</label>
                                                    <input type="number" min="0" name="one_thousand" value="{{old('one_thousand')}}" class="form-control" placeholder="Enter quantity"> 
                                                </div>
                                                <div class="col-md-6 mb-3 ">
                                                    <label for="fiveHundred "><b>&#8358;</b>500</label>
                                                    <input type="number" min="0" name="five_hundred" value="{{old('five_hundred')}}"class="form-control" placeholder="Enter quantity "> 
                                                </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3 ">
                                                <label for="twoHundred"><b>&#8358;</b>200</label>
                                                <input type="number" name="two_hundred" value="{{old('two_hundred')}}" class="form-control" placeholder="Enter quantity "> 
                                            </div>
                                            <div class="col-md-6 mb-3 ">
                                                <label for="branch "><b>&#8358;</b>100</label>
                                                <input type="number" min ="0" name="one_hundred"   value="{{old('one_hundred')}}"class="form-control" placeholder="Enter quantity "> 
                                            </div>

                                    </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3 ">
                                                <label for="fiftyNaira"><b>&#8358;</b>50</label>
                                                <input type="number" name="fifty_naira"  value="{{old('fifty_naira')}}" class="form-control" placeholder="Enter quantity "> 
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="branch "><b>&#8358;</b>20</label>
                                                <input type="number" min="0" name="twenty_naira"  value="{{old('twenty_naira')}}" class="form-control" placeholder="Enter quantity"> 
                                            </div>

                                        </div>
                                        <div class="row ">
                                                <div class="col-md-6 mb-3">
                                                    <label for="branch "><b>&#8358;</b>10</label>
                                                    <input type="number" min="0" name="ten_naira" value="{{old('ten_naira')}}" class="form-control" placeholder="Enter quantity "> 
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="branch "><b>&#8358;</b>5</label>
                                                    <input type="number" min="0" name="five_naira" value="{{old('five_naira')}}" class="form-control" placeholder="Enter quantity"> 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="totalcash" class="col-sm-4 col-form-label"><b>TOTAL CASH &#8358;</b>:</label>
                                            <div class="col-sm-8 mb-3">
                                              <input type="number" min="0" name="total_cash"  value="{{old('total_cash')}}" class="form-control"  placeholder="Total Cash">
                                            </div>
                                        </div>
                                       

                                        </div>

                                     {{-- book keeping row --}}
                                        <div class="col-md-6 border">

                                            <div class="form-group row  mt-3">
                                                <label for="totalstake" class="col-sm-4 col-form-label"><b>TOTAL STAKE</b>:</label>
                                                <div class="col-sm-8 mb-3">
                                                    <input type="number" min="0"  name="total_stake" value="{{old('total_stake')}}" class="form-control"  placeholder="Total stake">
                                                </div>
                                                
                                          </div>

                                        <div class="form-group row">
                                            <label for="totalcash" class="col-sm-6 col-form-label"><b>TOTAL BET NUMBER</b>:</label>
                                            <div class="col-sm-6 mb-3">
                                              <input type="number" min="0" name="total_bet_number"  value="{{old('total_bet_number')}}" class="form-control"  placeholder="Total bet number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="totalcash" class="col-sm-6 col-form-label"><b>TOTAL CASH TO BET</b>:</label>
                                            <div class="col-sm-6 mb-3">
                                              <input type="number" min="0" name="total_cash_bet" value="{{old('total_cash_bet')}}" class="form-control"  placeholder="Total cash To bet">
                                            </div>
                                        </div>
                                        {{-- <h5 class="text-primary text-align:center ">(CASH TOTAL PLUS(+) TOTAL OTHER CASH)</h5>
                                        <h5 class="text-primary text-align:center ">EQUALS(=)</h5> --}}

                                        <div class="form-group row">
                                            <label for="totalcash" class="col-sm-6 col-form-label"><b>TOTAL CASH REMIT(&#8358;)</b>:</label>
                                            <div class="col-sm-6 mb-3">
                                              <input type="number" min="0" name="total_cash_remit"  value="{{old('total_cash_remit')}}" class="form-control"  placeholder="Total cash remit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 mt-3">
                                    <div class="col-md-5 offset-md-7">
                                        <a href="{{url('/daily-cashier-wallet-balance-index')}}" class="btn btn-outline-primary float-right">Go Back </a>
                                        <button type="submit" class="btn btn-primary">Create daily sport cashier cash</button>
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









