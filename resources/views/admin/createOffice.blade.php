
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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Office</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Office</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-6" id = "first_card">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id = "erroMessage" class="alert alert-success">
                        <p id = "msg"> </p>
                    </div>


                    <h4 class="header-title" id = "headerShow">Create Office</h4>
                    <p class="text-muted font-14">
                        Here you can create Offices e.g(Hub,Hq,Branches,Areas etc)
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Create Office
                            </a>
                        </li>
                    </ul> <!-- end nav-->


                    <div id = "startCard" class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <div class="row">
                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Select Office Type
                                    </p>
                                    <select class="form-control select2" name = "level" data-toggle="select2" data-toggle="select2" id="level">
                                        <option>Select Type</option>
                                        @if(isset($levels))
                                            @foreach($levels as  $level)
                                                <option value="{{$level->level}}|{{$level->name}}">{{$level->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div> <!-- end col -->
                                <div style="margin-top:43px;" class="col-lg-6">
                                    <button class="btn btn-primary" style="" name="getParents" id="getParents">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Create Office</h4>
                    <p class="text-muted font-14">
                        Here you can create Offices e.g(Hub,Hq,Branches,Areas etc)
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Create Office
                            </a>
                        </li>
                    </ul> <!-- end nav-->

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('createOffice')}}">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <p class="mb-1 fw-bold text-muted"></p>
                                        <p class="text-muted font-14">
                                            Select Parent Office
                                        </p>
                                        <select id = "types" class="form-control select2" data-toggle="select2">
                                            <option>Select</option>

                                        </select>
                                    </div> <!-- end col -->


                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <p class="mb-1 fw-bold text-muted"></p>
                                        <p class="text-muted font-14">
                                            Office type
                                        </p>
                                        <input value="" type = "hidden" name = "officeLevel" id = "officeLevel"/>
                                        <input type="text" class="form-control" name = "officeType" data-provide="typeahead" value = "" readonly id="officeType" placeholder="">
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name = "name" class="form-control" data-provide="typeahead" id="the-basics" placeholder="name" required>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input required id="bloodhound" name = "email" class="form-control" type="text" placeholder="email">
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" data-provide="typeahead" id="prefetch" name = "phone" placeholder="phone">
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-6 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input name = "location" required type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="location">
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-0">
                                            <label class="form-label">State</label>
                                            <input name = "state" required type="text" class="form-control" data-provide="typeahead" id="multiple-datase">
                                        </div>
                                    </div> <!-- end col -->


                                    <div class="col-lg-6">
                                        <div class="mb-0">
                                            <label class="form-label">Country</label>
                                            <input name = "country" type="text" class="form-control" data-provide="typeahead" id="multiple-datasets">
                                        </div>
                                    </div> <!-- end col -->
                                </div>


                                <div class="row" style="margin-top:10px">


                                    <div class="col-lg-6">
                                        <div class="mb-0">

                                        </div>
                                    </div> <!-- end col -->


                                    <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                        <button class="btn btn-primary" style="float: right;" id="submit">Submit</button>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')
    <script>
        $(function () {
            $(document).ready(function(){
                let aa =$('#h_div');
                let message = $('#erroMessage');
                message.hide();
                console.log("h_div logger ----",aa);
                aa.hide();
                $("#hide").click(function(){
                    $("div").hide();
                });



                $("#getParents").click(function(){
                        let header = $('headerShow');
                        let level_id = $(this).val();


                        let levels = $('#level').val();
                        let level = levels.split('|', 1)[0];
                        let levelName = levels.split('|', 2)[1];
                        $("#officeType").val(levelName);
                        $("#officeLevel").val(level);
                        console.log("level_iddddPhil",level);
                        getParent(level);

                    }
                );
            });

            function getParent(level_id) {
                let url = "{{url('api/loadParent')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {level: level_id},

                    success: function (response) {
                        console.log("dataGOtenn",response)
                        //$('#addons option:not(:first)').remove();
                        return loadParent(response);

                        console.log("response",data);
                    },
                    error: function (xhr, err) {
                        var responseTitle= $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
                    }

                });

            }
            function loadParent(response) {

                // console.log('thisadata',data);
                // let data  = JSON.parse(response);
                let data  = response;
                let status = data.status;

                console.log("statusBelowCheck",data.message);
                if(status == "200"){

                    let aa =$('#h_div');
                    let startcad = $('#first_card');

                    console.log("h_div loggererere ----",aa);
                    aa.show();$('#first_cardB').hide();
                    startcad.hide();
                    $.each(data.data, function(key, lev){
                        console.log("level", lev);
                        let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.type}</option>`;
                        $("#types").append(option);
                    });

                }else{
                    let message = $('#erroMessage');
                    let ms = data.message;
                    console.log('myMessageResponseisHere',data)
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







