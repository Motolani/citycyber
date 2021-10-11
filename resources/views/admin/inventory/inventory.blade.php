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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">Create Staff</li>
                    </ol>
                </div>
                <h4 class="page-title">Create Inventory</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-12" id="h_div" style="align-content:right, float:right">
            <div class="card">
                <div class="card-body">

                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
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

                    <h4 class="header-title" style="">Staff Management</h4>
                    <p class="text-muted font-14">
                        Here if the first level where you can insert all personal staff's Information
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3" data-tabs="tabs">
                        <li class="nav-item">
                            <a href="#regular" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Regular
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#consumable" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Consumable
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="regular">
                            <form method="POST" action="{{route('stock.newStockRegular')}}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input name="price" type="text" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" type="text" class="form-control"> </textarea>
                                </div>

                                <button class="btn btn-primary" name="proceeds" id="submit">Save</button>

                            </form>
                        </div>

                        <div class="tab-pane" id="consumable">
                            <form method="GET" action="{{route('createStock')}}">
                            @csrf
                            <!-- Inventory Details Start -->
                                <div class="row">

                                    <table class="table data-table table-hover stock">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Rate</th>
                                            <th>Period</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input placeholder="Enter Stock name" autocomplete="off" class="form-control underline" id="stock_name" type="text" name="stock_name[]" required>
                                            </td>

                                            <td>
                                                <input autocomplete="off" placeholder="Enter Stock price" class="form-control underline" id="stock_price" type="number"
                                                       name="stock_price[]" required>
                                            </td>

                                            <td>
                                                <input placeholder="1" class="form-control" type="number" name="quantity[]" required>
                                            </td>


                                            <td>
                                                <input autocomplete="off" placeholder="Enter Stock Description" class="form-control underline" id="stock_description" type="text"
                                                       name="stock_description[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off" class="form-control underline" placeholder="Enter Depreciation Rate" id="stock_depreciation_rate" type="number" name="stock_depreciation_rate[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off" placeholder="Enter Depreciation Period" class="form-control underline" id="type" type="number" name="stock_depreciation_period[]">
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="more_stock" style="margin-bottom: 15px">
                                        <span class="btn btn-primary">Click to Add More Stock <i class="fa fa-plus"></i></span>
                                    </div>

                                    <br/>

                                    <div class="row" style="margin-top:30px">
{{--                                        <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">--}}
{{--                                            <button class="btn btn-primary" name="back" value="Back" id="submit">Back</button>--}}
{{--                                        </div>--}}
                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" name="proceed" value="Proceed" id="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection


@section('script')
    <script>


        var i = 0;
        $("#add").click(function(){
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

        });
        $(document).on('click', '.remove-tr', function(){

            $(this).parents('tr').remove();

        });

        //more guarantor's functionality
        $('div.more_stock').click(function (e) {
            //look for previous delete button and remove
            $('table.stock tr:last').find('td:last').html("");

            //clone business
            var last_tr = $('table.stock tr:last').clone();
            //implement changes and clear all data
            last_tr.find(':text').val('');
            first_td_data = last_tr.find('td:first').html();
            first_td_data++;
            last_tr.find('td:first').html(first_td_data);
            last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");
            $('table.stock tr:last').after(last_tr);
        });




        //delete rows in tables #guarantor,work and education tables
        $('form').on('click', '.remove_tr', function (e) {
                var whr = $(this).closest('table').attr('class');
                if (whr.indexOf("stock") !== -1) {
                    var to = "stock";
                } else if (whr.indexOf("work_experience") !== -1) {
                    var to = "work_experience";
                } else if (whr.indexOf("education") !== -1) {
                    var to = "education";
                }


                $(this).closest('tr').slideUp(500).remove();

                if ($('table.' + to + ' tbody tr').length != 1) {
                    //After deleting, add delete button on remaining tr
                    $('table.' + to + ' tr:last').find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");
                }


            }
        );

    </script>

@endsection



