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


		@if (\Session::has('message'))
    		<div class="alert alert-success">
        		<ul>
            			<li>{!! \Session::get('message') !!}</li>
        		</ul>
    		</div>
		@endif

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
                                    <th>Date</th>
                                    <th>Staff Name</th>
                                    <th>Branch</th>
                                    <th>Offence</th>
                                    <th>Status</th>
                                    <th>amount</th>
                                   {{-- <th>Issuer Name</th>--}}
                                    
                                </tr>
                            </thead>


                            <tbody>
                                @if(isset($offenceRaised))
                                @foreach($offenceRaised as $data)
                                <tr>
				                    <td>{{$data->date}}</td>
                                    <td>{{$data->firstname}} {{$data->lastname}}</td>
                                    <td>{{$data->officename}}</td>
                                    <td>{{$data->offencename}}</td>
                                    
                                    <td>{{$data->offenceStatus }}</td>
                                    <td>₦ {{$data->amount}}</td>
                                    {{--<td>{{$stat->created_at}}</td>--}}
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


