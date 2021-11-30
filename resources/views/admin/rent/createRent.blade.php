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
                    <li class="breadcrumb-item active">Rent</li>
                </ol>
            </div>
            <h4 class="page-title">Rents</h4>
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
                <h4 class="header-title">Create Rents</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <form action = "{{route('storeCreateRent')}}" method = "POST"> 
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Office Name</label>
                                        <select class="form-control select2" name="office_name" id="office_name">
                                            <option>Select Office Name</option>
                                            @if(isset($offices))
                                                @foreach($offices as  $office)
                                                    <option value="{{$office->id}}">{{$office->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Office Address</label>
                                        <input name="office_address" type="text" id="add" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Office Phone Number</label>
                                                <input name="phone_number" type="text" id="phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Amount Paid</label>
                                                <input name="amount_paid" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-control " name="rent_type" id="type">
                                            <option>Select Type</option>
                                            <option value="rent">Rent</option>
                                            <option value="lease">Lease</option>
                                            <option value="owned_property">Owned Property</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tenure</label>
                                                <input name="tenure" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3" id="duration">
                                                <label class="form-label">Duration</label>
                                                <select class="form-control " name="duration">
                                                    <option value="">Select Duration</option>
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
                                            <div class="mb-3" id="date_paid">
                                                <label class="form-label">Date Paid</label>
                                                <input name="date_paid" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3" id="renewal_date">
                                                <label class="form-label">Renewal Date</label>
                                                <input name="renewal_date" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <br>

                                    <h3>Landlord / Caretaker's Information</h3>
                                    <br>
                                    <br>

                                    <div class="mb-3">
                                        <label class="form-label">Landlord / Caretaker's Name</label>
                                        <select class="form-control select2" name="landlord_name" id="landlord_name">
                                            <option>Select Landlord/Caretaker's Name</option>
                                            @if(isset($reals))
                                                @foreach($reals as  $real)
                                                    <option value="{{$real->name}}">{{$real->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Landlord / Caretaker's Phone Number</label>
                                                <input name="landlord_phone" type="text" id="landlord_phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Landlord / Caretaker's Email</label>
                                                <input name="landlord_email" type="text" id="landlord_email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Landlord / Caretaker's Address</label>
                                        <input name="landlord_address" type="text" id="landlord_address" class="form-control">
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
    <script>
        $(document).ready(function(){
            $("#type").change(function(){
                if($(this).val() == "owned_property"){
                    $("#duration").hide();
                    $("#renewal_date").hide();
                }else{
                    $("#duration").show();
                    $("#renewal_date").show();
                }
            });
            $("#duration").show();
            $("#renewal_date").show();
        });
    </script>


    <script type="text/javascript"> 

        var offices= {!! $offices !!};

        console.log("offices", offices);

    
        $(document).ready(function() {
            $("#office_name").change(function() {
                let id = parseInt($("#office_name").val())
                console.log("id ", id)
                
                let response= (offices.find(item=>item.id===id))
                console.log("find by id",  response)
                console.log("office_address ", response.location)

                $("#add").val(response.location);
                $("#phone").val(response.phone);
                
            });
        });

    
    </script>
        
    <script>
        var reals= {!! $reals !!};

        console.log("reals", reals);

        $(document).ready(function() {
            $("#landlord_name").change(function() {
                let id = parseInt($("#landlord_name").val())
                console.log("id ", id)
                
                let response= (reals.find(item=>item.id===id))

                $("#landlord_phone").val(response.phone_number);
                $("#landlord_email").val(response.email);
                $("#landlord_address").val(response.address);
                
            });
        });

    </script>

@endsection





