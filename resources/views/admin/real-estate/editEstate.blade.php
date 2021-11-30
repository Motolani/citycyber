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
                    <li class="breadcrumb-item active">Real Estate</li>
                </ol>
            </div>
            <h4 class="page-title">Real Estate</h4>
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
                <h4 class="header-title">Edit Real Estate</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <form action = "{{route('updaterealestate', $real->id)}}" method = "POST"> 
                                    @csrf
                                    
                                    <h3>Landlord / Caretaker's Information</h3>
                                    <br>
                                    <br>
                                    
                                    <div class="mb-3">
                                        <label class="form-label"> Name</label>
                                        <input name="name" type="text" value="{{$real->name}}" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Phone Number</label>
                                                <input name="phone_number" type="text" value="{{$real->phone_number}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label">Type</label>
                                                <select class="form-control " name="type">
                                                    <option value="">Select Type</option>
                                                    <option value="landlord" {{$real->type == 'landlord' ? 'selected' : ''}}>Landlord</option>
                                                    <option value="caretaker" {{$real->type == 'caretaker' ? 'selected' : ''}}>Caretaker</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label"> Email</label>
                                                <input name="email" type="text" value="{{$real->email}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"> Address</label>
                                        <input name="address" type="text" value="{{$real->address}}" class="form-control">
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




