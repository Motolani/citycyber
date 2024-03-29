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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Lateness</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Lateness Management</h4>
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
                    Create Staff Lateness
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
                            <h4 class="page-title">CREATE LATENESS</h4>
                            <hr>
                            <form action="{{url('createlateness')}}" method="POST">
                                @csrf                    
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Lateness Start Duration (In Minutes)</label>
                                    <input type="lateness-start-duration" id="example-email" name="starthour" class="form-control" placeholder="Lateness Start Duration"required>
                                </div>

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Lateness End Duration (In Minutes)</label>
                                    <input type="lateness-end-duration" id="example-email" name="endhour" class="form-control" placeholder="Lateness End Duration"required>
                                </div>
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Fine (Amount)</label>
                                    <input type="fine (amount)" id="example-email" name="amount" class="form-control" placeholder="fine(amount)"required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-9">CREATE LATENESS FINE</button>
                                </div>                        
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
            select.addEventListener('change', function (sel) {
                console.log('changed' + JSON.stringify(select.value));
                fetch("/cityCyber/public/api/allstaff/" + select.value)
                    .then(res => res.json())
                    .then(res => {
                        var len = res.length
                        for (var i = 0; i < len; i++) {
                            var option = document.createElement("option");
                            option.text = res[i].firstname + " " + res[i].lastname + " (" + res[i].email + ") " + res[i].level;
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
