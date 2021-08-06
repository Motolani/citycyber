
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Offence</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Edit Offence</h4>
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



                    <h4 class="header-title">Available Table</h4>
                    <p class="text-muted font-14">
                        Below are the lists of Offence types availabe within City Cyber.
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
                            </a>
                        </li>
                        
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Edit</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Delete</th>
                                
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($offence))
                                    @foreach($offence as $type)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$type->name}}','{{$type->amount}}')"  class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            
                                            </td>
                                            <td>{{$type->name}}</td>
                                            <td>{{$type->amount}}</td>
                                            
                                            <td>
                                                <form method="post" action="{{url('updateAndDeleteOffence')}}">
                                                    @csrf
                                                        <input type="hidden" name="id" value="{{$type->id}}">
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
                            <h4 class="modal-title" id="topModalLabel">Edit Offence</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('updateAndDeleteOffence')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                
                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Offence Name</label>
                                    <input class="form-control" type="text"  id="name" name = "name"  required="" placeholder="Offence">
                                </div>


                                <div class="mb-3">
                                    <label for="username" class="form-label">Offence Name</label>
                                    <input class="form-control" type="text"  id="amount" name = "amount"  required="" placeholder="Amount">
                                </div>
                                
 
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


    function toggleModal(name,amount){

          document.getElementById("name").value=name;
          document.getElementById("amount").value=amount;

    }

  
 </script>

@endsection






