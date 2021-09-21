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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Department</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Department Management</h4>
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



                <button name="submit" value="edit" class="btn btn-primary btn-md" data-bs-toggle="modal"
                    data-bs-target="#new-modal"><span class="uil-plus"></span> New Staff Department</button>
                <div class="tab-content">
                    <div class="tab-pane show active" id="modal-position-preview">
                        <!-- Top modal content -->
                        <div id="new-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-top">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="topModalLabel">New Status</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form class="ps-3 pe-3" action="{{url('department')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Title</label>
                                                <input class="form-control" type="text" id="name" name="title" value=""
                                                    required="" placeholder="New Department">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create Department</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- Right modal content -->

                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->

                <p style="margin-top: 10px" class="text-muted font-14">
                    Below are the lists of Staff department availabe within City Cyber
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link active">
                            Preview
                        </a>
                    </li>

                </ul> <!-- end nav-->
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
                                @if(isset($department))
                                @foreach($department as $stat)
                                <tr>

                                    <td>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="modal-position-preview">
                                                <!-- Top modal content -->
                                                <div id="edit-modal{{$stat->id}}" class="modal fade" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-top">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="topModalLabel">Edit Department
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form class="ps-3 pe-3"
                                                                action="{{url('department/' . $stat->id)}}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <div class="mb-3">
                                                                        <label for="username"
                                                                            class="form-label">Title</label>
                                                                        <input class="form-control" type="text"
                                                                            id="name" name="title"
                                                                            value="{{$stat->title}}" required=""
                                                                            placeholder="Staff Status">
                                                                    </div>

                                                                    <input class="form-control" type="hidden" name="id"
                                                                        value="{{$stat->id}}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

                                                <!-- Right modal content -->

                                            </div> <!-- end preview-->
                                        </div> <!-- end tab-content-->
                                        <button value="edit" class="btn bg-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal{{$stat->id}}"><span style="color: #fff"
                                                class="uil-pen"></span></button>
                                        <a onclick="return confirm('Are you sure you want to delete {{$stat->title}}?, this action is not be reversable!.')"
                                            class="btn btn-danger btn-sm"
                                            href="{{url('/deletedepartment/' . $stat->id)}}"><span
                                                class="uil-trash"></span></a>
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
