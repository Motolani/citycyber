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
                    <li class="breadcrumb-item active">Nofification</li>
                </ol>
            </div>
            <h4 class="page-title">Create Nofification</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row justify-content-center">
    
    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#general" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#specific" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Specific
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cash" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            Others
                        </a>
                    </li>
                    
                </ul>

                <div class="tab-content d-flex align-items-center justify-content-center" >
                    
                    <div class="tab-pane active justify-content-center" style = "width:100%;" id="general">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            General</h5>
                        <!-- end timeline -->        

                        <div class="col-md-8 offset-md-2" >
                            <form action = "{{route('createNotification')}}" method = "POST"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Title<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="title" required>

                                </div>


                                <div class="form-group mt-2 mb-2">
                                    <label for="">Message<span class="red" style="color:red" cols="70">&#x2a;</span></label>
                                    <textarea id="message" placeholder="Message Goes Here........" name="message" rows="4" cols="60">
                                            
                                    </textarea>
                                </div>

                                <input type = "hidden" name = "type" value = "general" id = "type">
                               
                                <div class="col-auto">
                                    <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
                                </div>
                        
                            </form>
                        </div> <!-- end col -->

                    </div> <!-- end tab-pane -->


                    



                    <div class="tab-pane justify-content-center" style = "width:100%;" id="specific">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            Specific</h5>
                        <!-- end timeline -->        

                        <div class="col-md-8 offset-md-2" >
                            <form action = "{{route('createNotification')}}" method = "POST"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Staff Name<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    
                                    
                                    <select class="form-control select2" name="staff_id"  data-toggle="select2" required>
                                        <option>Select Staff</option>
                                            @if(isset($staff))
                                                
                                                @foreach($staff as $user)
                                                
                                                    <option value="{{$user->id}}" >{{$user->firstname.' '.$user->firstname}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                                <input type = "hidden" name = "type" value = "specific" id = "type">
                                
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Title<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="title" required>

                                </div>

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Message<span class="red" style="color:red" cols="70">&#x2a;</span></label>
                                    <textarea id="message" placeholder="message" name="message" rows="4" cols="60">
                                            Message Goes Here........
                                    </textarea>
                                </div>

                                
                                <div class="col-auto">
                                    <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
                                </div>
                        
                            </form>
                        </div> <!-- end col -->

                    </div> <!-- end tab-pane -->                    

                    <div class="tab-pane" id="cash">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            Other</h5>
                        <!-- end timeline -->        

                        <div class="col-lg-6" >
                            <form action = "{{route('createPaymentFormData')}}" method = "GET"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Staff Name<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="customer_id" data-toggle="select2" required>
                                        <option>Select Staff</option>
                                            {{-- @if(isset($staff))
                                                @foreach($staff as $user)
                                                
                                                    <option value="{{$data->id}}|{{$data->id." ".$data->id}}" >{{$user->firstname.' '.$user->firstname}}</option>                                        
                                                @endforeach
                                            @endif --}}
                                    </select>
                                </div>

                                <input type = "hidden" name = "type" value = "others" id = "type">

                                
                                


                               
                                <div class="col-auto">
                                    <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
                                </div>
                        
                            </form>
                        </div> <!-- end col -->

                    </div> <!-- end tab-pane -->

                    

                    <!-- end settings content-->

                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
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


