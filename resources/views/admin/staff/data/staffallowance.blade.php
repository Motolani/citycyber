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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Status</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Allowance Management</h4>
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

                <p style="margin-top: 10px" class="text-muted font-14">
                    Create Staff allowance
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link active">
                            Preview
                        </a>
                    </li>

                </ul> <!-- end nav-->
                <div class="card  px-3 w-100 m-auto mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="page-title">CREATE ALLOWANCE</h4>
                            <hr>
                            <form action="{{url('createallowance')}}" method="POST">
                                @csrf
				{{--
				<div class="form-group mt-2 mb-2">
					<label for="">Office<span class="red" style="color:red" ;>&#x2a;</span></label>
					<select id="offices" class="form-control select2">
						<option>--All Offices--</option>
						@foreach($offices as $office)
						<option value="{{$office->id}}">{{$office->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group mt-2 mb-2">
					<label id="staff" for="">Staff<span class="red" style="color:red" ;>&#x2a;</span></label>
					<select id="staffid" class="form-control select2" name="staffid">
						<option>--All Staff--</option>
						
					</select>
				</div>--}}
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Allowance<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <input type="text" name="allowance" placeholder="Enter Allowance Name"
                                        class="form-control" required>
                                </div>
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Staff level<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="level" data-toggle="select2">
                                        <option>--All Staff Level--</option>
                                        @foreach($staffLevel as $levels)
                                        <option value="{{$levels->title}}">{{$levels->title}}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Amount<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <input type="text" name="amount" placeholder="Enter Amount" class="form-control"
                                        required>
                                </div>
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Time Restriction Before Allowance Re-application</label>
                                    <select class="form-control select2 mt-2 mb-2" name="restriction" data-toggle="select2">
                                        <option>--No Time Restriction--</option>
                                        <optgroup>
                                            <options value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="BY-Weekly">BY-Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Yearly">Yearly</option>

                                        </optgroup>
                                    </select>
                                    <label for="" class="mt-2 mb-2">Duration Based?(Amount is per day if duration
                                        based)</label>
                                    <select class="form-control select2" name="durationbased" data-toggle="select2">
                                        <optgroup>
                                            <option value="NO">NO</option>
                                            <option value="YES">YES</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-2 mb-2 ">CREATE ALLOWANCE
                                </button>
                            </form>
                        </div>
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

	var select = document.querySelector('#offices'),
    	input = document.getElementById('staffid');
	select.addEventListener('change',function(sel){
   	 console.log('changed' + JSON.stringify(select.value));
	 fetch("/cityCyber/public/api/allstaff/" + select.value)
	 .then(res => res.json())
	 .then(res => {
		var len = res.length
		for(var i = 0; i < len; i++){
			var option = document.createElement("option");
    			option.text =  res[i].firstname + " " + res[i].lastname + " (" + res[i].email + ") " + res[i].level ;
			option.value = res[i].id;
			input.appendChild(option)
		}
	 })
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
