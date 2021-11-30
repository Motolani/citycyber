
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
                <h4 class="page-title">Delete/Edit Payment</h4>
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
                        Below are the lists of Payment Created 
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Date </th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Payment Type</th>
                                        <th>Reference</th>
                                        <th>Customer Type</th>
                                        <th>Bank Name</th>
                                        <th>Delete</th>
                                
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($payments))
                                    @foreach($payments as $data)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$data->bank_name}}','{{$data->name}}', '{{$data->amount}}','{{$data->customer_name}}','{{$data->gender}}','{{$data->customer_type}}','{{$data->id}}')"  class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            
                                            </td>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>₦{{$data->amount}}</td>
                                            <td>{{$data->type}}</td>
                                            <td>{{$data->reference}}</td>
                                            <td>{{$data->customer_type}}</td>
                                            <td>{{$data->bank_name}}</td>



                                            
                                            <td>
                                                <form method="get" action="{{url('updateanddeletepayment')}}">
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
                                <label for="">Customer<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" value = "" id = "customer_id" name="customer_id" data-toggle="select" required>
                                    <option value = ""></option>
                                        @if(isset($customers))
                                            @foreach($customers as $data)
                                            <option value="{{$data->id}}" >{{$data->name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>

                            <div class="form-group mt-2 mb-2">
                                <label for="">Bank<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" value = "" id = "bank_id" name="bank_id" data-toggle="select" required>
                                    <option value = ""></option>
                                        @if(isset($banks))
                                            @foreach($banks as $data)
                                                <option value="{{$data->id}}" >{{$data->bank_name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>


                            <div class="form-group mt-2 mb-2"> 
                                <label for="">Payment Type<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id = "payment_type" name="payment_type" data-toggle="select" required>
                                    <option>Select Payment Type</option>
                                    <option value="transfer" >Tranfer</option> 
                                    <option value="cash" >Cash</option> 
                                    <option value="pos" >Pos</option>
                                </select>
                            </div>


                            

                            <div class="mb-3">
                                <label for="example-email" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount"required>
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


    function toggleModal(bank_name,customer_name,amount,customer_n,gender,type,id){
            console.log(bank_name,"type ",customer_name," ",amount," ",id," ",customer_n," ",type," ",id);
          document.getElementById("bank_name").value=bank_name;
          document.getElementById("customer_name").value=customer_name; 
          document.getElementById("amount").value=amount;
        //   document.getElementById("customer_n").value=customer_n;
          document.getElementById("gender").value=gender;
          document.getElementById("payment_type").value=type;
                   
        //   document.getElementById("office_id").value=office_id;
          
    }

  
 </script>

@endsection






