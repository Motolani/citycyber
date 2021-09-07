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
                {{--
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Experience
                        </a>
                    </li>
                </ul> <!-- end nav-->
                --}}
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link">
                            PERSONAL INFORMATION
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link">
                            COMPANY INFORMATION
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link active">
                            EXPERIENCE
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link">
                            SUMMARY
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="typeahead-preview">
                        <form method="POST" action="{{route('createWorkAndEduction')}}">
                            @csrf
                            <!-- Work Experience Details Ends-->
                            <div class="row">
                                <span class="label label-info"
                                    style=" font-size: 17px !important; text-transform: uppercase">Work
                                    Experience</span><br /><br /><small>Enter Work experience from oldest to
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
                                        Session::get('workEducation')['establishment_name'])
                                        <?php $counter = 1;?>
                                        @for ($i = 0; $i < sizeof(Session::get('workEducation')['establishment_name']);
                                            $i++) <tr>
                                            <td>{{$counter++}}</td>

                                            <td>
                                                <input type="text" name="establishment_name[]" autocomplete="off"
                                                    value="{{ Session::has('workEducation') ? Session::get('workEducation')['establishment_name'][$i] : '' }}"
                                                    class="form-control" data-provide="datepicker"
                                                    data-date-container="#datepicker1">
                                            </td>

                                            <td>
                                                <div class="mb-3 position-relative" id="work_start_year">
                                                    <input type="text" name="work_start_year[]" autocomplete="off"
                                                        placeholder="YYYY only e.g 2004"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['work_start_year'][$i] : '' }}"
                                                        class="form-control" data-provide="datepicker"
                                                        data-date-container="#work_start_year">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3 position-relative" id="work_end_year">
                                                    <input type="text" name="work_end_year[]" autocomplete="off"
                                                        placeholder="YYYY only e.g 2004"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['work_end_year'][$i] : '' }}"
                                                        class="form-control" data-provide="datepicker"
                                                        data-date-container="#work_end_year">
                                                </div>
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('workEducation') ? Session::get('workEducation')['position_held'][$i] : '' }}"
                                                    class="form-control underline" id="position_held" type="text"
                                                    name="position_held[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off"
                                                    value="{{ Session::has('workEducation') ? Session::get('workEducation')['job_functions'][$i] : '' }}"
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
                                                        id="establishment_name" type="text" name="establishment_name[]">
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
                                    <span class="btn btn-primary">Click to Add More Work Experience <i
                                            class="fa fa-plus"></i></span>
                                </div>
                            </div>



                            <!-- Educational Details Details Ends-->
                            <div class="row">
                                <span class="label label-info"
                                    style=" font-size: 17px !important; text-transform: uppercase">Education
                                    Details</span><br /><br /><small>Enter Education Details from oldest to
                                    recent</small><br /><br />


                                <table class="table table-hover education">
                                    <thead>
                                        <tr>
                                            <td>S/N</td>
                                            <th>Education Type</th>
                                            <th>Start Year</th>
                                            <th>End Year</th>
                                            <th>Name of Institution</th>
                                            <th>Course/Certification</th>
                                            <th>Qualification</th>
                                            <th>Class</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Session::has('workEducation'))
                                        <?php $counter = 1;?>
                                        @for ($i = 0; $i < sizeof(Session::get('workEducation')['education_type_id']);
                                            $i++) <tr>

                                            <td>{{$counter++}}</td>
                                            <td>

                                                <select class="form-control" name="education_type_id[]"
                                                    id="education_type_id">
                                                    <option
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_type_id'][$i] : '' }}"
                                                        selected>{{ Session::has('workEducation') ?
                                                        Session::get('workEducation')['education_type_id'][$i] : '' }}
                                                    </option>
                                                    @if(isset($education_type_collection))
                                                    @if(!$education_type_collection->isEmpty())
                                                    @foreach($education_type_collection as $val)
                                                    <option value="{{ $val->id }}">{{
                                                        $val->type }} </option>
                                                    @endforeach
                                                    @endif
                                                    @endif
                                                </select>

                                            </td>

                                            <td>
                                                <div class="mb-3 position-relative" id="start_year">
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                        data-provide="datepicker" data-date-container="#start_year"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['start_year'][$i] : '' }}"
                                                        class="form-control underline datepicker" 
                                                        type="text" name="start_year[]">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3 position-relative" id="end_year">
                                                    <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                        data-provide="datepicker" data-date-container="#end_year"
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['end_year'][$i] : '' }}"
                                                        class="form-control underline datepicker"
                                                        type="text" name="end_year[]">
                                                </div>
                                            </td>

                                            <td>
                                                <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                                                    value="{{ Session::has('workEducation') ? Session::get('workEducation')['institution_name'][$i] : '' }}"
                                                    id="institution_name" type="text" name="institution_name[]">
                                            </td>

                                            <td>
                                                <input autocomplete="off" placeholder="Ignore if not applicable" class="form-control"
                                                    value="{{ Session::has('workEducation') ? Session::get('workEducation')['course_name'][$i] : '' }}"
                                                    id="course_name" type="text" name="course_name[]">
                                            </td>

                                            <td>
                                                <select class="form-control" name="education_qual_id[]"
                                                    id="education_qual_id">
                                                    <option
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_qual_id'][$i] : '' }}"
                                                        selected>{{ Session::has('workEducation') ?
                                                        Session::get('workEducation')['education_qual_id'][$i] : '' }}
                                                    </option>
                                                    @if(isset($education_qual_collection))
                                                    @if(!$education_qual_collection->isEmpty())
                                                    @foreach($education_qual_collection as $val)
                                                    <option value="{{ $val->id }}">{{
                                                        $val->type }} </option>
                                                    @endforeach
                                                    @endif
                                                    @endif
                                                </select>
                                            </td>

                                            <td>
                                                <select class="form-control" name="education_class_id[]"
                                                    id="education_class_id">
                                                    <option
                                                        value="{{ Session::has('workEducation') ? Session::get('workEducation')['education_class_id'][$i] : '' }}"
                                                        selected>{{ Session::has('workEducation') ?
                                                        Session::get('workEducation')['education_class_id'][$i] : '' }}
                                                    </option>
                                                    @if(isset($education_class_collection))
                                                    @if(!$education_class_collection->isEmpty())
                                                    @foreach($education_class_collection as $val)
                                                    <option value="{{ $val->id }}">{{
                                                        $val->type }} </option>
                                                    @endforeach
                                                    @endif
                                                    @endif
                                                </select>
                                            </td>

                                            <td></td>
                                            </tr>
                                            @endfor
                                            @else
                                            <tr>

                                                <td>1</td>
                                                <td>

                                                    <select class="form-control" name="education_type_id[]"
                                                        id="education_type_id">
                                                        <option selected value="">--Select Type--</option>
                                                        @if(isset($education_type_collection))
                                                        @if(!$education_type_collection->isEmpty())
                                                        @foreach($education_type_collection as $val)
                                                        <option value="{{ $val->id }}">{{
                                                            $val->type }} </option>
                                                        @endforeach
                                                        @endif
                                                        @endif
                                                    </select>

                                                </td>

                                                <td>
                                                    <div class="mb-3 position-relative" id="start_year">
                                                        <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                            value="{!! old('start_year') !!}"
                                                            class="form-control underline datepicker" id="start_year"
                                                            type="text" name="start_year[]">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="mb-3 position-relative" id="start_year">
                                                        <input placeholder="YYYY only e.g 2004" autocomplete="off"
                                                            value="{!! old('end_year') !!}"
                                                            class="form-control underline datepicker" id="end_year"
                                                            type="text" name="end_year[]">
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
                                                    <select class="form-control" name="education_qual_id[]"
                                                        id="education_qual_id">
                                                        <option selected value="">--Select Type--</option>
                                                        @if(isset($education_qual_collection))
                                                        @if(!$education_qual_collection->isEmpty())
                                                        @foreach($education_qual_collection as $val)
                                                        <option value="{{ $val->id }}">{{
                                                            $val->type }} </option>
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
                                                        <option value="{{ $val->id }}">{{
                                                            $val->type }} </option>
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
                                    <span class="btn btn-primary">Click to Add More Education <i
                                            class="ti-plus"></i></span>
                                </div>
                            </div>



                            <div class="row" style="margin-top:10px">
                                <div class="row" style="margin-top:30px">
                                    <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                                        <button class="btn btn-primary" name="back" value="Back"
                                            id="submit">Back</button>
                                    </div>
                                    <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                                        <button class="btn btn-primary" name="proceed" value="Proceed"
                                            id="submit">Submit</button>
                                    </div>
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

@endsection
