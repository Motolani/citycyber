
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
                        
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit Office</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit Office</h4>
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

                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                                <li>{{Session::get('error')}}</li>
                            
                        </ul>
                    </div>
                @endif

                    <h4 class="header-title">Available Table</h4>
                    <p class="text-muted font-14">
                        Transfers Lost and Statuses
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
                            </a>
                        </li>
                        
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="all" /></th>
                                        <th>Sent Date</th>
                                        <th>Category</th>
                                        <th>Sender Name</th>
                                        <th>Office Name</th>
                                        <th>Status</th>
                                        <th>Approve</th>
                                        <th>Disapprove</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                @if(isset($transfers))
                                    @foreach($transfers as $data)
                                    <tr>
                                        <td><input type="checkbox" class="checkable" name="items[]" value="{{$data->id}}" /></td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->category}}</td>
                                        <td>{{$data->sender_name}}</td> 
                                        <td>{{$data->officeName}}</td>
                                        @if($data->status == "Approved")
                                        <td style="color:aquamarine;">{{$data->status}}</td>
                                        @elseif($data->status == "Disapproved")
                                        <td style="color:#a52a2a">{{$data->status}}</td>
                                        @else
                                        <td>{{$data->status}}</td>
                                        @endif
                                        
                                        
					                    <td>
				
					                        <!-- <form method="get" action="{{url('officeInfo')}}"> -->
                                                @csrf
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <input type="hidden" name="description" value="{{$data->name}}">
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal({{$data->id}},'approve')"  class="btn btn-primary btn-sm phils" ><span class="uil-check"></span></button>
                                                
                                                <!-- <button name = "submit" value = "edit" id="bulkAccept" class="btn btn-primary btn-sm"><span class="uil-check"></span></button> -->
                                            <!-- </form> -->
                                        </td>

                                        <td>
				
					                        <!-- <form method="get" action="{{url('officeInfo')}}"> -->
                                                @csrf
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <input type="hidden" name="description" value="{{$data->name}}">
                                                <button  data-bs-toggle="modal" data-bs-target="#top-modal" onclick="toggleModal({{$data->id}},'disapprove')"  class="btn btn-danger btn-sm deny" ><span class="uil-multiply"></span></button>
                                                <!-- <button name = "submit" value = "edit" class="btn btn-danger btn-sm deny"><span class="uil-multiply"></span></button> -->
                                            <!-- </form> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>                                           
                        </div> <!-- end preview-->
                    
                    </div> <!-- end tab-content-->
                    
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

    <div class="tab-content">
        <div class="tab-pane show active" id="modal-position-preview">
            <!-- Top modal content -->
            <div id="top-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-top">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="topModalLabel">Approove/Disapprove Comment</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="ps-3 pe-3" action="{{url('approveDisapproveStock')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                
                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Comment</label>
                                    <input class="form-control" type="text"  id="comment" name = "comment"  required="" placeholder="Enter Comment">
                                </div>
                                <input class="form-control" type="hidden"  id ="action_id" name = "action_id"  required >
                                <input class="form-control" type="hidden"  id ="action" name = "action"  required >
 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name = "submit" value = "update" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- Right modal content -->
            
        </div> <!-- end preview-->
    </div> <!-- end tab-content-->


@endsection


@section('script')
 <script>
    
    function toggleModal(action_id,action){
           console.log("new", action_id+" "+action)

          document.getElementById("action_id").value=action_id;
          document.getElementById("action").value=action;
    }


    $(function () {
        $(document).ready(function(){
        let aa =$('#h_div');
        console.log("h_div logger ----",aa);
        aa.hide();
        $("#hide").click(function(){
            $("div").hide();
        });


        
        $("#getParents").click(function(){
            let header = $('headerShow');
            let level_id = $(this).val(); 
            //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
        ///.$("#addons").append(levelInput);
            console.log("level_id",level_id);
            getParent(level_id);

            

            //$("#kdd").html(total);
            //$("div").show();
        });
        });

        function getParent(level_id) {
            let url = "{{url('api/loadType')}}";
        console.log('mymessage' + url);
        $.ajax({
            url: url,
            type: 'post',
            data: {level: level_id},

            success: function (data) {
                //$('#addons option:not(:first)').remove();
                loadParent(data);

                console.log("response",data);
            },
            error: function (xhr, err) {
                var responseTitle= $(xhr.responseText).filter('title').get(0);
                alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
            }

        });

        }
        function loadParent(data) {
            console.log('thisadata',data);
            $.each(data.product, function(key, product){
                let option = `<option value="${product.code}|${product.price}|${product.name}"> ${product.name}/  ${product.month} Month -N ${product.price} </option>`;
                $("#addons").append(option);
            });

            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }

    });
 </script>

<!-- @include('admin.includes.view-pending-scripts'); -->

@endsection


