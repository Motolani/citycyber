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

                    <button name = "submit" value = "edit" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#new-modal" ><span class="uil-plus"></span> Create New Staff Status</button>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="modal-position-preview">
                            <!-- Top modal content -->
                            <div id="new-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-top">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="topModalLabel">New Status</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="ps-3 pe-3" action="{{url('staffstatus')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Title</label>
                                                    <input class="form-control" type="text" id="name" name="title" value="" required="" placeholder="New Staff Status">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create Status</button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                    <p style="margin-top: 10px" class="text-muted font-14">
                        Below are the lists of Staff status availabe within City Cyber
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($status))
                                    @foreach($status as $stat)
                                        <tr>
                                            <td>
                                                <button value = "edit" class="btn bg-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit-modal{{$stat->id}}"><span style="color: #fff" class="uil-pen"></span></button>
                                                <a onclick="return confirm('Are you sure you want to delete {{$stat->title}}?, this action is not be reversable!.')" class="btn btn-danger btn-sm" href="{{url('/deletestatus/' . $stat->id)}}"><span class="uil-trash"></span></a>
                                            </td>
                                            <td>{{$stat->title}}</td>
                                            <td>{{$stat->created_at}}</td>
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

    <div class="tab-content">
        <div class="tab-pane show active" id="modal-position-preview">
            <!-- Top modal content -->
            <div id="edit-modal{{$stat->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-top">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="topModalLabel">Edit Office</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('staffstatus/' . $stat->id)}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Title</label>
                                    <input class="form-control" type="text" id="name" name="title"
                                           value="{{$stat->title}}" required="" placeholder="Staff Status">
                                </div>

                                <input class="form-control" type="hidden" name="id" value="{{$stat->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div> <!-- end preview-->
    </div> <!-- end tab-content-->

@endsection

@section('script')
    <script>
        $(function () {
            $(document).ready(function () {
                let aa = $('#h_div');
                aa.hide();
                $("#hide").click(function () {
                    $("div").hide();
                });

                $("#getParents").click(function () {
                    let header = $('headerShow');
                    let level_id = $(this).val();

                    let levels = $('#level').val();
                    let level = levels.split('|', 1)[0];
                    let levelName = levels.split('|', 2)[1];
                    $("#officeType").val(levelName);

                    $("#parentOfficeId").val(level);
                    console.log("level_iddddPhil", level);
                    getParent(level);
                });
            });

            function getParent(level_id) {
                let url = "{{url('api/loadParent')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: { level: level_id },

                    success: function (data) {
                        loadParent(data);
                        console.log("response", data);
                    },
                    error: function (xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }
                });
            }
            function loadParent(data) {
                console.log('thisadata', data);
                let aa = $('#h_div');
                let startcad = $('#first_card');

                console.log("h_div loggererere ----", aa);
                aa.show(); $('#first_cardB').hide();
                startcad.hide();
                $.each(data.data, function (key, lev) {
                    console.log("level", lev);
                    let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.type}</option>`;
                    $("#types").append(option);
                });

                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }
        });
    </script>
@endsection
