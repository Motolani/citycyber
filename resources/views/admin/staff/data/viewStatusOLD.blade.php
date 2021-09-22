
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Staff Status</li>
                    </ol>
                </div>
                <h4 class="page-title">Staff Status Management</h4>
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



                    <button name = "submit" value = "edit" class="btn btn-primary btn-md"><span class="uil-plus"></span> Create New Staff Status</button>
                    
		    <p style="margin-top: 10px" class="text-muted font-14">
                        Below are the lists of Staff status availabe within City Cyber
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>					                    
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($status))
                                    @foreach($status as $stat)
                                        <tr>

                                            <td>
{{--                        
                                            <form method="post" action="{{url('editLevel')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$level->id}}">
                                                        <input type="hidden" name="description" value="{{$level->id}}">
                                                        <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                            </form>
--}}
						<button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
						<button name = "submit" value = "edit" class="btn btn-warning btn-sm"><span class="uil-pen"></span></button>
						<button name = "submit" value = "edit" class="btn btn-danger btn-sm"><span class="uil-trash"></span></button>
                                            </td>
                                            {{--<td>{{$stat->created_at}}</td>
                                            <td>{{$stat->title}}</td>--}}
                                            <td>{{$stat->title}}</td>
                                            
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




