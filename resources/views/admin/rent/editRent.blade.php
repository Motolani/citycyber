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
                <h4 class="header-title">Edit Rents</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <form action = "{{route('updateRent', $rec->id)}}" method = "POST"> 
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="mb-3">
                                        <label class="form-label">Office Name</label>
                                        <select class="form-control select2" name="office_name">
                                            <option value="">Select Office Name</option>
                                            @if(isset($offices))
                                                @foreach($offices as  $office)
                                                    <option value="{{$office->id}}" @if($rec->office_name == $office->id) selected="selected"@endif>{{$office->name}}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label class="form-label">Office Address</label>
                                        <input name="office_address" type="text" value="{{$rec->office_address}}" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Office Phone Number</label>
                                                <input name="phone_number" type="text" value="{{$rec->phone_number}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Amount Paid</label>
                                                <input name="amount_paid" type="text" value="{{$rec->amount_paid}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <select class="form-control " name="rent_type" id="type">
                                            <option>Select Type</option>
                                            <option value="rent" {{$rec->rent_type == 'rent' ? 'selected' : ''}}>Rent</option>
                                            <option value="lease" {{ $rec->rent_type == 'lease' ? 'selected' : '' }}>Lease</option>
                                            <option value="owned_property" {{ $rec->rent_type == 'owned_property' ? 'selected' : '' }}>Owned Property</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tenure</label>
                                                <input name="tenure" type="text" value="{{$rec->tenure}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Duration</label>
                                                <select class="form-control " name="duration">
                                                    <option>Select Duration</option>
                                                    <option value="1 month" {{$rec->duration == '1 month' ? 'selected' : ''}}>1 Month</option>
                                                    <option value="2 month" {{$rec->duration == '2 month' ? 'selected' : ''}}>3 Month</option>
                                                    <option value="3 month" {{$rec->duration == '3 month' ? 'selected' : ''}}>6 Month</option>
                                                    <option value="1 year" {{$rec->duration == '1 year' ? 'selected' : ''}}>1 Year</option>
                                                    <option value="2 years" {{$rec->duration == '2 years' ? 'selected' : ''}}>2 Years</option>
                                                    <option value="5 years" {{$rec->duration == '5 years' ? 'selected' : ''}}>5 Years</option>
                                                    <option value="10 years" {{$rec->duration == '10 years' ? 'selected' : ''}}>10 Years</option>
                                                    <option value="15 years" {{$rec->duration == '15 years' ? 'selected' : ''}}>15 Years</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3" id="date_paid">
                                                <label class="form-label">Date Paid</label>
                                                <input name="date_paid" type="date"  value="{{$rec->date_paid}}"class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3" id="renewal_date">
                                                <label class="form-label">Renewal Date</label>
                                                <input name="renewal_date" type="date"  value="{{$rec->renewal_date}}"class="form-control">
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
                                        <input name="landlord_name" type="text" value="{{$rec->landlord_name}}" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Landlord / Caretaker's Phone Number</label>
                                                <input name="landlord_phone" type="text" value="{{$rec->landlord_phone}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Landlord / Caretaker's Email</label>
                                                <input name="landlord_email" type="text" value="{{$rec->landlord_email}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Landlord / Caretaker's Address</label>
                                        <input name="landlord_address" type="text" value="{{$rec->landlord_address}}" class="form-control">
                                    </div>

                                   
                                    <div class="col-auto">
                                        <button type="submit" name = "submit" value = "create" style="float: right" class="btn btn-primary mb-9">Update</button>
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
@endsection



