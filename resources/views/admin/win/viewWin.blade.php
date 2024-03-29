
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Win</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Edit Wins</h4>
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
                                        <th>Customer Type</th>
                                        <th>Win Type</th>
                                        <th>Amount</th>
                                        <th>status</th>
                                        <th>Ticket Id</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($wins))
                                    @foreach($wins as $data)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$data->customer_name}}',
                                                '{{$data->customer_id}}', '{{$data->amount}}', '{{$data->win_id}}','{{$data->customer_type}}',
                                                '{{$data->gender}}','{{$data->id}}','{{$data->win_type}}','{{$data->ticket_id}}')" 
                                                class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            </td>
                                            <td>{{$data->customer_name}}</td>
                                            <td>{{$data->customer_type}}</td>
                                            <td>{{$data->win_type}}</td>
                                            <td>{{$data->amount}}</td>
                                            <td>
                                                @if($data->status == 0)
                                                    <button type="button" class="btn btn-warning">Unclaimed</button>
                                                @else
                                                    <button type="button" class="btn btn-success">Claimed</button>
                                                @endif 
                                            </td>
                                            <td>{{$data->ticket_id}}</td>



                                            
                                            <td>
                                                <form method="get" action="{{url('updateanddeletewin')}}">
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
                        <form class="ps-3 pe-3" action="{{url('updateanddeletewin')}}" method="get">
                            @csrf
                            
                            <div class="form-group mt-2 mb-2">
                                <label for="">Customer<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select2" id = "customer_id" name="customer_id" data-toggle="select" required>
                                    <option>Select Customer</option>
                                        @if(isset($customers))
                                            @foreach($customers as $data)
                                            <option value="{{$data->id}}" >{{$data->name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>

                            
                            
                            <div class="form-group mt-2 mb-2">
                                <label for=""> Type<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id ="win_type" name="type" data-toggle="select" required>
                                
                                    <option>Select Type</option>
                                    <option value="VIRTUAL" >Virtual</option> 
                                    <option value="LIVE" >Live</option> 
                                   
                                </select>
                            </div>

                            

                            <div class="mb-3">
                                <label for="example-email" class="form-label">Ticket_id</label>
                                <input type="text" id="ticket_id" name="ticket_id" class="form-control" placeholder="ticket id"required>
                            </div>

                            <input type="hidden" id="customer_type" name="customer_type" class="form-control" required>
                            

                            <input type="hidden" id="win_id" name="id" class="form-control" required>

                            <div class="mb-3">
                                <label for="example-email" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="amount"required>
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


    function toggleModal(customer_name,customer_id,amount,win_id,customer_type,gender,id,win_type,ticket_id){
       

       
           document.getElementById("customer_id").value=customer_id; 
          document.getElementById("customer_id").text=customer_name; 
          document.getElementById("customer_type").value=customer_type; 
           document.getElementById("amount").value=amount;


           document.getElementById("win_id").value=win_id;
          document.getElementById("win_type").value=win_type;
          document.getElementById("ticket_id").value=ticket_id;
          
    }

  
 </script>

@endsection






