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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">Create Staff</li>
                    </ol>
                </div>

                <h4 class="page-title">Create Staff</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <script>
        function loadFile(event) {
            var fileSize = event.target.files[0].size

            if(fileSize/1000 > 300){
                alert("Image should not be larger than 300 KB!.")
                return;
            }

            var image = document.getElementById('profilepic');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.width = 200
            image.height = 200

            var reader = new FileReader();
            reader.readAsDataURL(event.target.files[0]);

            reader.onload = function () {
                var hiddenFile = document.getElementById('imageurl');
                hiddenFile.value = reader.result
            };
            reader.onerror = function (error) {
                console.log('Error: ', error);
            };
        };
    </script>

    <div class="row">
        <div class="col-12" id="h_div" style="align-content:right, float:right">
            <div class="card">
                <div class="card-body">
                    @if(isset($message))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <h4 class="header-title" style="">Staff Management</h4>
                    <p class="text-muted font-14">
                        Here is the first level where you can insert all personal staff's Information
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3" data-tabs="tabs">
                        <li class="nav-item">
                            <a href="#personal" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                PERSONAL INFORMATION
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#company" data-toggle="tab" aria-expanded="false" class="nav-link disabled">
                                COMPANY INFORMATION
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#experience" data-toggle="tab" aria-expanded="false" class="nav-link disabled">
                                EXPERIENCE
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#summary" data-toggle="tab" aria-expanded="false" class="nav-link disabled ">
                                SUMMARY
                            </a>
                        </li>
                    </ul> <!-- end nav-->

	          <form method="POST" novalidate="novalidate" action="{{route('submitStaffForm')}}" id="newStaffForm" enctype="multipart/form-data">	
		<!--<form method="POST" novalidate="novalidate" id="newStaffForm" enctype="multipart/form-data">-->
                        @csrf
                        <div class="tab-content">

                            <div class="tab-pane active" id="personal">
                                @include('admin.staff.personal-info')
                            </div>

                            <div class="tab-pane" id="company">
                                @include('admin.staff.company-info')
                            </div>

                            <div class="tab-pane" id="experience">
                                @include('admin.staff.experience')
                            </div>

                            <div class="tab-pane" id="summary">
                                @include('admin.staff.preview')
                            </div>
                        </div>
                    </form>

                    <!-- end tab-content-->

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')

    <script>
        $(function () {

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




            function formatErrorMessage(jqXHR, exception) {

                if (jqXHR.status === 0) {
                    return ('Not connected.\nPlease verify your network connection.');
                } else if (jqXHR.status == 404) {
                    return ('The requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    return ('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    return ('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    return ('Time out error.');
                } else if (exception === 'abort') {
                    return ('resource request aborted.');
                } else {
                    return ('Uncaught Error.\n' + jqXHR.responseText);
                }
            }
        });
    </script>

@endsection
