
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request Cash Advance</li>
                    </ol>
                </div>
                <h4 class="page-title">Request Cash Advance</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
       <div  class="col-md-8 offset-2" id = "first_cardB" >
        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="header-title" style = "">
                        Here you can request Cash Advance
                    </h4>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form role="form" method = "POST" action = "{{route('cash-advance.create')}}">
                                @csrf

                                <div class="row py-4">
                                    <div class="col-lg-12 ">
                                        <label for="example-email" class="form-label">Branches </label>
                                        <select id="branch_id" class="form-control" name="branch_id" data-toggle="select" required>
                                            <option value="">Select Branch</option>
                                            @if(isset($branches))
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-12 py-4">
                                        <label for="example-email" class="form-label">Staff </label>
                                        <select id="staff_id" class="form-control" name="staff_id" data-toggle="select" required>
                                            <option value="">Select Staff</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label">Category</label>
                                        <select class="form-control select2" name="category" data-toggle="select2" required>
                                            <option>Select Category</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea required name= "description" class="form-control" placeholder="Description">
                                            </textarea>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
    <!-- end row -->
@endsection


@section('script')


<script type="text/javascript"> 

    var branches= {!! $branches !!};

    console.log("branches", branches);
    
    $(document).ready(function() {
        $("#branch_id").change(function() {
            let id = parseInt($("#branch_id").val())
            console.log("id ", id)
            
            let response= (branches.find(item=>item.id===id))
            console.log("find by id",  response)
            console.log("branch_id ", response.level)
            let url = "https://hordecall.net/oatekcitycyber/public/api/getStaff/"
            //let url = "http://127.0.0.1:8000/api/getStaff/"
            $.ajax({
                type:'GET',
                url: url+response.level,
                success:function(result){
                    console.log(result)
                    let staff_string = "";
                    let staff_array = result.data;

                    for (let i = 0; i < staff_array.length; i++) {
                        let name = staff_array[i].firstname + " "+ staff_array[i].lastname
                        staff_string += "<option value='"+staff_array[i].id+"'>"+name+"</option>"
                        
                    }
                    $('#staff_id').append(staff_string)
                    console.log(staff_string)
                }
            });
            
        });
    });

</script>

@endsection




