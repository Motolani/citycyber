
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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request Leave</li>
                    </ol>
                </div>
                <h4 class="page-title">Request Leave</h4>
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


                    <!--<a name="submit" value="edit" class="btn btn-primary" href="{{url('requestLeave')}}"><span
				class="uil-plus"></span> Request Leave</a>-->
			<form method="get" action="{{url('requestLeave')}}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{isset($staff->id)?$staff->id:''}}">

                                <button class="btn btn-primary btn-sm"><span
                                class="uil-plus"></span> Request Leave</button>
                            </form>


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
                                    <th>Created At</th>
                                    <th>Category</th>
                                    <th>Days</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($leaveData))
                                    @foreach($leaveData as $type)
                                        <tr>
                                            <td>{{$type->type}}</td>
                                            <td>{{$type->category}}</td>
                                            <td>{{$type->day}}</td>
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








