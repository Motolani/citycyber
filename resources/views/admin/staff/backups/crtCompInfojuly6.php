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
            <h4 class="page-title">Create Staff</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">

    <div class="col-12" id="h_div" style="align-content:right, float:right">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" style="">Staff Management</h4>
                <p class="text-muted font-14">
                    Here if the first level where you can insert all personal staff's Information
                </p>

                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            COMPANY INFORMATION
                        </a>
                    </li>
                </ul> <!-- end nav-->

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                        <form method="POST" action="{{route('createstaffConpanyInfo')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Staff Status
                                    </p>
                                    <select id="state" class="form-control select2" name="status" data-toggle="select2">
                                        <option
                                            value="{{Session::has('companyInfo') ? Session::get('companyInfo')['status'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['status'] : '' }}</option>
                                        <option>Abscondment</option>
                                        <option>Death</option>
                                        <option>Incapacitation</option>
                                        <option>Regular</option>
                                        <option>Retirement</option>
                                        <option>Resignation</option>
                                    </select>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Select Staff Branch
                                    </p>
                                    <select id="staffBranch" class="form-control select2" name="staffBranch"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffBranch'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['staffBranch'] : '' }}</option>
                                        <option>Isolo</option>
                                        <option>Mushin</option>
                                    </select>
                                </div> <!-- end col -->
                            </div>

                            <br />

                            <!-- Bank Details Start -->
                            <div class="row">

                                <div class="col-lg-3 mt-3 mt-lg-0">
                                    <label for="example-date" class="form-label">Select Bank</label>
                                    <select id="bank" class="form-control select2" name="bank" data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['bank'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['bank'] : 'Select' }}</option>
                                        <option>Gtbank</option>
                                        <option>Access</option>
                                    </select>
                                </div> <!-- end col -->

                                <div class="col-lg-3">
                                    <div class="mb-0">
                                        <label class="form-label">Account Name</label>
                                        <input name="accountName" required type="text" class="form-control"
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                            data-provide="accountName" id="accountName">
                                    </div>
                                </div> <!-- end col -->



                                <div class="col-lg-3">
                                    <div class="mb-0">
                                        <label class="form-label">Account Number</label>
                                        <input name="accountNumber" required type="text" class="form-control"
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountNumber'] : '' }}"
                                            data-provide="accountNumber" id="accountNumber">
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-lg-3 mt-3 mt-lg-0">
                                    <label for="example-date" class="form-label">Select Gender</label>
                                    <select id="gender" class="form-control select2" name="gender"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['gender'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['gender'] : '' }}</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div> <!-- end col -->
                            </div>

                            <br />


                            <!-- bankd Details Ends-->




                            <!-- staff unit and department starts -->
                            <div class="row">

                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <label for="example-date" class="form-label">Staff Unit</label>
                                    <select id="staffUnit" class="form-control select2" name="staffUnit"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffUnit'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['staffUnit'] : '' }}</option>
                                        <option>Regular Spot</option>
                                        <option>VIP</option>
                                    </select>
                                </div> <!-- end col -->

                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <label for="example-date" class="form-label">Staff Department</label>
                                    <select id="staffDepartment" class="form-control select2" name="staffDepartment"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartment'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['staffDepartment'] : '' }}</option>
                                        <option>Branch Management</option>
                                        <option>Director's Office</option>
                                    </select>
                                </div> <!-- end col -->


                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <label for="example-date" class="form-label">Staff Department Role</label>
                                    <select id="staffDepartmentRole" class="form-control select2"
                                        name="staffDepartmentRole" data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartmentRole'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['staffDepartmentRole'] : '' }}</option>
                                        <option>Member </option>
                                        <option>Department Head</option>
                                    </select>
                                </div> <!-- end col -->



                            </div>
                            <!-- staff unit and department ends -->



                            <table class="table table-hover guarantor">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Guarantor's Name</th>
                                        <th>Guarantor's Phone</th>
                                        <th>Guarantor's Email</th>
                                        <th>Guarantor's Office Address</th>
                                        <th>Guarantor's Home Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session::has('companyInfo') && Session::get('companyInfo')['g_name'])
                                    <?php $counter = 1;?>
                                        @for ($i = 0; $i < sizeof(Session::get('companyInfo')['g_name']); $i++)
                                        <tr>
                                            <td>{{$counter++}}</td>

                                            <td>
                                                <input placeholder="FirstName  LastName" autocomplete="off"
                                                    value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_name'][$i] : '' }}"
                                                    class="form-control underline" id="g_name" type="text" name="g_name[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_phone'][$i] : '' }}"
                                                    class="form-control underline" id="g_phone" type="text"
                                                    name="g_phone[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_email'][$i] : '' }}"
                                                    class="form-control underline" id="g_email" type="text"
                                                    name="g_email[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_office_address'][$i] : '' }}"
                                                    class="form-control underline" id="g_office_address" type="text"
                                                    name="g_office_address[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_home_address'][$i] : '' }}"
                                                    class="form-control underline" id="g_home_address" type="text"
                                                    name="g_home_address[]">
                                            </td>

                                            <td>
                                                <span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'>
                                                    <i class='fa fa-trash-o'> Remove</i>
                                                </span>
                                            </td>

                                        </tr>
                                        @endfor
                                    @else
                                    <tr>
                                        <td>1</td>

                                        <td>
                                            <input placeholder="FirstName  LastName" autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_name'] : '' }}"
                                                class="form-control underline" id="g_name" type="text" name="g_name[]">
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_phone'] : '' }}"
                                                class="form-control underline" id="g_phone" type="text"
                                                name="g_phone[]">
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_email'] : '' }}"
                                                class="form-control underline" id="g_email" type="text"
                                                name="g_email[]">
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_office_address'] : '' }}"
                                                class="form-control underline" id="g_office_address" type="text"
                                                name="g_office_address[]">
                                        </td>

                                        <td>
                                            <input autocomplete="off"
                                                value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_home_address'] : '' }}"
                                                class="form-control underline" id="g_home_address" type="text"
                                                name="g_home_address[]">
                                        </td>

                                        <td></td>

                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="more_guarantor" style="margin-bottom: 15px">
                                <span class="btn btn-primary">Click to Add More Guarantors <i
                                        class="fa fa-plus"></i></span>
                            </div>






                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-0">
                                        <label class="form-label">Resumption Date</label>
                                        <input name="resumptionDate"
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                            placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" required type="text"
                                            class="form-control" data-provide="phone" id="resumptionDate">
                                    </div>
                                </div> <!-- end col -->


                                <div class="col-lg-4">
                                    <div class="mb-0">
                                        <label class="form-label">Assumption date</label>
                                        <input name="assumptionDate" type="text"
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                            placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" class="form-control"
                                            data-provide="typeahead" id="assumptionDate">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-lg-4">
                                    <div class="mb-0">
                                        <label class="form-label">Termination Date</label>
                                        <input name="terminationDate"
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['accountName'] : '' }}"
                                            placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01" type="text"
                                            class="form-control" data-provide="typeahead" id="terminationDate">
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Staff Level
                                    </p>
                                    <select id="staffLevel" class="form-control select2" name="staffLevel"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffLevel'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['staffLevel'] : '' }}</option>
                                        <option>Abscondment</option>
                                        <option>Death</option>
                                        <option>Incapacitation</option>
                                        <option>Regular</option>
                                        <option>Retirement</option>
                                        <option>Resignation</option>

                                    </select>
                                </div> <!-- end col -->

                                <div class="col-lg-6 mt-3 mt-lg-0">
                                    <p class="mb-1 fw-bold text-muted"></p>
                                    <p class="text-muted font-14">
                                        Staff Resumption Type
                                    </p>
                                    <select id="resumptionType" class="form-control select2" name="resumptionType"
                                        data-toggle="select2">
                                        <option
                                            value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['resumptionType'] : '' }}"
                                            selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['resumptionType'] : '' }}</option>
                                        <option>Isolo</option>
                                        <option>Mushin</option>
                                    </select>
                                </div> <!-- end col -->
                            </div>

                            <div class="row" style="margin-top:30px">
                                <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                                    <button class="btn btn-primary" name="back" value="Back" id="submit">Back</button>
                                </div>
                                <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                                    <button class="btn btn-primary" name="proceed" value="Proceed"
                                        id="submit">Proceed</button>
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
<!-- end row -->
@endsection


@section('script')
<script>

    //more guarantor's functionality
    $('div.more_guarantor').click(function (e) {
        //look for previous delete button and remove
        $('table.guarantor tr:last').find('td:last').html("");

        //clone business
        var last_tr = $('table.guarantor tr:last').clone();
        //implement changes and clear all data
        last_tr.find(':text').val('');
        first_td_data = last_tr.find('td:first').html();
        first_td_data++;
        last_tr.find('td:first').html(first_td_data);
        last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");
        $('table.guarantor tr:last').after(last_tr);
    });




    //delete rows in tables #guarantor,work and education tables
    $('form').on('click', '.remove_tr', function (e) {
        var whr = $(this).closest('table').attr('class');
        if (whr.indexOf("guarantor") !== -1) {
            var to = "guarantor";
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
