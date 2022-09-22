<div class="row" id="companyInfoForm">

    <?php
    $selectedBank = null;
    $staffUnit = null;
    if(Session::has('companyInfo')){
        $companyInfo = Session::get('companyInfo');
        $ex= explode("|",$companyInfo['bank']);

        $selectedBank =$ex[0];

        $expUnit= explode("|",$companyInfo['staffUnit']);
        $staffUnit = $expUnit[0];

        $expdept = explode("|",$companyInfo['staffDepartment']);
        $staffDepartment = $expdept[0];


        $expLevel = explode("|",$companyInfo['staffLevel']);
        $staffLevel = $expLevel[0];

        $expUnit = explode("|",$companyInfo['staffUnit']);
        $staffUnit = $expUnit[0];

        $expRespType = explode("|",$companyInfo['resumptionType']);
        $resumptionType = $expRespType[0];

        $office = explode("|",$companyInfo['staffBranch']);
        $staffBranch = $office[0];
        //staffDepartment
        //staffUnit
    }
    ?>

    <div class="col-lg-6 mt-3">
        <label class="form-label">
            Staff Code
        </label>
        <input type="text" name="staffCode" class="form-control" id="staffCode" readonly value="{{$staffCode}}"/>
        <button class="btn btn-primary btn-sm" type="button" id="editStaffCode"><span class="uil-edit"></span></button>
    </div> <!-- end col -->


    <div class="col-lg-6 mt-3">
        <label class="form-label font-14">
            Staff Status
        </label>
        <select class="form-control select2" name="status" data-toggle="select2">
            {{-- <option value="{{Session::has('companyInfo') ? Session::get('companyInfo')['status'] : '' }}" selected>{{ Session::has('companyInfo') ?
                                            Session::get('companyInfo')['status'] : '' }}</option> --}}
            <option>Abscondment</option>
            <option>Death</option>
            <option>Incapacitation</option>
            <option>Regular</option>
            <option>Retirement</option>
            <option>Resignation</option>
        </select>
    </div> <!-- end col -->

    <div class="col-lg-6 mt-3">
        <label class="form-label"> Select Staff Branch </label>
        <select id="staffBranch" class="form-control select2" name="staffBranch"
                data-toggle="select2" required>
            {{-- @if(Session::has('companyInfo'))
                <option value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffBranch'] : '' }}"
                        selected>{{ isset($staffBranch)? $staffBranch: '' }}</option>
            @endif --}}

            @if(isset($offices))
                @foreach($offices as $office)
                    <option value="{{$office->id}}|{{$office->name}}">{{$office->name}}</option>
                @endforeach
            @else

            @endif
        </select>
    </div> <!-- end col -->


    <!-- Bank Details Start -->
    <div class="col-md-6 mt-3">
        <label for="example-date" class="form-label">Select Bank</label>
        <select id="bank" class="form-control select2" name="bank" data-toggle="select2" required>

            {{-- @if(Session::has('companyInfo'))
                <option value="{{Session::get('companyInfo')['bank'] ?? 'Access Bank' }}" selected>{{ isset($selectedBank)? $selectedBank: '' }}</option>
            @endif --}}
            @if(isset($banks))
            <option value="">Select Bank</option>
                @foreach($banks as $bank)
                    <option value="{{$bank->id}}|{{$bank->bank_name}}">{{$bank->bank_name}}</option>
                @endforeach
            @else

            @endif
        </select>
    </div> <!-- end col -->

    <div class="col-md-6 mt-3">
        <label class="form-label">Account Name</label>
        <input name="accountName" required type="text" class="form-control"
               {{-- value="{{ Session::get('companyInfo')['accountName'] ?? '' }}" --}} data-provide="accountName" id="accountName">
    </div>
    <!-- end col -->


    <div class="col-md-6 mt-3">
        <div class="mb-0">
            <label class="form-label">Account Number</label>
            <input name="accountNumber" required type="text" class="form-control"
                   {{-- value="{{Session::get('companyInfo')['accountNumber'] ?? '' }}" --}} data-provide="accountNumber" id="accountNumber">
        </div>
    </div> <!-- end col -->
    <!-- bankd Details Ends-->

    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Access Level</label>
        <select id="accessLevel" class="form-control select2" name="accessLevel" data-toggle="select2" required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div> <!-- end col -->


    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Department Role</label>
        <select id="staffDepartmentRole" class="form-control select2" name="staffDepartmentRole" data-toggle="select2" required>
            <option value=""> Select Departmental Role</option>
            {{-- <option value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartmentRole'] : '' }}"
                    selected>{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartmentRole'] : '' }}</option> --}}
            <option>Member </option>
            <option>Department Head</option>
        </select>
    </div>
    <!-- end col -->


    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Department</label>
        <select id="staffDepartment" class="form-control select2" name="staffDepartment"
                data-toggle="select2" required>
            <option value=""> Select </option>

        {{-- @if(Session::has('companyInfo'))
                <option value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffDepartment'] : '' }}" selected>
                    {{ isset($staffDepartment)? $staffDepartment: '' }}
                </option>
            @endif --}}

            @if(isset($departments))
                @foreach($departments as $department)
                    <option value="{{$department->id}}|{{$department->title}}">{{$department->title}}</option>
                @endforeach
            @else
                <option>Branch Management</option>
                <option>Director's Office</option>
            @endif

        </select>
    </div> <!-- end col -->


    <!-- staff unit and department starts -->
    <div class="col-lg-6 mt-3">
        <label for="example-date" class="form-label">Staff Unit</label>
        <select id="staffUnit" class="form-control select2" name="staffUnit" data-toggle="select2">
            <option value=""> Select </option>

            {{-- @if(Session::has('companyInfo'))
                <option
                        value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffUnit'] : '' }}"
                        selected>{{ isset($staffUnit)? $staffUnit: 'n' }}</option>
            @endif --}}
            @if(isset($units))
                @foreach($units as $unit)
                    <option value="{{$unit->id}}|{{$unit->title}}">{{$unit->title}}</option>
                @endforeach
            @else

                <option>Regular Spot</option>
                <option>VIP</option>
            @endif


        </select>
    </div> <!-- end col -->
    <!-- staff unit and department ends -->


    <table class="table table-hover guarantor">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Photo</th>
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
                        <input type="file" class="form-control underline" type="text" name="g_photo[]" required>
                    </td>

                    <td>
                        <input placeholder="First Name  LastName" autocomplete="off"
                               {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_name'][$i] : '' }}" --}}
                               class="form-control underline" id="g_name" type="text" name="g_name[]" required>
                    </td>

                    <td>
                        <input autocomplete="off"
                               {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_phone'][$i] : '' }}" --}}
                               class="form-control underline" id="g_phone" type="text"
                               name="g_phone[]" required>
                    </td>

                    <td>
                        <input autocomplete="off"
                               {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_email'][$i] : '' }}" --}}
                               class="form-control underline" id="g_email" type="text"
                               name="g_email[]" required>
                    </td>

                    <td>
                        <input autocomplete="off"
                               {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_office_address'][$i] : '' }}" --}}
                               class="form-control underline" id="g_office_address" type="text"
                               name="g_office_address[]" required>
                    </td>

                    <td>
                        <input autocomplete="off" {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_home_address'][$i] : '' }}" --}}
                               class="form-control underline" id="g_home_address" type="text"
                               name="g_home_address[]" required>
                    </td>

                    <td>
                    <span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'>
                        <i class="uil-multiply"></i>
                    </span>
                    </td>

                </tr>
            @endfor
        @else
            <tr>
                <td>1</td>

                <td>
                    <input type="file" class="form-control underline" type="text" name="g_photo[]" required>
                </td>

                <td>
                    <input placeholder="FirstName  LastName" autocomplete="off"
                           {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_name'] : '' }}" --}}
                           class="form-control underline" id="g_name" type="text" name="g_name[]" required>
                </td>

                <td>
                    <input autocomplete="off"
                           {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_phone'] : '' }}" --}}
                           class="form-control underline" id="g_phone" type="text"
                           name="g_phone[]" required>
                </td>

                <td>
                    <input autocomplete="off"
                           {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_email'] : '' }}" --}}
                           class="form-control underline" id="g_email" type="text"
                           name="g_email[]" required>
                </td>

                <td>
                    <input autocomplete="off"
                           {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_office_address'] : '' }}" --}}
                           class="form-control underline" id="g_office_address" type="text"
                           name="g_office_address[]">
                </td>

                <td>
                    <input autocomplete="off"
                           {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['g_home_address'] : '' }}" --}}
                           class="form-control underline" id="g_home_address" type="text"
                           name="g_home_address[]">
                </td>

                <td></td>

            </tr>
        @endif
        </tbody>
    </table>

    <div class="more_guarantor" style="margin-bottom: 15px">
        <span class="btn btn-primary">Click to Add More Guarantors <i class="fa fa-plus"></i></span>
    </div>

    <div class="col-lg-4 mt-3">
        <div class="mb-3 position-relative" id="datepicker2">
            <label class="form-label">Resumption Date</label>
            <input type="text" name="resumptionDate" placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01"
                   {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['resumptionDate'] : '' }}" --}}
                   class="form-control" data-provide="datepicker" id="resumptionDate" data-date-container="#datepicker2">
        </div>
    </div> <!-- end col -->


    <div class="col-lg-4 mt-3">
        <div class="mb-3 position-relative" id="datepicker3">
            <label class="form-label">Assumption date</label>
            <input type="text" name="assumptionDate" placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01"
                   {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['assumptionDate'] : '' }}" --}}
                   class="form-control" data-provide="datepicker" id="assumptionDate" data-date-container="#datepicker3">
        </div>
    </div> <!-- end col -->

    <div class="col-md-4 mt-3">
        <div class="mb-3 position-relative" id="datepicker4">
            <label class="form-label">Termination date</label>
            <input type="text" name="terminationDate" placeholder="Enter in format YYYY-MM-DD e.g 1980-12-01"
                   {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['terminationDate'] : '' }}" --}}
                   class="form-control" data-provide="datepicker" id="terminationDate" data-date-container="#datepicker4">
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6 mt-3">
        <label class="form-label"> Staff Level </label>
        <select id="staffLevel" class="form-control select2" name="staffLevel"
                data-toggle="select2" required>
            @if(Session::has('companyInfo'))
                <option
                        {{-- value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['staffLevel'] : '' }}" --}}
                        selected>{{ isset($staffLevel)? $staffLevel: '' }}</option>
            @endif

            @if(isset($levels))
                @foreach($levels as $level)
                    <option value="{{$level->id}}|{{$level->title}}">{{$level->title}}</option>
                @endforeach
            @else

            @endif

        </select>
    </div> <!-- end col -->

    <div class="col-lg-6 mt-3">

        <label class="form-label">
            Staff Resumption Type
        </label>
        <select id="resumptionType" class="form-control select2" name="resumptionType"
                data-toggle="select2" required>
            {{-- @if(Session::has('companyInfo'))
                <option value="{{ Session::has('companyInfo') ? Session::get('companyInfo')['resumptionType'] : '' }}"
                        selected>{{ isset($resumptionType)? $resumptionType: '' }}</option>
            @endif --}}

            @if(isset($resumptionTypes))
                @foreach($resumptionTypes as $resumptionType)
                    <option value="{{$resumptionType->id}}|{{$resumptionType->title}}">{{$resumptionType->title}}</option>
                @endforeach
            @else

            @endif
        </select>
    </div> <!-- end col -->

    <div class="row" style="margin-top:30px">
        <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
            <button class="btn btn-primary" name="back" value="Back" id="previousCompanyInfo" type="button">Back</button>
        </div>
        <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
            <button class="btn btn-primary" name="proceed" value="Proceed"  id="proceedCompanyInfo" type="button">Proceed</button>
        </div>
    </div>

</div>
<!-- end row -->

{{--@section('script')--}}
<script>
    $(document).ready(function() {

        var validateCompanyInfo = jQuery("#newStaffForm").validate({
            rules: {
                status: {
                    required: true,
                    minlength: 2,
                    maxlength: 16
                },
                staffBranch: {
                    required: true,
                    minlength: 2,
                    maxlength: 100,
                },
                bank: {
                    required: true,
                    minlength: 6,
                    maxlength: 15,
                },
                accountName: {
                    required: true,
                },
                accountNumber: {
                    required: true,
                },
                staffUnit: {
                    required: true,
                },
                staffDepartment: {
                    required: true,
                },
                resumptionDate: {
                    required: true,
                },
                assumptionDate: {
                    required: true,
                },
                staffLevel: {
                    required: true,
                },
            },
            errorElement: "span",
            errorClass: "help-inline",
        });

        $("#editStaffCode").click(function (e) {
            $("#staffCode").removeAttr('readonly');
        });

        $("#previousCompanyInfo").click(function (e) {
            $('.nav-tabs a[href="#personal"]').tab('show')
        });

        $("#proceedCompanyInfo").click(function (e) {
            if(validateCompanyInfo.form()) {
                $('.nav-tabs a[href="#experience"]').tab('show');
            }
        });

        //staffDepartment
        $("#staffDepartment").change(function (e) {
            let selectedStaffDepartment = $(this).val();
            //If the user selected a department
            if(selectedStaffDepartment != "") {
                $("#staffUnit").prop('disabled', true);
            }
            else{
                $("#staffUnit").prop('disabled', false);
            }
        });

        //staffRole
        $("#staffUnit").change(function (e) {
            let selectedStaffDepartment = $(this).val();
            //If the user selected a department
            if(selectedStaffDepartment != "") {
                $("#staffDepartment").prop('disabled', true);
            }
            else{
                $("#staffDepartment").prop('disabled', false);
            }
        });


    });




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
    });

</script>
{{--@endsection--}}



