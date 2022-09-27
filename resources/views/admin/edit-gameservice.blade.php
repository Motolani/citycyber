@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                <a href="{{url('/create-gameservice')}}" class="btn btn-primary mb-2" >Go Back</a>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Game Name</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Game Name</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->



    <div class="row justify-content-center">
    <div class="col-9">
        <div class="card">
            <div class="card-body">

                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                <h4 class="header-title" style = "">Create Game Name</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <form action = "{{route('updateGameservice',$gameservice->id)}}" method = "POST"> 

             
                                
                                    @csrf
                                    
                                    <h3>Create Game Name</h3>
                                    <br>
                                    <br>
                                    <div class="row">
                                         <div class="col-lg-9">
                                            <div class="mb-3">
                                                <label class="form-label">Game Name</label>
                                                <input name="game_name" type="text" value="{{$gameservice->game_name}}" required class="form-control">
                                            </div>
                                        </div>  
                                    </div>

                                <div class="col-auto">
                                        <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
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
// ajax function to load a state
            let url = "{{url('api/get-states')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'get',
                data: { level: '1' },

                success: function (data) {

                    console.log('thisadata', data);
                    $.each(data, function (key, states) {
                        console.log("CountryState", states);
                        let option = `<option value="${states.name}"> ${states.name}</option>`;
                        $("#state").append(option);
                    });

                    console.log("response", data);
                },
                error: function (xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });
// end of state javascript
// ajax function for city
$('#state').change(function () {
                let selectedState = $(this).val();
                console.log("thisIsMySelectedState", selectedState)

                if (selectedState !== '') {

                    let url = "{{url('api/get-lga')}}";
                    console.log('mymessage' + url);
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: { state: selectedState },

                        success: function (data) {
                            // $('#addons option:not(:first)').remove();
                            console.log('thisadata', data);
                            $.each(data, function (key, lga) {
                                console.log("CountryState", lga);
                                let option = `<option value="${lga}"> ${lga}</option>`;
                                $("#lgas").append(option);
                            });


                        },
                        error: function (xhr, err) {
                            var responseTitle = $(xhr.responseText).filter('title').get(0);
                            alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                        }

                    });
                }
                else {
                    $('#addon-loader').removeClass('d-block').addClass('d-none');
                    $('#addons option:not(:first)').remove();

                    $('#addons-select').removeClass('d-block').addClass('d-none')
                    $('#submit').removeClass('d-block').addClass('d-none');
                }

            });




// end of function for city

                $(".country").change(function () {
                    var countryId = $(".country").val();
                    var url = "/address/get-states-by-country/";

                    $.ajax({
                        url: url+countryId,
                        type: 'get',
                        success: function (response) {
                            console.log(response);
                            var d = response.data;
                            var html ="";
                            for(var i =0; i<d.length; i++) {
                                html += "<option value='"+d[i].id+"' > "+d[i].name+" </option>";
                            }
                            $(".state").html(html);
                        },
                        error: function (xhr, err) {
                            console.log(err);
                        }

                    });
                });

                $(".state").change(function () {
                    var stateId = $(".state").val();
                    var url = "/address/get-cities-by-state/";

                    $.ajax({
                        url: url+stateId,
                        type: 'get',
                        success: function (response) {
                            console.log(response);
                            var d = response.data;
                            var html ="";
                            for(var i =0; i<d.length; i++) {
                                html += "<option value='"+d[i].id+"' > "+d[i].name+" </option>";
                            }
                            $(".city").html(html);
                        },
                        error: function (xhr, err) {
                            console.log(err);
                        }

                    });
                });


		$("#getParents").click(function(){
			console.log("insideGetParent");
                    let header = $('headerShow');
                    let level_id = $(this).val();

                    let levels = $('#level').val();
                    //Set value of the select label
                    $("#selectedParentOffice").html($( "#level option:selected" ).text());
                    let level = levels.split('|', 1)[0];
                    let levelName = levels.split('|', 2)[1];
                    $("#officeType").val(levelName);
                    $("#officeLevel").val(level);
                    console.log("level_iddddPhil",level);
                    getParent(level);

                });
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

                 console.log('thisadata',response.status);
                //let data  = JSON.parse(response);
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
                    $("#msg").append(ms)
;
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