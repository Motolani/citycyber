@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                <a href="{{url('/create-branch')}}" class="btn btn-primary mb-2" >Go Back</a>
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit Branch Classification</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit Branch Classification</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{url('/create-branch')}}" class="btn btn-primary mb-2" >Add Branch Classification</a>

                    <p class="text-muted font-14">
                        Below are the lists of Regions availabe within City Cyber. Offices can also be edited
                    </p>

                    <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100 data-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Branch</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>    
                                

                                <tbody>
                                @if(isset($branch))
                                    @foreach($branch as $data)
                                        <tr>
                                            <td>{{$data->id}}</th>
                                            <td>{{$data->type}}</td>
                                            
                                            
                                                <td>
                                                    <a href="{{route('editBranch',$data->id)}}" class="btn btn-success"><span class="uil-eye mb-1">Edit</a>
                                                </td>


                                                <td>
                                                    <button type="button" class="btn btn-danger" onclick ="showModal('{{$data->type}}',{{$data->id}})"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-email ="{{$data->type}}" data-id="{{ $data->id }}">
                                                    Delete Branch    
                                                    </button>
                                                </td>
                                            
                                        </tr>
                                        @endforeach    
                                                 
                                        @endif
                                </tbody>
                            </table>
                            <form action="{{URL::to('delete-branch/')}}" name="delete" method="post">
                                                    @csrf
                                                    {{-- @method('DELETE') --}}
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">  
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Branch</h5>
                                                                        <input type="hidden" name="id">
                                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" id= "modalType">
                                                                       
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Delete me</button>
                                                                    </div> 
                                                                </div>  
                                                        </div>
                                                    </div>
                                            </form> 
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->


@endsection


@section('script')
    <script>

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


<script>
    function showModal(type, id)
        
    {
    console.log(type)      
    document.getElementById('modalType').innerText = "You about to Delete branch with type: " + type
    document.forms['delete']['id'].value = id
    }

</script>




@endsection
