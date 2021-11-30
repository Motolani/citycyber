
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Staff Attendance</li>
                    </ol>
                </div>
                <h4 class="page-title">View Attendance</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Available Attendance</h4>
                    <p class="text-muted font-14">
                        Staff Attendance 
                    </p>

                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                    @endif

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        
                                        <th>Staff Name</th>
                                        <th>Office Name</th>
                                        <th>Clocked In</th>
                                        <th>Clocked Out</th>
                                        <th>Status</th>
                                        @if(Auth::user()->id == 1)
                                        <th>Mark Absent/Present</th>
                                        @endif
					                    
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($attendance))
                                    @foreach($attendance as $user)
                                    <tr>
                                    
                                        <td>{{$user->staff_name}}</td>
                                        <td>{{$user->office_name}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->clockOut}}</td>
                                        @if($user->status == 1)
                                            <th>Clocked Out</th>
                                        @elseif($user->status == 2)
                                            <th>Marked Absent</th>
                                        @else
                                            <th>Clocked In</th>
                                        @endif

                                        @if(Auth::user()->id == 1)
                                        <td>
                                            <form method="get" action="{{url('viewAttendance')}}">
                                                @csrf
                                                <input type="hidden" name="staff_number" value="{{$user->staff_number}}">
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    @if($user->status == 1)
                                                    <button class="btn btn-danger btn-sm" name = "submit" value = "cancel"><span class="uil-multiply"></span></button>
                                                    @else
                                                    <button class="btn btn-success btn-sm" name = "submit" value = "approve"><span class="uil-check"></span></button>
                                                    @endif
                                            </form>
                                        </td>
                                    @endif
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



