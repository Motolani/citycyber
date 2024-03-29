
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Delete/Edit Resumption Type</li>
                    </ol>
                </div>
                <h4 class="page-title">Delete/Resumptions</h4>
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
                        Below are the lists of Resumption availabe within City Cyber.
                    </p>

                     <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>Type</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    {{--                                        <th>Delete</th>--}}
                                </tr>
                                </thead>


                                <tbody>
                                @if(isset($resumptionTypes))
                                    @foreach($resumptionTypes as $type)
                                        <tr>
                                            <td>
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal({{$type->id}},'{{$type->title}}','{{$type->starttime}}','{{$type->endtime}}')"  class="btn btn-primary btn-sm phils" ><span class="uil-eye"></span></button>
                                            </td>
                                            <td>{{$type->title}}</td>
                                            <td>{{$type->starttime}}</td>
                                            <td>{{$type->endtime}}</td>
                                            {{--                                                <td>--}}
                                            {{--                                                <button class="btn btn-danger btn-sm"><i class="uil-trash"></i></button>--}}
                                            {{--                                                </td>--}}
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
                            <h4 class="modal-title" id="topModalLabel">Edit Office</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('updateAndDeleteResumption')}}" method="post">
                            @csrf
                            <div class="modal-body">


                                <div class="mb-3">
                                    <label for="username" class="form-label">Title</label>
                                    <input class="form-control" type="text"  id="title" name = "title"  required="" placeholder="Office Name">
                                </div>
                                <input class="form-control" type="hidden"  id ="id" name = "id"  required="" placeholder="john@deo.com">

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Start</label>
                                    <input class="form-control" type="text"  id="start" name = "starttime" required="" placeholder="Enter Phone">
                                </div>


                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">End </label>
                                    <input class="form-control" type="text"  id= "end" name = "endtime" required="" placeholder="Enter Address">
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


        function toggleModal(id,title,start,end){
            console.log("new", id+title+start+end)

            document.getElementById("title").value=title;
            document.getElementById("id").value=id;
            document.getElementById("start").value=start;
            document.getElementById("end").value=end;

        }


    </script>

@endsection





