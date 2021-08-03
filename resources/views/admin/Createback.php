
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
                    
                    <li class="breadcrumb-item active">Create Office</li>
                </ol>
            </div>
            <h4 class="page-title">Create Office</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">

    <div class="col-6">
        <div class="card">
            <div class="card-body">
            <h4 class="header-title">Create Office</h4>
                <p class="text-muted font-14">
                    Here you can created Offices e.g(Hub,Hq,Branches,Areas etc)
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Create Office
                        </a>
                    </li>
                </ul> <!-- end nav-->
                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">

                        <div class="row">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Select Office Type
                                </p>
                                <select class="form-control select2" data-toggle="select2">
                                    <option>Select</option>
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </select>
                            </div> <!-- end col -->

                            <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                <button class="btn btn-primary" style="float: right;" id="resetBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- to render -->
</div>
<!-- end row -->
@endsection

@section('script')
    <script>
        $(function () {

            $('#packages').change(function () {
                let id = $(this).val();
                
                if (id!==''){
                    $('#addon-loader').removeClass('d-none').addClass('d-block');
                    $('#submit').removeClass('d-block').addClass('d-none');
                    getParentOffice(id);
                }
                else {
                    $('#addon-loader').removeClass('d-block').addClass('d-none');
                    $('#addons option:not(:first)').remove();

                    $('#addons-select').removeClass('d-block').addClass('d-none')
                    $('#submit').removeClass('d-block').addClass('d-none');
                }

            });
            function getParentOffice(id) {
                 let url = "{{url('api/dstv/addon')}}";
		        console.log('mymessage' + url);
                // let url = 'http://34.68.51.255/shago/public/api/dstv/addon';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {type_id: id},

                    success: function (data) {
                        $('#addons option:not(:first)').remove();
                        loadAddon(data);


                    },
                    error: function (xhr, err) {
                        var responseTitle= $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
                    }

                });

            }
            function loadAddon(data) {
		console.log('thisadata',data);
                $.each(data.product, function(key, product){
                    //let option = `<option value="${product.code}|${product.price}|${product.name}"> ${product.name}/  ${product.month} Month -N ${product.price} </option>`;
                      let form = `<!-- to render -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Create Office</h4>
                                <p class="text-muted font-14">
                                    Here you can created Offices e.g(Hub,Hq,Branches,Areas etc)
                                </p>

                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                            Create Office
                                        </a>
                                    </li>
                                </ul> <!-- end nav-->



                                <div class="tab-content">
                                    <div class="tab-pane show active" id="typeahead-preview">

                                        <div class="row">

                                            <div class="col-lg-6 mt-3 mt-lg-0">
                                                <p class="mb-1 fw-bold text-muted"></p>
                                                <p class="text-muted font-14">
                                                    Select Office Type
                                                </p>
                                                <select class="form-control select2" data-toggle="select2">
                                                    <option>Select</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                    
                                                </select>
                                            </div> <!-- end col -->


                                            <div class="col-lg-6 mt-3 mt-lg-0">
                                                <p class="mb-1 fw-bold text-muted"></p>
                                                <p class="text-muted font-14">
                                                    Select Head
                                                </p>
                                                <select class="form-control select2" data-toggle="select2">
                                                    <option>Select</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                    
                                                </select>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->  


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="the-basics" placeholder="Name">
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-6 mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label class="form-label">Email Address</label>
                                                    <input id="bloodhound" class="form-control" type="text" placeholder="Email">
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="prefetch" placeholder="phone">
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-6 mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label class="form-label">Location</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="remote" placeholder="Location">
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Manager</label>
                                                    <input id="custom-templates" class="form-control" type="text" placeholder="States of USA">
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-6 mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label class="form-label">Type</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="default-suggestions">
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row --> 
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-0">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="multiple-datasets">
                                                </div>
                                            </div> <!-- end col -->


                                            <div class="col-lg-6">
                                                <div class="mb-0">
                                                    <label class="form-label">Country</label>
                                                    <input type="text" class="form-control" data-provide="typeahead" id="multiple-datasets">
                                                </div>
                                            </div> <!-- end col -->
                                        </div>


                                        <div class="row" style="margin-top:10px">


                                            <div class="col-lg-6">
                                                <div class="mb-0">

                                                </div>
                                            </div> <!-- end col -->


                                            <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                                <button class="btn btn-primary" style="float: right;" id="resetBtn">Submit</button>
                                            </div>
                                        </div>
                                        <!-- end row --> 
                                    </div> <!-- end preview-->
                                </div> <!-- end tab-content-->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->`;
                    $("#addons").append(option);
                });

                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }
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


