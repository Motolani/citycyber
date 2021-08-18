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
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Cash Reserve</h4>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <a href="{{route('cash.viewRequestFunds')}}" class="btn btn-success mb-2">Request Funds</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body">
                            <i class="dripicons-jewel float-end text-muted"></i>
                            <h6 class="text-muted text-uppercase mt-0">Balance</h6>
                            <h2 class="m-b-20">₦<span>{{$cashReserve->balance}}</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        //  $(document).ready(function(){
        //     let aa =$('#h_div');
        //     let header = $('headerShow');
        // console.log("h_div logger ----",aa);
        //    	header.hide();
        //     aa.hide();
        //     $('#h_div_status').text('hide div successfully');
        // });
        $(function () {
            $(document).ready(function(){
                let aa =$('#h_div');
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

                    //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                    $("#parentOfficeId").val(level);
                    console.log("level_iddddPhil",level);
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
                    data: {level: level_id},

                    success: function (data) {
                        //$('#addons option:not(:first)').remove();
                        loadParent(data);

                        console.log("response",data);
                    },
                    error: function (xhr, err) {
                        var responseTitle= $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
                    }

                });

            }
            function loadParent(data) {
                console.log('thisadata',data);
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

                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }

        });
    </script>

@endsection