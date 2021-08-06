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
                    {{--<li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>--}}
                    <li class="breadcrumb-item active">Staff Resumption</li>
                </ol>
            </div>
            <h4 class="page-title">STAFF MANEGEMENT</h4>
        </div>
    </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                                <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <h4 class="header-title">Create Resumption Type</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row">
                            <div class="col-lg-6">
                                <form>
                                    

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Staff Resumption Types</label>
                                        <input type="text" id="" name="title" class="form-control" placeholder="Enter Level">
                                    </div>

                                    <div class="mb-3">Start Time </label>
                                        <div class="input-group" id="timepicker-input-group1">
                                            <input id="timepicker" type="text" name = "starttime" class="form-control" data-provide="timepicker">
                                            <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                        </div>
                                    </div>

                                    
                                    <div class="mb-3">End Time </label>
                                        <div class="input-group" id="timepicker-input-group2">
                                            <input id="timepicker2" type="text" name = "endtime" class="form-control" data-provide="timepicker">
                                            <span class="input-group-text"><i class="dripicons-clock"></i></span>
                                        </div>
                                    </div>

                                   
                                    
                                    <div class="col-auto">
                                        <button type="submit" name = "submit" value = "createResumption" class="btn btn-primary mb-2">CREATE RESUMPTION TYPE</button>
                                    </div>
                            

                                    

                                </form>
                            </div> <!-- end col -->

                            
                        </div>
                        <!-- end row-->                      
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
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


