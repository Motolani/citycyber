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
                <h4 class="page-title">Permission</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
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
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <form action = "{{route('permissions.update', $permission->id)}}" method = "POST"> 

                                        @csrf
                                        <br>
                                        <br>
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label class="form-label"> Name</label>
                                                    <input name="name" type="text" value="{{$permission->name}}"  required type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
    
                                        
                                      
                                        <div class="col-auto">
                                            <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Update Permission</button>
                                        </div>
                                      
    
    
                                     
                                
                                    </form> 
                                </div> 

                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
        <div class="col-2"></div>
    </div>
    <!-- end row-->


@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function del(arg){
            //alert(arg)
            //var route = "{{ url('incident/approve') }}/"+arg;
            var route = "{{ url('permissions') }}/"+arg;
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