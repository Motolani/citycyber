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
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
            <h4 class="page-title">Payment</h4>
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
                        <a href="#bank" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            Bank
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pos" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            POS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#cash" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            CASH
                        </a>
                    </li>
                    
                </ul>

                <div class="tab-content">
                    
                    <div class="tab-pane active justify-content-center" id="bank">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            Bank Transfer</h5>
                        <!-- end timeline -->        

                        <div class="col-lg-6" >
                            <form action = "{{route('createPaymentFormData')}}" method = "GET"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Customer<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="customer_id" data-toggle="select2" required>
                                        <option>Select Customer</option>
                                            @if(isset($customers))
                                                @foreach($customers as $data)
                                                <option value="{{$data->id}}|{{$data->name}}" >{{$data->name}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>

                               
                                <div class="form-group mt-2 mb-2">
                                    <label for="">Bank<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="bank_id" data-toggle="select2" required>
                                        <option>Select Bank</option>
                                            @if(isset($banks))
                                                @foreach($banks as $data)
                                                <option value="{{$data->id}}|{{$data->bank_name}}|{{$data->account_holder_name}}" >{{$data->bank_name}} |{{$data->account_holder_name}} | {{$data->account_number}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>

                                
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" placeholder="amount"required>
                                </div>
                                    <input type = "hidden" name = "trantype" value = "transfer" id = "trantype">
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Reference</label>
                                    <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference"required>
                                </div>

                               
                                <div class="col-auto">
                                    <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
                                </div>
                        
                            </form>
                        </div> <!-- end col -->

                    </div> <!-- end tab-pane -->

                    <div class="tab-pane" id="pos">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            POS</h5>
                        <!-- end timeline -->        

                        <div class="col-lg-6" >
                            <form action = "{{route('createPaymentFormData')}}" method = "GET"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Customer Name<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="customer_id" data-toggle="select2" required>
                                        <option>Select Customer</option>
                                            @if(isset($customers))
                                                @foreach($customers as $data)
                                                <option value="{{$data->id}}|{{$data->name}}" >{{$data->name}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                                <input type = "hidden" name = "trantype" value = "pos" id = "trantype">
                                
                                <div class="form-group mt-2 mb-2">
                                    <label for="">POS|TERMINAL ID<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="pos_id" data-toggle="select2" required>
                                        <option>Select POS</option>
                                            @if(isset($pos))
                                                @foreach($pos as $data)
                                                <option value="{{$data->id}}|{{$data->terminal_id}}|{{$data->bank_name}}" >{{$data->bank_name}} |{{$data->terminal_id}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>

                                
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" placeholder="amount"required>
                                </div>

                                

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Reference</label>
                                    <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference"required>
                                </div>


                                <div class="mb-3">
                                    <label for="example-email" class="form-label">last 4 digit </label>
                                    <input type="text" id="lastdigit" name="lastdigit" class="form-control" placeholder="Last 4 digits"required>
                                </div>

                               
                                <div class="col-auto">
                                    <button type="submit" name = "submit" value = "create" class="btn btn-primary mb-9">Submit</button>
                                </div>
                        
                            </form>
                        </div> <!-- end col -->

                    </div> <!-- end tab-pane -->                    

                    <div class="tab-pane" id="cash">

                        <h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i>
                            CASH PAYMENT</h5>
                        <!-- end timeline -->        

                        <div class="col-lg-6" >
                            <form action = "{{route('createPaymentFormData')}}" method = "GET"> 
                            @csrf

                                <div class="form-group mt-2 mb-2">
                                    <label for="">Customer Name<span class="red" style="color:red" ;>&#x2a;</span></label>
                                    <select class="form-control select2" name="customer_id" data-toggle="select2" required>
                                        <option>Select Customer</option>
                                            @if(isset($customers))
                                                @foreach($customers as $data)
                                                <option value="{{$data->id}}|{{$data->name}}" >{{$data->name}}</option>                                        
                                                @endforeach
                                            @endif
                                    </select>
                                </div>

                                <input type = "hidden" name = "trantype" value = "cash" id = "trantype">

                                
                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" placeholder="amount"required>
                                </div>

                                

                                <div class="mb-3">
                                    <label for="example-email" class="form-label">Reference</label>
                                    <input type="text" id="reference" name="reference" class="form-control" placeholder="Reference"required>
                                </div>


                               
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


