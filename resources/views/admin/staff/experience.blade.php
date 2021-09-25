
<!-- Work Experience Details Ends-->
<div class="row">
    <span class="label label-info" style=" font-size: 17px !important; text-transform: uppercase">Work Experience</span><br /><br /><small>Enter Work experience from oldest to
        recent</small><br /><br />


    <table class="table table-hover work_experience">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Name of Establishment</th>
            <th>Start Year</th>
            <th>End Year</th>
            <th>Position Held</th>
            <th>Job Functions</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(Session::has('workEducation') &&
        Session::get('workEducation')['institution_name'])
            <?php $counter = 1;?>
            @for ($i = 0; $i < sizeof(Session::get('workEducation')['institution_name']);
                $i++) <tr>
                <td>{{$counter++}}</td>

                <td>
                    <input type="text" name="institution_name[]" autocomplete="off"
                           value="{{ Session::get('workEducation')['institution_name'][$i] ?? '' }}"
                           class="form-control" data-provide="datepicker"
                           data-date-container="">
                </td>

                <td>
                    <div class="mb-3 position-relative" id="work_start_year">
                        <select name="work_start_year[]" class="form-control select select2" data-toggle="select2">
                            @include('admin.includes.year-options')
                        </select>
                    </div>
                </td>

                <td>
                    <div class="mb-3 position-relative" id="work_end_year">
                        <select name="work_end_year[]" class="form-control select select2" data-toggle="select2">
                            @include('admin.includes.year-options')
                        </select>
                    </div>
                </td>

                <td>
                    <input autocomplete="off"
                           value="{{ Session::get('workEducation')['position_held'][$i] ?? '' }}"
                           class="form-control underline" id="position_held" type="text"
                           name="position_held[]">
                </td>

                <td>
                    <input autocomplete="off"
                           value="{{ Session::get('workEducation')['job_functions'][$i] ?? '' }}"
                           class="form-control underline" name="job_functions[]" id="job_functions" type="text"
                           id="">
                </td>

                <td></td>
            </tr>
            @endfor
        @else

            <tr>
                <td>1</td>

                <td>
                    <input autocomplete="off" class="form-control underline"
                           id="institution_name" type="text" name="institution_name[]">
                </td>

                <td>
                    <div class="mb-3 position-relative" id="work_start_year">
                        <input type="text" class="form-control"
                               placeholder="YYYY only e.g 2004" name="work_start_year[]"
                               id="work_start_year" data-provide="datepicker"
                               data-date-container="#work_start_year">
                    </div>
                </td>

                <td>
                    <div class="mb-3 position-relative" id="work_end_year">
                        <input type="text" class="form-control"
                               placeholder="YYYY only e.g 2004" name="work_end_year[]"
                               id="work_end_year" autocomplete="off"
                               data-provide="datepicker"
                               data-date-container="#work_end_year">
                    </div>
                </td>

                <td>
                    <input autocomplete="off" value="" class="form-control underline"
                           id="position_held" type="text" name="position_held[]">
                </td>

                <td>
                    <input autocomplete="off" class="form-control underline"
                           name="job_functions[]" id="job_functions" value="" type="text">
                </td>

                <td></td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="more_work" style="margin-bottom: 25px">
        <span class="btn btn-primary">Click to Add More Work Experience <i class="fa fa-plus"></i></span>
    </div>
</div>

<!-- Educational Details Details Ends-->
<div class="row">
    <span class="label label-info" style=" font-size: 17px !important; text-transform: uppercase">Education Details</span>
    <br /><br />
    <small>Enter Education Details from oldest to recent</small>
    <br /><br />


    <table class="table table-hover education">
        <thead>
        <tr>
            <td>S/N</td>
            <th>Upload</th>
            <th>Education Type</th>
            <th>Start Year</th>
            <th>End Year</th>
            <th>Name of Institution</th>
            <th>Course</th>
            <th>Qualification</th>
            {{--            <th>Class</th>--}}
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(Session::has('workEducation'))
            <?php $counter = 1;?>
            @for ($i = 0; $i < sizeof(Session::get('workEducation')['education_type']); $i++)
                <tr>
                    <td>{{$counter++}}</td>
                    <td><input type="file" name="document_photo[]" class="form-control" /></td>

                    <td>
                        <input type="text" name="education_type[]" class="form-control" value="{{ Session::get('workEducation')['education_type'][$i] ?? '' }}" />
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="start_year">
                            <select id="startYear" name="start_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="mb-3 position-relative" id="end_year">
                            <select id="startYear" name="end_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </td>

                    <td>
                        <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                               value="{{ Session::get('workEducation')['institution_name'][$i] ?? '' }}"
                               id="institution_name" type="text" name="institution_name[]">
                    </td>

                    <td>
                        <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                               value="{{ Session::get('workEducation')['course_name'][$i] ?? '' }}"
                               id="course" type="text" name="course_name[]">
                    </td>

                    <td>
                        <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                               value="{{Session::get('workEducation')['qualification'][$i] ?? '' }}"
                               id="course" type="text" name="qualification[]">
                    </td>

                    {{--                    <td>--}}
                    {{--                        <select class="form-control" name="education_class_id[]"--}}
                    {{--                                id="education_class_id">--}}
                    {{--                            <option--}}
                    {{--                                    value="{{ Session::get('workEducation')['education_class_id'][$i] ?? '' }}"--}}
                    {{--                                    selected>{{ Session::has('workEducation') ?--}}
                    {{--                                                        Session::get('workEducation')['education_class_id'][$i] ?? '' }}--}}
                    {{--                            </option>--}}
                    {{--                            @if(isset($education_class_collection))--}}
                    {{--                                @if(!$education_class_collection->isEmpty())--}}
                    {{--                                    @foreach($education_class_collection as $val)--}}
                    {{--                                        <option value="{{ $val->id }}">{{ $val->type }} </option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                @endif--}}
                    {{--                            @endif--}}
                    {{--                        </select>--}}
                    {{--                    </td>--}}
                </tr>
            @endfor
        @else
            <tr>
                <td>1</td>
                <td>
                    <input type="text" name="education_type[]" class="form-control" />
                </td>

                <td>
                    <div class="mb-3 position-relative" id="start_year">
                        <div class="mb-3 position-relative" id="start_year">
                            <select id="startYear" name="start_year[]" class="form-control select select2" data-toggle="select2">
                                @include('admin.includes.year-options')
                            </select>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="mb-3 position-relative">
                        <select id="startYear" name="end_year[]" class="form-control select select2" data-toggle="select2">
                            @include('admin.includes.year-options')
                        </select>
                    </div>
                </td>

                <td>
                    <input autocomplete="off" placeholder="Ignore if not applicable"
                           value="{!! old('institution_name') !!}"
                           class="form-control underline" id="institution_name" type="text"
                           name="institution_name[]">
                </td>

                <td>
                    <input autocomplete="off" placeholder="Ignore if not applicable"
                           value="{!! old('course_name') !!}"
                           class="form-control underline" id="course_name" type="text"
                           name="course_name[]">
                </td>

                <td>
                    <select class="form-control" name="qualification[]" id="qualification">
                        <option selected value="">--Select Type--</option>
                        @if(isset($education_qual_collection))
                            @if(!$education_qual_collection->isEmpty())
                                @foreach($education_qual_collection as $val)
                                    <option value="{{ $val->id }}">{{ $val->type }} </option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </td>

                <td>
                    <select class="form-control" name="education_class_id[]"
                            id="education_class_id">
                        <option selected value="">--Select Type--</option>
                        @if(isset($education_class_collection))
                            @if(!$education_class_collection->isEmpty())
                                @foreach($education_class_collection as $val)
                                    <option value="{{ $val->id }}">{{ $val->type }} </option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </td>
                <td></td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="more_education" style="margin-bottom: 25px">
        <span class="btn btn-primary">Click to Add More Education <i class="ti-plus"></i>
        </span>
    </div>
</div>

<div class="row" style="margin-top:10px">
    <div class="row" style="margin-top:30px">
        <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
            <button type="button" class="btn btn-primary" name="back" value="Back" id="btnBack">Back</button>
        </div>
        <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
            <input type="submit" class="btn btn-primary" name="proceed" value="Submit" id="submit">
        </div>
    </div>
</div>
<!-- end row -->

<script>

    $("#btnBack").click(function (e) {
        $('.nav-tabs a[href="#company"]').tab('show');
    });

    //more work functionality
    $('div.more_work').click(function (e) {
        //look for previous delete button and remove
        $('table.work_experience tr:last').find('td:last').html("");

        var last_tr = $('table.work_experience tr:last').clone();
        //implement changes and clear all data
        last_tr.find(':text').val('');
        last_tr.find('textarea').val("");
        first_td_data = last_tr.find('td:first').html();
        first_td_data++;
        last_tr.find('td:first').html(first_td_data);
        last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");

        $('table.work_experience tr:last').after(last_tr);

    });

    //more education functionality
    $('div.more_education').click(function (e) {
        //look for previous delete button and remove
        $('table.education tr:last').find('td:last').html("");

        var last_tr = $('table.education tr:last').clone();
        //implement changes and clear all data
        last_tr.find(':text').val('');
        last_tr.find('select').val('');
        first_td_data = last_tr.find('td:first').html();
        first_td_data++;
        last_tr.find('td:first').html(first_td_data);
        last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");

        $('table.education tr:last').after(last_tr);

    });
</script>