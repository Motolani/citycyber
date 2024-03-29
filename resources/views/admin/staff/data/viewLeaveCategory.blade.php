
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Leave Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Edit Leave Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


		        @if (Session::has('message'))
                	<div class="alert alert-success">
                    		<ul>
                            		<li>{{Session::get('message')}}</li>
                    		</ul>
                	</div>
            	@endif


                    <a name="submit" value="edit" class="btn btn-primary" href="{{url('createLeaveCategory')}}"><span
                        class="uil-plus"></span> Create New Off Category</a>

                        
                    <!--  -->
                    <p class="text-muted font-14">
                        Below are the lists of Offence types availabe within City Cyber.
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>

                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Category</th>
                                        <th>Days</th>
                                        
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($offcategories))
                                    @foreach($offcategories as $type)
                                        <tr>

                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal('{{$type->category}}','{{$type->days}}','{{$type->id}}')"  class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            
                                            </td>
                                            <td>
                                                <form method="post" action="{{url('updateDeleteLeaveCategory')}}">
                                                    @csrf
                                                        <input type="hidden" id = "id" name="id" value="{{$type->id}}">
                                                        <button name = "submit" value = "delete" class="btn btn-danger btn-sm"><span class="uil-trash"></span></button>
                                                </form>
                                            </td>
                                            <td>{{$type->category}}</td>
                                            <td>{{$type->days}}</td>
                                            
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
                            <h4 class="modal-title" id="topModalLabel">Edit Leave</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('updateDeleteLeaveType')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                
                                <input type="hidden" id = "typeId" name="id" value="">
                                <div class="mb-3">
                                    <label for="username" class="form-label">category</label>
                                    <input class="form-control" type="text"  id="typee" name = "type" value = ""  required="" placeholder="Off Category">
                                </div>


                                <div class="mb-3">
                                    <label for="username" class="form-label">Days</label>
                                    <input class="form-control" type="number"  id="dayss" name = "days" value = ""  required="" placeholder="days">
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


    function toggleModal(type,days,id){
        console.log("type is",type)
        console.log("Day is",days)
        console.log("Id is",id)
          document.getElementById("typee").value=type;
          document.getElementById("dayss").value=days;
          document.getElementById("typeId").value=id;

    }

  
 </script>

@endsection







