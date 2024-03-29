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

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Staff Bonus</li>
                </ol>
            </div>
            <h4 class="page-title">Initiate Loss/Damages Loan</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row justify-content-center">
	<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Tip!</strong> <br>
        You must first Select the branch of the Staff to proceed. 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="float: right">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Create Loss/Damages Loan</h4>
                <ul class="nav nav-tabs nav-bordered mb-3">
                    
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="input-types-preview">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{url('otherLoan/create')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
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
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Staff </label>
                                        <select id="staff_id" class="form-control" name="staff_id" data-toggle="select" required>
                                            <option value="">Select Staff</option>
                                        </select>
                                    </div>
                                    
                                    {{-- <input type="hidden" name="issuer" value="{{Auth::user()->id}}" required> --}}
                                    
                                    <div class="mb-3">
                                        <label for="start" class="form-label">Amount</label>
                                        <input class="form-control" type="number" id="amount" name="amount">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="propertyLost" class="form-label">Property Lost</label>
                                        <input class="form-control" type="text" id="propertyLost" name="propertyLost">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Type </label>
                                        <select id="type" class="form-control" name="type" data-toggle="select" required>
                                            <option value="">Select Type</option>
                                            <option value="Loss">Loss</option>
                                            <option value="Damages">Damages</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Comment</label>
                                        <input type="text" id="example-email" name="comment" class="form-control" placeholder="Enter Comment" value="" required>
                                    </div>

                                    

                                    <button type="submit" name="submit" value = "createOffence"
                                        class="btn btn-primary mt-2 mb-2 ">Create Loan
                                    </button>
                                </form>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->                      
                    </div> <!-- end preview-->
                </div> <!-- end tab-content-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div>
<!-- end row-->


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
           // let url = "http://127.0.0.1:8000/api/getStaff/"
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


<script>





    $(function () {
        $(document).ready(function () {
            let aa = $('#h_div');
            console.log("h_div logger ----", aa);
            

            $("#createIncidence").click(function () {
                
                // let levels = $('#level').val();
                // let level = levels.split('|', 1)[0];
                // let levelName = levels.split('|', 2)[1];
                // $("#officeType").val(levelName);

                //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                // $("#parentOfficeId").val(level);
                // console.log("level_iddddPhil", level);
                getParent(1);



                //$("#kdd").html(total);
                //$("div").show();
            });
        });

        function getParent(level_id) {
            let url = "{{url('api/getOffences')}}";
            console.log('mymessage' + url);
            $.ajax({
                url: url,
                type: 'post',
                data: { level: level_id },

                success: function (data) {
                    //$('#addons option:not(:first)').remove();
                    loadOffence(data);

                    console.log("response", data);
                },
                error: function (xhr, err) {
                    var responseTitle = $(xhr.responseText).filter('title').get(0);
                    alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                }

            });

        }
        function loadOffence(data) {
            console.log('thisadata', data);
            $.each(data.data, function (key, offence) {
                console.log("offence", offence);
                let option = `<option value="${offence.id}"> ${offence.name}</option>`;
                console.log(option);
                $("#offence").append(option);
            });

            //Change the text of the default "loading" option.
            $('#addons-select').removeClass('d-none').addClass('d-block')
            $('#addon-loader').removeClass('d-block').addClass('d-none');
            $('#submit').removeClass('d-none').addClass('d-block');
        }

    });

</script>

@endsection

