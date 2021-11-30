@extends('admin.layout')
@section('title')
Dashboard
@endsection
@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">CityCyber</a></li>
                    <li class="breadcrumb-item"><a href="#">Property Mgt</a></li>
                    <li class="breadcrumb-item active">Bills</li>
                </ol>
            </div>
            <h4 class="page-title">Bills</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row justify-content-center">
    <div class="col-9">
        <div class="card">
            <div class="card-body">

                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            
                                <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <h4 class="header-title">Create Bills</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <form action = "{{route('storecreateBill')}}" method = "POST"> 
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Office Name</label>
                                        <select class="form-control select2" name="office_name" id="office_name" >
                                            <option>Select Office Name</option>
                                            @if(isset($offices))
                                                @foreach($offices as  $office)
                                                    <option value="{{$office->id}}" data-price="{{$office->address}}">{{$office->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Office Address</label>
                                        <input name="office_address" type="text" id="add" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Office Phone Number</label>
                                                <input name="phone_number" type="text" id="phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Amount Paid</label>
                                                <input name="amount_paid" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Type</label>
                                                <select class="form-control " name="bill_type" id="type">
                                                    <option value="">Select Bill Type</option>
                                                    <option value="environmental">Environmental Bill</option>
                                                    <option value="security">Security Bill</option>
                                                    <option value="utilities">Utilities Bills</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tenure</label>
                                                <input name="tenure" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Duration</label>
                                                <select class="form-control " name="duration">
                                                    <option>Select Duration</option>
                                                    <option value="1 month">1 Month</option>
                                                    <option value="2 month">3 Month</option>
                                                    <option value="3 month">6 Month</option>
                                                    <option value="1 year">1 Year</option>
                                                    <option value="2 years">2 Years</option>
                                                    <option value="5 years">5 Years</option>
                                                    <option value="10 years">10 Years</option>
                                                    <option value="15 years">15 Years</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date Paid</label>
                                                <input name="date_paid" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Renewal Date</label>
                                                <input name="renewal_date" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-auto">
                                        <button type="submit" name = "submit" value = "create" style="float: right" class="btn btn-primary mb-9">Submit</button>
                                    </div>
                            
                                </form>
                            </div> <!-- end col -->

                            
                        </div>
                        <!-- end row-->                      
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->



@endsection


@section('script')
    <script type="text/javascript"> 

       var offices= {!! $offices !!};

       console.log("offices", offices);

       
          $(document).ready(function() {
            $("#office_name").change(function() {
                let id = parseInt($("#office_name").val())
                console.log("id ", id)
                
                let response= (offices.find(item=>item.id===id))
                console.log("find by id",  response)
                console.log("office_address ", response.locagtion)

                $("#add").val(response.location);
                $("#phone").val(response.phone);
                
            });
        });

      
    </script>
@endsection





