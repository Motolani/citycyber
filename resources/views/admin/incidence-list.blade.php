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

                        <li class="breadcrumb-item active" style="display:none" id="headerShow">View/Edit Office</li>
                    </ol>
                </div>
                <h4 class="page-title">View Pending Incidents</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <p class="text-muted font-14">
                        Below are the lists of Offices available within City Cyber. Offices can also be edited
                    </p>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <!-- <li class="nav-item">
                                    <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                        Preview
                                    </a>
                                </li> -->

                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}</li>
                            </div @endif
                            <div class="tab-pane show active" id="buttons-table-preview">
                                <form method="post" action="{{ url('incident/deny') }}" style="display: none">
                                    @csrf
                                    <input type="text" name="rejectid" id="rejectid">
                                    <input type="text" name="rejectcomment" id="rejectcomment">
                                    <button name="submit" id="rejectbtn" value="edit" class="btn btn-primary btn-sm"><span
                                            class="uil-eye"></span></button>
                                </form>
                                <table id="datatable-buttons"
                                    class="table data-table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="all" /></th>
                                            <th>Date Created</th>
                                            <th>Staff Name</th>
                                            <th>Offence</th>
                                            <th>Comment</th>
                                            <th>Amount</th>
                                            <th>Branch</th>
                                            <th>Hub</th>
                                            <th>Area</th>
                                            <th>Region</th>
                                            <th>Raised By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <form action="{{ route('bulkPendingIncident') }}" method="POST" id="form">
                                        @csrf
                                        {{ csrf_field() }}
                                        <input type="hidden" name="action" value="" id="bulkActionField" />
                                        <input type="hidden" name="bulkActionComment" id="bulkActionComment"
                                            value="" />
                                        <tbody>
                                            @if (isset($incidents))
                                                {{-- @dd($incidents) --}}
                                                @foreach ($incidents as $incident)
                                                    {{-- @if ($incident->offence_id > 6) --}}
                                                    <tr>
                                                        <td><input type="checkbox" class="checkable" name="items[]"
                                                                value="{{ $incident->id }}" /></td>
                                                        <td>{{ $incident->created_at }}</td>
                                                        <td>
                                                            <form method="get" action="{{ url('viewStaffProfile') }}"
                                                                style="display: inline-block !important;">
                                                                @csrf
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ $incident->staff_id }}">
                                                                <input type="hidden" name="description"
                                                                    value="{{ $incident->staff_id }}">
                                                                <button
                                                                    class="btn btn-link">{{ !isset($incident->staff) ? '' : $incident->staff->firstname . ' ' . $incident->staff->lastname }}</button>
                                                            </form>

                                                        </td>
                                                        <td>{{ $incident->offence }}</td>
                                                        <td>
                                                            @if (!isset($incident->comment))
                                                                <mark style="color:orange">no comment</mark>
                                                            @else
                                                                {{ $incident->comment }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $incident->amount }}</td>
                                                        <td>{{ $incident->c1_name }}</td>
                                                        <td>
                                                            @if (in_array($incident->p1_level, [4, 5]) ||
                                                                in_array($incident->p2_level, [4, 5]) ||
                                                                in_array($incident->p3_level, [4, 5]) ||
                                                                in_array($incident->p4_level, [4, 5]))
                                                                @php
                                                                    if (in_array($incident->p1_level, [4, 5])) {
                                                                        echo $incident->p1_name;
                                                                    } elseif (in_array($incident->p2_level, [4, 5])) {
                                                                        echo $incident->p2_name;
                                                                    } elseif (in_array($incident->p3_level, [4, 5])) {
                                                                        echo $incident->p3_name;
                                                                    } elseif (in_array($incident->p4_level, [4, 5])) {
                                                                        echo $incident->p4_name;
                                                                    }
                                                                @endphp
                                                            @else
                                                                <mark style="color:orange">no hub</mark>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($incident->p1_level == 3 || $incident->p2_level == 3 || $incident->p3_level == 3 || $incident->p4_level == 3)
                                                                @php
                                                                    if ($incident->p1_level == 3) {
                                                                        echo $incident->p1_name;
                                                                    } elseif ($incident->p2_level == 3) {
                                                                        echo $incident->p2_name;
                                                                    } elseif ($incident->p3_level == 3) {
                                                                        echo $incident->p3_name;
                                                                    } elseif ($incident->p4_level == 3) {
                                                                        echo $incident->p4_name;
                                                                    }
                                                                @endphp
                                                            @else
                                                                <mark style="color:orange">no area</mark>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($incident->p1_level == 2 || $incident->p2_level == 2 || $incident->p3_level == 2 || $incident->p4_level == 2)
                                                                @php
                                                                    if ($incident->p1_level == 2) {
                                                                        echo $incident->p1_name;
                                                                    } elseif ($incident->p2_level == 2) {
                                                                        echo $incident->p2_name;
                                                                    } elseif ($incident->p3_level == 2) {
                                                                        echo $incident->p3_name;
                                                                    } elseif ($incident->p4_level == 2) {
                                                                        echo $incident->p4_name;
                                                                    }
                                                                @endphp
                                                            @else
                                                                <mark style="color:orange">no region</mark>
                                                            @endif
                                                        </td>
                                                        <td>{{ $incident->adminfirstname . ' ' . $incident->adminlastname }}
                                                        </td>
                                                        <td><span
                                                                class="{{ $incident->status == 'pending' ? 'alert alert-primary' : '' }}"
                                                                role="alert">{{ $incident->status }}</span></td>
                                                        <td>
                                                            @if ($incident->status == 'pending')
                                                                <a href="#" onclick="friedthis1({{ $incident->id }})"
                                                                    class="btn btn-primary btn-sm accept"><span
                                                                        class="uil-check"></span></a>
                                                                <a href="#" onclick="disapprove({{ $incident->id }})"
                                                                    class="btn btn-danger btn-sm deny"><span
                                                                        class="uil-multiply"></span></a>
                                                            @endif
                                                            {{-- {{url('incident/approve', $incident->id)}} --}}
                                                        </td>

                                                        {{-- <td 
                                            <a href="{{url('officeInfo')}}"  rel="tooltip" class="btn btn-info"  data-created="{{$incident->created_at}}">
                                                <i class="uil-pen"></i>
                                            </a>

                                                        <form method="get" action="{{url('officeInfo')}}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$incident->id}}">
                                                        <input type="hidden" name="description" value="{{$incident->name}}">
                                                        <button name = "submit" value = "edit" class="btn btn-primary btn-sm"><span class="uil-eye"></span></button>
                                                </form>
                                            </td>  --}}
                                                    </tr>
                                                    {{-- @endif --}}
                                                @endforeach
                                            @endif



                                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                            <script>
                                                function friedthis1(arg) {
                                                    // alert(arg)
                                                    var route = "{{ url('incident/approve') }}/" + arg;
                                                    // alert(route)
                                                    Swal.fire({
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        icon: 'info',
                                                        title: 'Confirm',
                                                        text: 'Are you sure you want to approve this Incidence',
                                                        // footer: '<a href="">Why do I have this issue?</a>'
                                                    }).then((result) => {
                                                        /* Read more about isConfirmed, isDenied below */
                                                        if (result.isConfirmed) {
                                                            location.href = route
                                                            // Swal.fire('Saved!', '', 'success')
                                                        } else if (result.isDenied) {
                                                            Swal.fire('Changes are not saved', '', 'info')
                                                        }
                                                    })
                                                }

                                                function disapprove(arg) {
                                                    // alert(arg)
                                                    var route = "{{ url('incident/approve') }}/" + arg;
                                                    // alert(route)
                                                    Swal.fire({
                                                        showCancelButton: true,
                                                        icon: 'info',
                                                        title: 'Confirm',
                                                        text: 'State reason for disapproval',
                                                        input: 'textarea'
                                                    }).then(function(result) {
                                                        if (result.value) {
                                                            $("#rejectcomment").val(result.value)
                                                            $("#rejectid").val(arg)
                                                            $("#rejectbtn").click()
                                                        }
                                                    })
                                                }
                                            </script>
                                        </tbody>
                                    </form>
                                </table>

                                <button class="btn btn-primary btn-sm" id="bulkAccept"><span class="uil-check"></span>Accept
                                    Selected</button>
                                <button class="btn btn-danger btn-sm" id="bulkDeny"><span class="uil-multiply"></span>Deny
                                    Selected</button>

                            </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    {{-- @dd($incidents); --}}


@endsection


@section('script')
    <script>
        $(function() {
            $(document).ready(function() {
                let aa = $('#h_div');
                console.log("h_div logger ----", aa);
                aa.hide();
                $("#hide").click(function() {
                    $("div").hide();
                });

                $("#getParents").click(function() {
                    let header = $('headerShow');
                    let level_id = $(this).val();
                    //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
                    ///.$("#addons").append(levelInput);
                    console.log("level_id", level_id);
                    getParent(level_id);



                    //$("#kdd").html(total);
                    //$("div").show();
                });
            });



            function getParent(level_id) {
                let url = "{{ url('api/loadType') }}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        level: level_id
                    },

                    success: function(data) {
                        //$('#addons option:not(:first)').remove();
                        loadParent(data);

                        console.log("response", data);
                    },
                    error: function(xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });

            }

            function loadParent(data) {
                console.log('thisadata', data);
                $.each(data.product, function(key, product) {
                    let option =
                        `<option value="${product.code}|${product.price}|${product.name}"> ${product.name}/  ${product.month} Month -N ${product.price} </option>`;
                    $("#addons").append(option);
                });

                //Change the text of the default "loading" option.
                $('#addons-select').removeClass('d-none').addClass('d-block')
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#submit').removeClass('d-none').addClass('d-block');
            }

        });
    </script>

    @include('admin.includes.view-pending-scripts');
@endsection
