
@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
		<div class="page-title-right">
				  <a href="{{url('/getLevel')}}" class="btn btn-primary mb-2" >Go Back</a>
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View/Edit branchs</li>
                    </ol>
                </div>
                <h4 class="page-title">View/Edit Branches</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <p class="text-muted font-14">
                        Below are the lists of Branches availabe within City Cyber. Offices can also be edited
                    </p>

                    <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100 data-table">
                                <thead>
                                <tr>
                               <!--  <th>Date Created</th>-->
				    <th>Name</th>
                                    <th>Branch Address </th>
				    <th>Branch Type</th>
                                     <th>Class Type</th>
				     <th>Region</th>
                                      <th>Area</th>
                                     <!-- <th>Hub</th>-->
				   <!-- <th>Location</th>-->	
				    <th>State</th>
				    <!--<th>BranchAddress</th>-->
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($branches))
                                    @foreach($branches as $branch)
                                        <tr>
                                       <!--  <td>{{$branch->created_at}}</td>-->
					    <td>{{$branch->name}}</td>
                                             <td>{{$branch->location}}</td>
					    <td>{{$branch->type}}</td>
                                              <td> class type</td>
					  <!--  <td>{{$branch->location}}</td>-->
                                            @if(isset($regions))
					     @foreach($regions as $region)
                                              @if($region->name) 
					     <td>{{$region->name ?? 'none'}}</td>
                                            @else
                                             <td>NIL</td>
                                            @endif
                                            @endforeach
                                            @endif
                                             @if(isset($areas))
                                               @foreach($areas as $area)
					     <td>{{$area->name ?? 'none'}}</td>
                                               @endforeach
                                               @endif
                                             <td>hub</td>
					    <td>{{$branch->state_id ?? 'none'}}</td>
					  <!--   <td>{{$branch->branchaddress}}</th>-->
                                            <td>{{$branch->phone}}</th>
                                            <td>{{$branch->city_id ?? 'none'}}</td>
                                            <td>
                                                <form method="get" action="{{url('officeInfo')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$branch->id}}">
                                                    <input type="hidden" name="description" value="{{$branch->name}}">
                                                    <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span> View </button>
                                                </form>
                                               <!-- <a href="{{route('viewAddPhotos', ['officeid'=>$branch->id])}}" class="btn btn-primary btn-sm mt-1"><span class="uil-wallet"></span> Upload Photos</a>-->

                                                @if(!$branch->has_store)
                                                    <a href="{{route('office.createStore', ['id'=>$branch->id])}}" class="btn btn-primary btn-sm mt-1"><span class="uil-wallet"></span> Create Store</a>
                                                @endif
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

@endsection



