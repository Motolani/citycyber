@extends('admin.layout')
@section('title')
Dashboard
@endsection
@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">CityCyber</a></li>
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active">Nofification</li>
                </ol>
            </div>
            <h4 class="page-title">Create Nofification</h4>
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


		@if (\Session::has('message'))
    		<div class="alert alert-success">
        		<ul>
            			<li>{!! \Session::get('message') !!}</li>
        		</ul>
    		</div>
		@endif


                <!-- <form method="get" action="{{url('newbonus')}}">
                    {{--@csrf
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="description" value="">--}}
                        <button name = "submit" class="btn btn-primary"><span class="uil-plus"></span>Raise incidence</button>
                </form> -->

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
                        <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Created Date</th>
                                    <th>Message</th>
                                    <th>Type</th>                                    
                                    <th>Action</th>                                    
                                </tr>
                            </thead>


                            <tbody>
                                @if(isset($notifications))
                                @foreach($notifications as $data)
                                <tr>
                                    {{--<td>
                                        <button value="edit" class="btn bg-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal1"><span style="color: #fff" class="uil-pen"></span></button>
                                        <a onclick="return confirm('Are you sure you want to delete {{$stat->allowance}}?, this action is not be reversable!.')"
                                            class="btn btn-danger btn-sm" href="{{url('/deletebonus/' . $stat->id)}}">
                                            <i class="uil-trash"></i>
                                        </a>
                                    </td>--}}
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->message}}</td>
                                    <td>{{$data->notify_name}}</td>
                                    <td><a href="{{url($data->type_url_path)}}">View</a></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end tab-content-->
                
                {{-- <div class="tab-content">
                    <div class="tab-pane show active" id="modal-position-preview">
                        <div id="edit-modal1" class="modal fade" tabindex="-1"
                            role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-top">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="topModalLabel">Create Suspension
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form class="ps-3 pe-3"
                                        action="{{url('viewCreateSuspension')}}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$user_id}}" > 
                                        <div class="mb-3">
                                            <label class="form-label">Suspension Start Date</label>
                                            <input type="text" class="form-control date" value = "" name = "startDate" id="startDate" data-toggle="date-picker" data-single-date-picker="true">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Suspension End Date</label>
                                            <input type="text" class="form-control date" value = "" name = "endDate" id="endDate" data-toggle="date-picker" data-single-date-picker="true">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Comment</label>
                                            <input type="text" id="example-email" name="comment" class="form-control" placeholder="Enter Comment" value="" required>
                                        </div>

                                        

                                        <!-- <div class="mb-3">
                                            <label for="example-password"
                                                class="form-label">Amount</label>
                                            <input type="text" id="example-amount" name="amount" class="form-control" value="" placeholder="Enter amount" required>
                                        </div> -->

                                        <button type="submit" name="submit" value = "createSuspension"
                                            class="btn btn-primary mt-2 mb-2 ">Create Suspension
                                        </button>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div> --}}

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
            

            $("#createIncidence").click(function () {
                
                // let levels = $('#level').val();
                // let level = levels.split('|', 1)[0];
                // let levelName = levels.split('|', 2)[1];
                // $("#officeType").val(levelName);

                //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                // $("#parentOfficeId").val(level);
                // console.log("level_iddddPhil", level);
                getParent(1);



                //$("#kdd").html(total);
                //$("div").show();
            });
        });

        function getParent(level_id) {
            let url = "{{url('api/getOffences')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: { level: level_id },

                success: function (data) {
                    //$('#addons option:not(:first)').remove();
                    loadOffence(data);

                    console.log("response", data);
                },
                error: function (xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });

        }
        function loadOffence(data) {
            console.log('thisadata', data);
            $.each(data.data, function (key, offence) {
                console.log("offence", offence);
                let option = `<option value="${offence.id}"> ${offence.name}</option>`;
                console.log(option);
                $("#offence").append(option);
            });

            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }

    });

</script>

@endsection