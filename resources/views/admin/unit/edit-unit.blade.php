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
                        <li class="breadcrumb-item active" style="display:none" id="headerShow">Edit Staff</li>
                    </ol>
                </div>

                <h4 class="page-title">Edit Unit</h4>
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
                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <h4 class="header-title" style="">Edit {{$unit->title}}</h4>
                    <p class="text-muted font-14">
                        Here, admin can create staff Unit
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method="POST" action="{{route('unit.doEdit')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$unit->id}}" />
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Unit Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{$unit->title}}">
                                            </div>
                                        </div> <!-- end col -->

                                    </div>
                                    <!-- end row -->


                                    <div class="row" style="margin-top:10px">



                                        <div style="" class="col-lg-6 ">
                                            <button name="submit" value="createUnit" class="btn btn-primary"
                                                    style="float: right;" id="submit">Save</button>
                                        </div>
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


