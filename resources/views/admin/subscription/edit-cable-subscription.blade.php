
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
                <h4 class="page-title ">Update Cable Subscription</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Update subscription
                    </h4>
                        {{-- <div class="col-md-2 offset-md-10">

                            <a href="{{url('/')}}" class="btn btn-outline-primary float-right">Back to index</a>
                        </div> --}}
                    <p class="text-muted font-14">
                        Here you can update the  branch office, cable tv and cable plan e.t.c
                    </p>
                    
                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{url('update-cable-subscription')}}">
                                @csrf
  
                                <div class="row ">
                                    <div class="col-md-6 mb-3">
                                    <label for="card number">Smart Card Number</label>
                                 {{--<select  name="smart_card" class="form-select form-control" >
                                        @foreach($cableproviders as  $row)
                                        <option  value="{{$row->smart_card}}">{{$row->smart_card}}</option>
                                        @endforeach  
                                      </select>--}}
                                        <input type="number" min="0" name="smart_card" value="{{$cablesubscription->smart_card}}" class="form-control" placeholder="enter smart card number">
                                        <input type = "hidden" name = "id" value="{{$cablesubscription->id}}">
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="branch ">Branch Office</label>
                                     {{--  <select  name ="branch_office" class="form-select form-control" >
                                      @foreach($getOffice as  $office)
                                        <option  value="{{$office->name}}">{{$office->name}}</option>
                                        @endforeach 
                                      </select>  --}}
                                      <input type="text" name="branch_office" value="{{$cablesubscription->branch_office}}" class="form-control" placeholder="Enter smart number">
                                    </div> 

                                    <div class="col-md-6 mb-3">
                                     <label for="cable type">Cable Type</label>
                                      {{--  <select  name="cable_tv_type" class="form-select form-control" >
                                       @foreach($cabletype as $row)
                                        <option  value="{{$row->cable_type_name}}">{{$row->cable_type_name}}</option>
                                        @endforeach 
                                      </select>  --}}
                                      <input type="text" name="cable_tv_type"  value="{{$cablesubscription->cable_tv_type}}"class="form-control" placeholder="cable type">
                                    </div>

                                    <div class="col-md-6 mb-3 mb-3">
                                    <label for="cable plane">Cable Plan Type</label>
                                    {{-- <select  name="cable_plan" class="form-select form-control" >
                                        @foreach($getPlan as $row)
                                        <option  value="{{$row->cable_plan_name}}">{{$row->cable_plan_name}}</option>
                                        @endforeach 
                                      </select> --}}
                                      <input type="text" name="cable_plan"  value="{{$cablesubscription->cable_plan}}"class="form-control" placeholder="cable type">
                                    </div>
                                     
                                    <div class="col-md-4 mb-3">
                                        <label for="card number">Amount</label>
                                         <input type="number" min="0" name="amount" value="{{$cablesubscription->amount}}"class="form-control" placeholder="enter amount" autocomplete="off">
                                      </div>
                                        <div class="col-md-4 mb-3  ">
                                            <label for="card number">Subscription Date</label>
                                            <input type="text" id="subdate" name="subscription_date" value="{{$cablesubscription->subscription_date}}" class="form-control" placeholder="Click to enter subscription date" autocomplete="0ff">     
                                            {{-- <input type="number"  name="subscription_date" id='datetimepicker1' class="form-control" placeholder="enter subscription date"> --}}
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="card number">Expiring date</label>
                                            <input type="text"   name="expiring_date"  value="{{$cablesubscription->subscription_date}}"  id="expdate"$getOffice class="form-control" placeholder="Click to enter expiring date" autocomplete="0ff">     
                                            {{-- <input type='date' class="form-control"  name="expiring_date" placeholder="enter expiring date"> --}}

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="card number">Remarks</label>
                                            <input type="text"  name="remarks" value="{{$cablesubscription->remarks}}" class="form-control" placeholder="Click to enter remarks" autocomplete="0ff">     
                                            

                                        </div>
                                        

                                    <div class="col-md-12 mb-3">
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('/cable-subscription-index')}}" class="btn btn-outline-primary float-right">Back to index</a>
                                        <button type="submit" class="btn btn-primary">Update Subscription</button>
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










