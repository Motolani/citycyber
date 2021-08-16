<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{url('home')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <h2 style = "color:white">CityCyber</h2>
        </span>
        <span class="logo-sm">
        <h2 style = "color:white">CC</h2>
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{('assets/images/logo-dark.png')}}" alt="" height="16">
                    </span>
        <span class="logo-sm">
                        <img src="{{('assets/images/logo_sm_dark.png')}}" alt="" height="16">
                    </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">4</span>
                    <span> Dashboards </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">{{--
                                    <li>
                                        <a href="dashboard-analytics.html">Analytics</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-crm.html">CRM</a>
                                    </li>
                                    <li>
                                        <a href="index.html">Ecommerce</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-projects.html">Projects</a>
                                    </li>--}}
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Office </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('getLevel')}}">Create Office</a>
                        </li>
                        <li>
                            <a href="{{url('viewOffices')}}">View Office</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Staff </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProjects">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('newStaff')}}">Create Staff</a>
                        </li>
                        <li>
                            <a href="{{url('viewStaffTable')}}">View Staff</a>
                        </li>


                        <li>
                            <a href="{{url('viewCreateAdvance')}}">Advance</a>
                        </li>

                        <li>
                            <a href="{{url('viewCreateAllowance')}}">Allowance</a>
                        </li>


                        <li>
                            <a href="{{url('viewLeaveRequest')}}">Request Leave/off</a>
                        </li>


                        {{--
                        <li>
                            <a href="apps-projects-details.html">Edit Staff</a>
                        </li>
                      --}}
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarRequest" aria-expanded="false" aria-controls="sidebarRequest" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Request & Approval</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarRequest">
                    <ul class="side-nav-second-level">
                        <li>

                            <a href="{{route('viewPendingIncident')}}">Pending Incidence
                                <span class="badge bg-warning float-end">{{isset($pendingIncidentCount)?$pendingIncidentCount:""}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('viewPendingAdvance')}}">Pending Advance
                                <span class="badge bg-warning float-end">{{isset($pendingAdvanceCount)?$pendingAdvanceCount:""}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/bonus/pending">Pending Bonus
                                <span class="badge bg-warning float-end">{{isset($pendingBonusCount)?$pendingBonusCount:""}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/allowance/pending"> Pending Allowance
                                <span class="badge bg-warning float-end">{{isset($pendingAllowanceCount)?$pendingAllowanceCount:""}}</span></a>
                        </li>

                        <li>
                            <a href="/deduction/pending">Pending Deduction
                                <span class="badge bg-warning float-end">{{isset($pendingDeductionCount)?$pendingDeductionCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="/loan/pending">Pending Loan
                                <span class="badge bg-warning float-end">{{isset($pendingLoanCount)?$pendingLoanCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="/suspension/pending">Pending Suspension
                                <span class="badge bg-warning">{{isset($pendingSuspensionCount)?$pendingSuspensionCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="/loss-damage/pending">Pending Loss/Damage
                                <span class="badge bg-warning float-end">{{isset($pendingLossDamageCount)?$pendingLossDamageCount:""}}</span>
                            </a>

                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMultiLevel">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
                                <span> Level Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSecondLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createLevel')}}">Create Level</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewLevel')}}">View Level</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
                                <span> Unit Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirdLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createUnit')}}">Create Unit</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewUnit')}}">View Unit</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false" aria-controls="sidebarFourthLevel">
                                <span> Allowances Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarFourthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('allallowances')}}">Manage Allowance</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarFifthLevel" aria-expanded="false" aria-controls="sidebarFifthLevel">
                                <span> Bonus Module </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarFifthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('allbonuses')}}">Manage Bonuses</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSixthLevel" aria-expanded="false" aria-controls="sidebarSixthLevel">
                                <span> Deduction Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSixthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('alldeduction')}}">Manage Deduction</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarSeventhLevel" aria-expanded="false" aria-controls="sidebarSeventhLevel">
                                <span> Lateness Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSeventhLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('alllateness')}}">Manage Lateness</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEightthLevel" aria-expanded="false" aria-controls="sidebarEightthLevel">
                                <span> Department Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEightthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('department')}}">Manage Department</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarNinethLevel" aria-expanded="false" aria-controls="sidebarNinethLevel">
                                <span> Staff Status Module </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarNinethLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('staffstatus')}}">Manage Staff Status</a>
                                    </li>
                                    {{-- <li>
                                         <a href="{{url('viewUnit')}}">View Unit</a>
                                     </li>--}}
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarTenthLevel" aria-expanded="false" aria-controls="sidebarNinethLevel">
                                <span> Resumption Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTenthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createResumption')}}">Create Resumption</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewResumption')}}">Manage Resumption</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEleventhLevel" aria-expanded="false" aria-controls="sidebarNinethLevel">
                                <span> Document Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEleventhLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createDocument')}}">Create Document</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewDocument')}}">Manage Document</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarTwelvethLevel" aria-expanded="false" aria-controls="sidebarNinethLevel">
                                <span> Role Module</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTwelvethLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createStaffRole')}}">Create Role</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewStaffRole')}}">Manage Role</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarThirteenthLevel" aria-expanded="false" aria-controls="sidebarNinethLevel">
                                <span> Offence Module </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarThirteenthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createOffence')}}">Create Offence</a>
                                    </li>
                                    <li>
                                        <a href="{{url('viewOffence')}}">Manage Offence</a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarFourteenthLevel" aria-expanded="false" aria-controls="sidebarFourteenthLevel">
                                <span> Leave Module </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarFourteenthLevel">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{url('createLeaveCategory')}}">Create Leave Category</a>
                                    </li>
                                    <li>
                                        <a href="{{url('allLeaveCategory')}}">View Leave Category</a>
                                    </li>

                                    <li>
                                        <a href="{{url('createLeaveType')}}">Create Leave Type</a>
                                    </li>
                                    <li>
                                        <a href="{{url('allLeaveType')}}">View Leave Type</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>



            <!-- <li class="side-nav-item">
                <a href="apps-file-manager.html" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> File Manager </span>
                </a>
            </li> -->

            <li class="side-nav-title side-nav-item">Inventories</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Inventories </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createStockView')}}">Create Stock</a>
                        </li>


                        <li>
                            <a href="{{url('viewStock')}}">View Stock</a>
                        </li>

                        <li>
                            <a href="{{url('assignProductToOffice')}}">Assign Stock to Office</a>
                        </li>

                        <li>
                            <a href="{{url('viewTransafer')}}">Stock Transfers</a>
                        </li>
                        
                    </ul>
                </div>
            </li>



            <!-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSixthteethLevel" aria-expanded="false" aria-controls="sidebarSixthteethLevel">
                    <span> Inventories</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSixthteethLevel">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{url('alldeduction')}}">Manage Deduction</a>
                        </li>
                        {{-- <li>
                             <a href="{{url('viewUnit')}}">View Unit</a>
                         </li>--}}
                    </ul>
                </div>
            </li> -->
            
            
            

            



            <li class="side-nav-title side-nav-item mt-1">Attendance</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarBaseUI" aria-expanded="false" aria-controls="sidebarBaseUI" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Attendance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarBaseUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('viewAttendance')}}">View Attendance</a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="ui-alerts.html">Alerts</a>--}}
{{--                        </li>--}}

                    </ul>
                </div>
            </li>

            


            


            <div class="clearfix"></div>
        </ul>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->




