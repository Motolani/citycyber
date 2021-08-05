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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Bonus</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Incidence</h4>
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


                <!-- <form method="get" action="{{url('newbonus')}}">
                    {{--@csrf
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="description" value="">--}}
                        <button name = "submit" class="btn btn-primary"><span class="uil-plus"></span>Raise incidence</button>
                </form> -->
                <button value="edit" class="btn bg-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal1"><span style="color: #fff"
                                                class="uil-pen"></span>Raise Incidence</button>

                <p style="margin-top: 10px" class="text-muted font-14">
                    Below are the incidences Raised
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
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Staff Name</th>
                                    <th>Branch</th>
                                    <th>Offence</th>
                                    <th>Status</th>
                                    <th>amount</th>
                                    <th>Issuer Name</th>
                                    
                                </tr>
                            </thead>


                            <tbody>
                                @if(isset($staffData))
                                @foreach($staffData as $stat)
                                <tr>
                                    <td>
                                      
                                        <button value="edit" class="btn bg-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal1"><span style="color: #fff" class="uil-pen"></span></button>
                                        <a onclick="return confirm('Are you sure you want to delete {{$stat->allowance}}?, this action is not be reversable!.')"
                                            class="btn btn-danger btn-sm" href="{{url('/deletebonus/' . $stat->id)}}">
                                            <i class="uil-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$stat->bonus}}</td>
                                    <td>₦ {{$stat->amount}}</td>
                                    <td>{{$stat->created_at}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="modal-position-preview">
                        <div id="edit-modal1" class="modal fade" tabindex="-1"
                            role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-top">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="topModalLabel">Create Incidence
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form class="ps-3 pe-3"
                                        action="#"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Bonus</label>
                                            <input type="text" id="example-email" name="bonus"
                                                class="form-control" placeholder="Enter bonus"
                                                value=""
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-password"
                                                class="form-label">Amount</label>
                                            <input type="text" id="example-amount" name="amount" class="form-control" value=""
                                            placeholder="Enter amount" required>
                                        </div>

                                        <button type="submit" name="submit"
                                            class="btn btn-primary mt-2 mb-2 ">Create Incidence
                                        </button>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->


@endsection


@section('script')
<script>

    $(function () {
        $(document).ready(function () {
            let aa = $('#h_div');
            console.log("h_div logger ----", aa);
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

                //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                $("#parentOfficeId").val(level);
                console.log("level_iddddPhil", level);
                getParent(level);



                //$("#kdd").html(total);
                //$("div").show();
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
                    //$('#addons option:not(:first)').remove();
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

