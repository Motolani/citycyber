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
                    <li class="breadcrumb-item active">Games</li>
                </ol>
            </div>
            <h4 class="page-title">Games</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            
                                <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                <h4 class="header-title">Games</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <form action = "{{route('createGameFormData')}}" method = "GET"> 
                                @csrf

                                    
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Customer Name</label>
                                        <input type="text" id="name" name="name" value = "{{isset($customer_name)?$customer_name:'0'}}" class="form-control" placeholder="" required readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Amount</label>
                                        <input type="number" id="amount" name="amount" value = "{{isset($gameAmount)?$gameAmount:'0'}}" class="form-control" placeholder="" required readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Reference</label>
                                        <input type="text" id="reference" name="reference" value = "{{isset($reference)?$reference:'0'}}" class="form-control" readonly required>
                                    </div>


                                    <div class="form-group mt-2 mb-2">
                                        <label for=""> Type<span class="red" style="color:red" ;>&#x2a;</span></label>
                                        <select class="form-control select" name="type" data-toggle="select" required>
                                            <option>Select Type</option>
                                            <option value="VIRTUAL" >Virtual</option> 
                                            <option value="LIVE" >Live</option> 
                                           
                                        </select>
                                    </div>

                                    <input type="hidden" id="customer_id" value="{{$customer_id}}" name="customer_id"  required>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Ticket_id</label>
                                        <input type="text" id="ticket_id" name="ticket_id" class="form-control" placeholder="ticket id" required>
                                    </div>

                                   

                                   
                                    <div class="col-auto">
                                        <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
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


