
@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                <a href="{{url('/create-sundayleave')}}" class="btn btn-primary mb-2" >Go Back</a>
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit sunday leave </li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit sunday leave</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{url('/create-sundayleave')}}" class="btn btn-primary mb-2" >Add Sundayleave</a>

                    <p class="text-muted font-14">
                        Below are the lists of Regions availabe within City Cyber. Offices can also be edited
                    </p>

                    <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                        <form action ="{{route('sumbitSundayleave')}}" method="POST">
                                @csrf
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100 data-table">
                                <thead>
                                    <tr>
                                        <td>
                                            <input class="form-check-input p-2 " type="checkbox"  id="check_status"  style="border-radius:none;">
                                             <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                         </td>
                                        <th>Staff Name </th>
                                        <th>Level</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Phone</th>
                                        <th>Resumption Date</th>   
                                    </tr>
                                </thead>

                                <tbody>
                                <!-- <form action ="{{route('sumbitSundayleave')}}" method="POST">
                                @csrf -->
                                
                                    @if(isset($sundayleave))
                                        @foreach($sundayleave as $user)
                                            
                                            
                                            <tr>
                                                <td>
                                                 <input class="form-check-input p-2 " type="checkbox" value="{{$user->id}}" name="pso[]"  id="check_status"  style="border-radius:none;">
                                                 <label class="form-check-label my-1 mx-1" for="flexCheckDefault" style="font-weight:100;">
                                               </td>

                                               <td>{{$user->firstname.' '.$user->lastname}}</td>
                                                       
                                               <td>{{$user->level}}</td>
                                              <!-- <td>{{$user->office->name ?? "No Office"}}</td>   -->
                                                <td>
                                                        @if(isset($getBranch))
                                                        @foreach($getBranch as $branch)
                                                            @if($branch->id == $user->office_id)
                                                                {{$branch->name}}
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                </td>
                                                    <td>{{$user->status}}</td>        
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
                                                
                                            </tr>
                                        @endforeach    
     
                                    @endif

                                        
                                        
                                </tbody>
                            </table>
                            <div class="col-auto">
                                <!-- <input type="submit" value="top" name="kdjk" /> -->
                                <button type="submit" name = "submit"   id="submit" class="btn btn-primary mb-9">ADD TO PERMANENT SUNDAY DAY-OFF LIST</button>
                            </div> 
                        </form>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>


    <!-- end row-->

                                    <!-- <div class="col-auto">
                                        <input type="submit" value="top" name="kdjk" /> 
                                        <button type="submit" name = "submit"   id="submit" class="btn btn-primary mb-9">ADD TO PERMANENT SUNDAY DAY-OFF LIST</button>
                                    </div> 
                                </form> -->


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

        function showModal(sundayleave, id)
            {
                console.log(sundayleave)
                console.log(id)      
                document.getElementById('modalSundayleave').innerText = "You about to Delete sundayleave with sundayleave: " + sundayleave
                document.forms['delete']['id'].value = id
            }
    </script>



@endsection
   

                    