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

                    
                    </ol>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">

                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <li>{{\Session::get('success') }}</li>
                            </div 
                        @endif 
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <a href="{{route('roles.create')}}" class="btn btn-primary mb-2" >Create Roles</a> <br> <br>
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                                
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>

                                                <a class="btn btn-danger" href="#" onclick="del({{$role->id}})">Delete</a>
                                            
                                               {{--  {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger'], ['onclick' => 'delete()']) !!}
                                                {!! Form::close() !!} --}}
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {!! $roles->render() !!}


                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function del(arg){
            //alert(arg)
            //var route = "{{ url('incident/approve') }}/"+arg;
            var route = "{{ url('roles/delete') }}/"+arg;
            //alert(route)
            Swal.fire({
                showDenyButton: false,
                showCancelButton: true,
                icon: 'info',
                title: 'Confirm',
                text: 'Are you sure you want to delete this role?',
            }).then(function(result) {
                if (result.isConfirmed) {
                    location.href = route
                    // Swal.fire('Saved!', '', 'success')
                } 
            })
        }
    </script>

    @include('admin.includes.view-pending-scripts');

@endsection