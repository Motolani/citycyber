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
                <h4 class="page-title">Create Staff Incidence</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row justify-content-center">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Tip!</strong> <br>
            You must first Select branches for Staff before you can incidence a Staff.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Create Staff incidence</h4>
                    <ul class="nav nav-tabs nav-bordered mb-3">

                    </ul> <!-- end nav-->

                    <div class="tab-content">
                        <div class="tab-pane show active" id="input-types-preview">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <form action="{{ route('incidence.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Filter Branches </label>
                                            <select id="filter" class="form-control" name="filter"
                                                data-toggle="select" required>
                                                <option value="">Select level to Filter Branches</option>
                                                @if (isset($fils))
                                                    @foreach ($fils as $fil)
                                                        <option value="{{ $fil->id }}">{{ $fil->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Branches </label>
                                            <select id="branch_id" class="form-control" name="branch_id"
                                                data-toggle="select" required>
                                                <option value="">Select Branch</option>
                                                
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Staff </label>
                                            <select id="staff_id" class="form-control" name="staff_id" data-toggle="select"
                                                required>
                                                <option value="">Select Staff</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">

                                            <label for="example-email" class="form-label">Staff Offence</label>
                                            <select id="offe" class="form-control" name="offence_id"
                                                data-toggle="select" required>

                                                <option value="">Select Offence</option>
                                                @if (isset($offences))
                                                    @foreach ($offences as $offence)
                                                        <option value="{{ $offence->name }}">{{ $offence->name }} - {{ $offence->amount }}</option>
                                                    @endforeach
                                                @endif
                                                <option value="others" id="show">Others</option>
                                            </select>
                                        </div>

                                        <div class="row optional my_div " id="" style="display:none;">
                                            <div class="col-md-12 col-sm-12" >
                                                <div class="form-row">
                                                    <div class="col mb-3 ">
                                                        <label>Amount</label>
                                                        <input class="form-control" id="" type="number" name="amount" min="0"/>
                                                    </div>
                                                    <div class="col mb-3 ">
                                                        <label> Description</label>
                                                        <input class=" form-control" id="" type="text" name="description" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">Comment</label>
                                            <input type="text" id="example-email" name="comment" class="form-control"
                                                placeholder="Enter Comment" value="" required>
                                        </div>



                                        <button type="submit" name="submit" value="createOffence"
                                            class="btn btn-primary mt-2 mb-2 ">Create Incidence
                                        </button>
                                    </form>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row-->


@endsection


@section('script')
    <script type="text/javascript">
        var branches = {!! $branches !!};

        console.log("branches", branches);

        $(document).ready(function() {
            $("#branch_id").change(function() {
                let id = parseInt($("#branch_id").val())
                console.log("id ", id)

                let response = (branches.find(item => item.id === id))
                console.log("find by id", response)
                console.log("branch_id ", response.level)
                let url = "http://localhost:8888/newcitycyber/public/api/getStaff/"
                $.ajax({
                    type: 'GET',
                    url: url + response.level,
                    success: function(result) {
                        console.log(result)
                        let staff_string = "";
                        let staff_array = result.data;

                        for (let i = 0; i < staff_array.length; i++) {
                            let name = staff_array[i].firstname + " " + staff_array[i].lastname
                            staff_string += "<option value='" + staff_array[i].id + "'>" +
                                name + "</option>"

                        }
                        $('#staff_id').append(staff_string)
                        console.log(staff_string)
                    }
                });

            });
        });


        $("select").change(function () {
            // hide all optional elements
            $('.optional').css('display','none');

            $("select option:selected").each(function () {
                if($(this).val() == "others") {
                    $('.my_div').css('display','block');
                } 
            });
        });
    </script>


    <script>
        $(function() {
            $(document).ready(function() {
                
                $("#filter").change(function() {
                    console.log('#filter');
                    let header = $('headerShow');
                    let level = $(this).val();

                    
                    console.log("level_go", level);
                    getAllOffice(level);

                });
            });

            function getParent(level_id) {
                let url = "{{ url('api/getOffences') }}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        level: level_id
                    },

                    success: function(data) {
                        //$('#addons option:not(:first)').remove();
                        loadOffence(data);

                        console.log("response", data);
                    },
                    error: function(xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });

            }

            function loadOffence(data) {
                console.log('thisadata', data);
                $.each(data.data, function(key, offence) {
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


            function getAllOffice(level_id) {
                let url = "{{ url('api/getAllOffice') }}";
                console.log('mymessage   ' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        level: level_id
                    },

                    success: function(response) {
                        console.log("dataGOtenn", response)
                        //$('#addons option:not(:first)').remove();
                        return loadAllOffice(response);

                        console.log("response", data);
                    },
                    error: function(xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });

            }

            function loadAllOffice(response) {

                console.log('thisadata', response.status);
                // return;
                // let data  = JSON.parse(response.data);
                let data = response;
                let status = data.status;

                console.log("statusBelowCheck", data);
                if (status == "200") {

                    let aa = $('#h_div');
                    let startcad = $('#first_card');

                    console.log("h_div loggererere ----", aa);
                    aa.show();
                    $('#first_cardB').hide();
                    startcad.hide();
                    $.each(data.data, function(key, lev) {
                        console.log("level", lev);
                        let option =
                            `<option value="${lev.id}"> ${lev.name}</option>`;
                        $("#branch_id").append(option);
                        $("#report").append(option);
                    });

                } else {
                    let message = $('#erroMessage');
                    let ms = data.message;
                    console.log('myMessageResponseisHere', data)
                    $("#msg").append(ms);
                    message.show();
                }
                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }

        });
    </script>
@endsection
