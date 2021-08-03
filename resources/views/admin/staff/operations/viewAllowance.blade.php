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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Allowance</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Allowance</h4>
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

                <button value="edit" style = "color:white" id = "CreateAdvance" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal1"><span style="color: #fff"
                                                class="uil-plus"></span>Create Staff Allowance</button>

                <p style="margin-top: 10px" class="text-muted font-14">
                    Below are the Allowances request
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
                                    <th>Status</th>
                                    <th>amount</th>
                                   {{-- <th>Issuer Name</th>--}}
                                    
                                </tr>
                            </thead>


                            <tbody>
                                @if(isset($allowances))
                                @foreach($allowances as $data)
                                <tr>
				                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->firstname}} {{$data->lastname}}</td>
                                    <td>{{$data->officename}}</td>
                                    <td>{{$data->datastatus == '1'?'Approved':'Pending'}}</td>
                                    <td>₦ {{isset($data->amount)?$data->amount:0.00}}</td>
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
                                        <h4 class="modal-title" id="topModalLabel">Raise Salary Advance
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form class="ps-3 pe-3"
                                        action="{{url('viewCreateAllowance')}}"
                                        method="POST">
                                        @csrf

                                        <div class="mb-3">
                                           {{-- <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$user_id}}" >--}}
                                            <label for="example-email" class="form-label">Staff Allowance</label>
                                            <select id="offe" class="form-control" name="offence_id" data-toggle="select" required>

                                                <option value="">Select Allowance</option>
                                                @if(isset($allowanceList))
                                                @foreach($allowanceList as $allowance)
                                                <option value="{{$allowance->id}}">{{$allowance->allowance}}</option>

                                                @endforeach
                                                @endif
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">amount</label>
                                            <input type="number" id="example-email" name="amount" class="form-control" placeholder="Enter amount" value="" required>
                                        </div>

                                        
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Comment</label>
                                            <input type="text" id="example-email" name="comment" class="form-control" placeholder="Enter Comment" value="" required>
                                        </div>
                                        

                                        
                                        <button type="submit" name="submit" value = "createAllowance"
                                            class="btn btn-primary mt-2 mb-2 ">Create Allowance
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
            

            $("#createIncidence").click(function () {
                
                
                getParent(1);


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



