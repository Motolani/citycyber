
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Customer</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Edit Customer</h4>
            </div>
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
                    <p class="text-muted font-14">
                        Below are the lists of Customer Created 
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Customer Name</th>
                                        <th>Type</th>
                                        <th>Gender</th>
                                        <th>Created By</th>
                                        <th>Delete</th>
                                
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($customers))
                                    @foreach($customers as $data)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$data->customer_name}}','{{$data->type}}', '{{$data->gender}}','10/10/2020','2','{{$data->office_name}}','{{$data->office_id}}')"  class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            
                                            </td>
                                            <td>{{$data->customer_name}}</td>
                                            <td>{{$data->type}}</td>
                                            <td>{{$data->gender}}</td>
                                            <td>{{$data->firstname}}</td>

                                            <td>
                                                <form method="get" action="{{url('updateanddeletecustomer')}}">
                                                    @csrf
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        <button name = "submit" value = "delete" class="btn btn-danger btn-sm"><span class="uil-trash"></span></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
				                @endif
                                </tbody>
                            </table>                                           
                        </div> <!-- end preview-->
                    
                    </div> <!-- end tab-content-->
                    
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <div class="tab-content">
        <div class="tab-pane show active" id="modal-position-preview">
            <!-- Top modal content -->
            <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-top">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="topModalLabel">Edit Customer</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('updateanddeletecustomer')}}" method="get">
                            @csrf
                            
                            <div class="form-group mt-2 mb-2">
                                <label for="">Office<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id = "office_id" name="office_id" data-toggle="select" required>
                                    <option >Select Office</option>
                                        @if(isset($offices))
                                            @foreach($offices as $data)
                                            <option value="{{$data->id}}" >{{$data->name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>

                            <div class="form-group mt-2 mb-2">
                                <label for="">Type<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select2" id = "customer_type" name="customer_type" data-toggle="select" required>
                                    <option></option>
                                    <option>Select Type</option>
                                    <option value="shop" >Shop</option> 
                                    <option value="online" >Online</option> 
                                </select>
                            </div>


                            <div class="form-group mt-2 mb-2">
                                <label for="">Gender<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select2" id = "gender" name="gender" data-toggle="select" required>
                                    <option>Select Gender</option>
                                    <option value="male" >Male</option> 
                                    <option value="female" >Female</option> 
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="example-email" class="form-label">Customer Name</label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Customer Full Name"required>
                            </div>

                            <input type="hidden" id="id" name="id" required>

                            <div class="mb-3">
                                <label for="example-email" class="form-label">Date of Birth</label>
                                <input type="text" id="dob" name="dob" class="form-control" placeholder="dob. e.g. dd/mm/yyyy"required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name = "submit" value = "update" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- Right modal content -->
            
        </div> <!-- end preview-->
    </div> <!-- end tab-content-->


@endsection


@section('script')
 <script>


    function toggleModal(customer_name,type,gender,dob,id,office_name,office_id){
            console.log(customer_name,"type ",type," ",dob," ",id," ",office_name," ",office_id)
          document.getElementById("customer_name").value=customer_name;
          document.getElementById("customer_type").value=type; 
          document.getElementById("gender").value=gender;
          document.getElementById("dob").value=dob;
          document.getElementById("id").value=id;
          document.getElementById("office_id").value=office_name;
          document.getElementById("office_id").text="gshgsdhjgsj";
          
        //   document.getElementById("office_id").value=office_id;
          
    }

  
 </script>

@endsection






