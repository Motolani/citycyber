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
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active">Read Notificaton</li>
                </ol>
            </div>
            <h4 class="page-title">Notification</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">

    <!-- Right Sidebar -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Left sidebar -->
                <div class="page-aside-left">
                    

                    <div class="email-menu-list mt-3">
                    <a href="{{url('inbox')}}" class="text-danger fw-bold"><i class="dripicons-inbox me-2"></i>Inbox<span class="badge badge-danger-lighten float-end ms-2">{{$total}}</span></a>
                        
                       
                    </div>

                    

                    

                </div>
                <!-- End Left sidebar -->

                <div class="page-aside-right">

                    
                    

                    

                    <div class="mt-3">
                        <ul class="email-list">
                            @foreach ($notif as $data)
                                
                            
                            <li>
                                <div class="email-sender-info">
                                    <div class="checkbox-wrapper-mail">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="mail3">
                                            <label class="form-check-label" for="mail3"></label>
                                        </div>
                                    </div>
                                    <span class="star-toggle mdi mdi-star-outline text-warning"></span>
                                <a href="readNotif/{{$data->id}}" class="email-title">{{$data->senderName}}</a>
                                </div>
                                <div class="email-content">
                                    <a href="readNotif/{{$data->id}}" class="email-subject">{{$data->title}}</span>
                                    </a>
                                    {{-- <div class="readNotif/{{$data->id}}">{{$data->created_at}}</div> --}}
                                </div>
                                
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                    <!-- end .mt-4 -->

                    <div class="row">
                        {{-- <div class="col-7 mt-1">
                            Showing 1 - 20 of 289
                        </div> <!-- end col--> --}}
                        {{-- <div class="col-5">
                            <div class="btn-group float-end">
                                <button type="button" class="btn btn-light btn-sm"><i class="mdi mdi-chevron-left"></i></button>
                                <button type="button" class="btn btn-info btn-sm"><i class="mdi mdi-chevron-right"></i></button>
                            </div>
                        </div> <!-- end col--> --}}
                    </div>
                    <!-- end row-->
                </div> 
                <!-- end inbox-rightbar-->
            </div>
            <!-- end card-body -->
            <div class="clearfix"></div>
        </div> <!-- end card-box -->

    </div> <!-- end Col -->
</div><!-- End row -->




<!-- Compose Modal -->
<div id="compose-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="compose-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="compose-header-modalLabel">New Message</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-1">
                <div class="modal-body px-3 pt-3 pb-0">
                    <form>
                        <div class="mb-2">
                            <label for="msgto" class="form-label">To</label>
                            <input type="text" id="msgto" class="form-control" placeholder="Example@email.com">
                        </div>
                        <div class="mb-2">
                            <label for="mailsubject" class="form-label">Subject</label>
                            <input type="text" id="mailsubject" class="form-control" placeholder="Your subject">
                        </div>
                        <div class="write-mdg-box mb-3">
                            <label class="form-label">Message</label>
                            <textarea id="simplemde1"></textarea>
                        </div>
                    </form>
                </div>
                <div class="px-3 pb-3">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="mdi mdi-send me-1"></i> Send Message</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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

