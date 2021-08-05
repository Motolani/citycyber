@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')



	<div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                    <h3><span>29</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Projects</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                    <h3><span>715</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Tasks</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>31</span></h3>
                                    <p class="text-muted font-15 mb-0">Members</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                    <h3><span>93%</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                                    <p class="text-muted font-15 mb-0">Productivity</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->

        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-4">Tasks Overview</h4>

                        <div dir="ltr">
                            <div class="mt-3 chartjs-chart" style="height: 320px;">
                                <canvas id="task-area-chart" data-bgColor="#727cf5" data-borderColor="#727cf5"></canvas>
                            </div>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->




            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">Tasks</h4>

                        <p><b>107</b> Tasks completed out of 195</p>

                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Coffee detail page - Main Page</a></h5>
                                            <span class="text-muted font-13">Due in 3 days</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Status</span> <br/>
                                            <span class="badge badge-warning-lighten">In-progress</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Assigned to</span>
                                            <h5 class="font-14 mt-1 fw-normal">Logan R. Cohn</h5>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Total time spend</span>
                                            <h5 class="font-14 mt-1 fw-normal">3h 20min</h5>
                                        </td>
                                        <td class="table-action" style="width: 90px;">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Drinking bottle graphics</a></h5>
                                            <span class="text-muted font-13">Due in 27 days</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Status</span> <br/>
                                            <span class="badge badge-danger-lighten">Outdated</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Assigned to</span>
                                            <h5 class="font-14 mt-1 fw-normal">Jerry F. Powell</h5>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Total time spend</span>
                                            <h5 class="font-14 mt-1 fw-normal">12h 21min</h5>
                                        </td>
                                        <td class="table-action" style="width: 90px;">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">App design and development</a></h5>
                                            <span class="text-muted font-13">Due in 7 days</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Status</span> <br/>
                                            <span class="badge badge-success-lighten">Completed</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Assigned to</span>
                                            <h5 class="font-14 mt-1 fw-normal">Scot M. Smith</h5>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Total time spend</span>
                                            <h5 class="font-14 mt-1 fw-normal">78h 05min</h5>
                                        </td>
                                        <td class="table-action" style="width: 90px;">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">Poster illustation design</a></h5>
                                            <span class="text-muted font-13">Due in 5 days</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Status</span> <br/>
                                            <span class="badge badge-warning-lighten">In-progress</span>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Assigned to</span>
                                            <h5 class="font-14 mt-1 fw-normal">John P. Ritter</h5>
                                        </td>
                                        <td>
                                            <span class="text-muted font-13">Total time spend</span>
                                            <h5 class="font-14 mt-1 fw-normal">26h 58min</h5>
                                        </td>
                                        <td class="table-action" style="width: 90px;">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
    <!-- end row-->


@endsection

