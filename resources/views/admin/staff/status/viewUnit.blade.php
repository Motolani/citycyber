
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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit Unit</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit Unit</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Units List</h4>
                    <p class="text-muted font-14">
                        Below are the lists of Unit availabe within City Cyber. You can also Edit but clicking on eye Button details about selected Unit
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>Unit</th>
                                    <th>Created At</th>

                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($units))
                                    @foreach($units as $unit)
                                        <tr>
                                            <td>
                                                <form method="post" action="{{url('editUnit')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$unit->id}}">
                                                    <input type="hidden" name="description" value="{{$unit->id}}">
{{--                                                    <button class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>--}}
                                                </form>
                                            </td>
                                            <td>{{$unit->title}}</td>
                                            <td>{{$unit->created_at}}</td>
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




