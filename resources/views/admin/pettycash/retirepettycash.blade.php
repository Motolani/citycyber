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
                        <li class="breadcrumb-item active" style="display:none" id="headerShow">PettyCash Expenses</li>
                    </ol>
                </div>
                <h4 class="page-title">Enter Expenses</h4>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-3" id="first_cardB"></div>
        <div class="col-6" id="h_div" style="align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body">
                    <h4 class="header-title" style="">
                        Enter Expenses
                    </h4>
                    <br><br>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method="POST" action="{{ route('storeRetire') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Petty cash </label>
                                        <select id="request_id" class="form-control" name="request_id"
                                            data-toggle="select" required>
                                            <option value="">Select Petty Cash</option>
                                            @if (isset($pettycash))
                                                @foreach ($pettycash as $petty)
                                                    <option value="{{ $petty->id }}">{{ $petty->description }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-4">
                                            <label class="form-label required">Amount</label>
                                            <input type="text" name="amount" class="form-control" data-provide="typeahead"
                                                id="the-basics" placeholder="₦20000" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label required">Description</label>
                                            <textarea required name="description" class="form-control" placeholder="Description">
                                                            </textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        var branches = {!! $branches !!};
        console.log("branches", branches);

        $(document).ready(function() {
            $("#branch_id").change(function() {
                let id = parseInt($("#branch_id").val())
                console.log("id ", id)

                let response = (branches.find(item => item.id === id))
                console.log("find by id", response)
                console.log("branch_id ", response.level)
                let url = "http://127.0.0.1:8000/api/getStaff/"
                $.ajax({
                    type: 'GET',
                    url: url + response.level,
                    success: function(result) {
                        console.log(result)
                        let staff_string = "";
                        let staff_array = result.data;
                        for (let i = 0; i < staff_array.length; i++) {
                            let name = staff_array[i].firstname + " " + staff_array[i].lastname
                            staff_string += "<option value='" + staff_array[i].id + "'>" +
                                name + "</option>"

                        }
                        $('#staff_id').append(staff_string)
                        console.log(staff_string)
                    }
                });

            });
        });
    </script>
@endsection

