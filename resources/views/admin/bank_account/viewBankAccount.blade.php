
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Bank Account</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Edit Bank Account</h4>
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
                        Below are the lists of Bank Accounts Created 
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Account Name</th>
                                        <th>Bank Name</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($bank_accounts))
                                    @foreach($bank_accounts as $data)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$data->bank_name}}','{{$data->bank_id}}','{{$data->account_holder_name}}','{{$data->account_number}}', '{{$data->id}}')" 
                                                 class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                                

                                            </td>
                                            <td>{{$data->account_holder_name}}</td>
                                            <td>{{$data->bank_name}}</td>

                                            <td>
                                                <form method="get" action="{{url('updateanddeletebankaccount')}}">
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
                        <form class="ps-3 pe-3" action="{{url('updateanddeletebankaccount')}}" method="get">
                            @csrf
                            
                            <div class="form-group mt-2 mb-2">
                                <label for="">Banks<span class="red" style="color:red" ;>&#x2a;</span></label>
                                <select class="form-control select" value = "" id = "bank_id" name="bank_id" data-toggle="select" required>
                                    <option>Select Bank</option>
                                        @if(isset($banks))
                                            @foreach($banks as $data)
                                            <option value="{{$data->id}}|{{$data->bank_name}}" >{{$data->bank_name}}</option>                                        
                                            @endforeach
                                        @endif
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="example-email" class="form-label">Account Holder Name</label>
                                <input type="text" id="account_name" name="account_name" class="form-control" placeholder="Account Holder's name" required>
                            </div>


                            <div class="mb-3">
                                <label for="example-email" class="form-label required">Account Number</label>
                                <input type="text" id="account_number" name="account_number" class="form-control" placeholder="Account Number"required>
                            </div>


                            <input type="hidden" id="account_number_id" name="id" class="form-control" required>
                            

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


    function toggleModal(bank_name,bank_id,account_holder_name,account_number,id){
       console.log("bankName ",bank_name)
          document.getElementById("bank_id").value=bank_id,"|",bank_name; 
          document.getElementById("bank_id").text=bank_name; 
          document.getElementById("account_name").value=account_holder_name; 
          document.getElementById("account_number").value=account_number;
          document.getElementById("account_number_id").value=id;
          
    }

  
 </script>

@endsection






