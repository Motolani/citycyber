
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit Level</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit User</h4>
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
                        Below are the lists of Staff availabe within City Cyber. You can also be View More details about selected Staff
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
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>View More</th>
                                        <th>Date Created</th>
                                        <th>Level</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($levels))
                                    @foreach($levels as $level)
                                        <tr>
                                            <td>
                                                <form method="post" action="{{url('editLevel')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$level->id}}">
                                                        <input type="hidden" name="description" value="{{$level->id}}">
                                                        <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                            </form>
                                            </td>
                                            <td>{{$level->created_at}}</td>
                                            <td>{{$level->title}}</td>
                                            <td>{{$level->salary}}</td>
                                            
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


@endsection


@section('script')
 <script>
    

  
 </script>

@endsection




