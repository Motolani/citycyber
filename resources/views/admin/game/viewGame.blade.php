
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
                        <div class="tab-pane show active" id="basic-datatable-preview">
                            <table id="basic-datatable" class="table data-table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Created At</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Reference</th>
                                       
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($games))
                                    @foreach($games as $data)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$data->bank_name}}',
                                                '{{$data->bank_id}}','{{$data->customer_name}}',
                                                '{{$data->customer_id}}', '{{$data->amount}}', '{{$data->game_id}}','{{$data->customer_type}}',
                                                '{{$data->gender}}','{{$data->pos_id}}','{{$data->id}}','{{$data->terminal_id}}','{{$data->game_type}}','{{$data->ticket_id}}','{{$data->payment_type}}')" 
                                                 class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                                

                                            </td>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->customer_name}}</td>
                                            <td>₦{{$data->amount}}</td>
                                            <td>{{$data->type}}</td>
                                            <td>{{$data->reference}}</td>

                                            



                                            
                                            <td>
                                                <form method="get" action="{{url('updateanddeletegame')}}">
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
                        <form class="ps-3 pe-3" action="{{url('updateanddeletegame')}}" method="get">
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
                                <label for="">Bank<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id = "bank_id" name="bank_id" data-toggle="select" required>
                                    <option value = ""></option>
                                    <option>Select Bank</option>
                                        @if(isset($banks))
                                            @foreach($banks as $data)
                                            <option value="{{$data->id}}" >{{$data->bank_name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>

                            
                            <div class="form-group mt-2 mb-2">
                                <label for="">Pos<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id = "pos_id" name="pos_id" data-toggle="select" required>
                                    <option value=""></option>
                                    <option>Select Pos</option>
                                        @if(isset($pos))
                                            @foreach($pos as $data)
                                            <option value="{{$data->id}}" >{{$data->terminal_id}}</option>                                        
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

                            

                            <div class="form-group mt-2 mb-2">
                                <label for=""> Type<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" id ="game_type" name="type" data-toggle="select" required>
                                
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
                            

                            <input type="hidden" id="game_id" name="id" class="form-control" required>

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


    function toggleModal(bank_name,bank_id,customer_name,customer_id,amount,game_id,
    customer_type,gender,pos_id,game_id,terminal_id,game_type,ticket_id,payment_type){
        console.log(bank_name,"bank_id ",bank_id,"custnname ",customer_name,"custid ",customer_id,"amou ",amount,"gameid ",game_id,"custTYpe ",
    customer_type,"gender ",gender,"pos_id ",pos_id,"game_id ",game_id,"terminal_id ",terminal_id,"game_tyep ",game_type,"ticket_id ",ticket_id);

            
          document.getElementById("bank_id").value=bank_id;
           document.getElementById("bank_id").text=bank_name;
           document.getElementById("customer_id").value=customer_id; 
          document.getElementById("customer_id").text=customer_name; 
          document.getElementById("customer_type").value=customer_type; 
           document.getElementById("amount").value=amount;


           document.getElementById("game_id").value=game_id;
           document.getElementById("pos_id").value=pos_id;
           document.getElementById("pos_id").text=terminal_id;
          document.getElementById("game_type").value=game_type;
          document.getElementById("ticket_id").value=ticket_id;
          document.getElementById("payment_type").value=payment_type;
          
    }

  
 </script>

@endsection






