<?php
    $totalStaff = App\User::where('id', '>', 0)->count();
    $totalPayslip = App\Payslip::all()->count()
?>

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
    <a href="#" class="logo text-center logo-dark">
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
            @hasanyrole('GodEye|HQ-Officer')
            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{url('home')}}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">4</span>
                    <span> Dashboards </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
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
                        <!-- <li>
                            <a href="{{url('viewOffices')}}">View Office</a>
			</li> -->
			<li>
                            <a href="{{url('viewRegions')}}">View Regions</a>
			</li>
			<li>
                            <a href="{{url('viewAreas')}}">View Areas</a>
			</li>
			<li>
                            <a href="{{url('viewHubOne')}}">View Hub1</a>
			</li>
			<li>
                            <a href="{{url('viewHubTwo')}}">View Hub2</a>
                        </li>
                        <li>
                            <a href="{{url('viewBranches')}}">View Branches</a>
			</li>
			<li>
                            <a href="{{url('create-branch')}}">Create Branch Classification</a>
			</li>
			<li>
                            <a href="{{url('view-branch')}}">View Branch Classification</a>
                        </li>
			 <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#projectEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Manage Structural & Standard Requirement</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="projectEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url('createStructural-standard-requirement')}}">Create Structural & Standard Requirement</a>
                                    </li>
                                <li>
                                    <a href="{{url('viewStructural-standard-requirement')}}">View Structural & Standard Requirement</a>
                                </li>
                                </ul>
                            </div>
			</li>
			<li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#projectCommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Asset</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="projectCommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url('create-asset')}}">Create </a>
                                    </li>
                                <li>
                                    <a href="{{url('view-asset')}}">View</a>
                                </li>
                                </ul>
                            </div>
                        </li>


                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#projectHome" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span>Game Service</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="projectHome">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="{{url('create-gameservice')}}">Create</a>
                                    </li>
                                <li>
                                    <a href="{{url('view-gameservice')}}">View</a>
                                </li>
                                </ul>
                            </div>
                        </li>	
		    </ul>
			
			
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSixteenthssLevel" aria-expanded="false" aria-controls="sidebarSixteenthssLevel" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Petty Cash </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSixteenthssLevel">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('createPettyCash')}}">Request Petty Cash</a>
                        </li>
                        <li>
                            <a href="{{route('myRequests')}}">View Petty Cash Request</a>
                        </li>
                        <li>
                            <a href="{{route('pettycash.viewSubmittedReceipts')}}">Submitted Receipts</a>
                        </li>
                        <li>
                            {{-- Only Admins and Super Admins should see this--}}
                            <a href="{{route('viewPendingPettyCash')}}">Pending Petty Cash
                                <span class="badge bg-warning float-end">{{$pendingPettyCashCount ?? 0}}</span>
                            </a>
			</li>
			<li>
                            <a href="{{route('pettycash.viewCategories')}}">Categories</a>
			</li>
			<li>
                            <a href="{{route('createRetire')}}">Raise Petty-Cash Expense</a>
			</li>
			<li>
                            <a href="{{route('viewRetired')}}">View/Retire Expenses</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCashAdvance" aria-expanded="false" aria-controls="sidebarCashAdvance" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Cash Advance</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCashAdvance">
                    <ul class="side-nav-second-level">
             
                        <li>
                            <a href="{{route('cash-advance.myRequests')}}">View Cash Advance Request</a>
			</li>
                          <li>
                            <a href="{{route('cash-advance.viewCreate')}}">Request Cash Advance</a>
                        </li> 
                        
                        <li>
                            {{-- Only Admins and Super Admins should see this--}}
                            <a href="{{route('cash-advance.viewPending')}}">Pending Cash Advance
                                <span class="badge bg-warning float-end">{{$pendingCashAdvanceCount ?? 0}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('cash-advance.viewCategories')}}">Categories</a>
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
                            <a href="{{url('create-sundayleave')}}">Add Staff to Sunday Permanent Day-Off Staff List</a>
                        </li>
                        <li>
                            <a href="{{url('view-sundayleave')}}">View Staff to Sunday Permanent Day-Off Staff List</a>
                        </li> 
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
                            <a href="{{url('/bonus/pending')}}">Pending Bonus
                                <span class="badge bg-warning float-end">{{isset($pendingBonusCount)?$pendingBonusCount:""}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/allowance/pending')}}"> Pending Allowance
                                <span class="badge bg-warning float-end">{{isset($pendingAllowanceCount)?$pendingAllowanceCount:""}}</span></a>
                        </li>

                        <li>
                            <a href="{{url('/deduction/pending')}}">Pending Deduction
                                <span class="badge bg-warning float-end">{{isset($pendingDeductionCount)?$pendingDeductionCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="{{url('/loan/pending')}}">Pending Loan
                                <span class="badge bg-warning float-end">{{isset($pendingLoanCount)?$pendingLoanCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="{{url('/suspension/pending')}}">Pending Suspension
                                <span class="badge bg-warning">{{isset($pendingSuspensionCount)?$pendingSuspensionCount:""}}</span></a>
                        </li>
                        <li>
                            <a href="{{url('/loss-damage/pending')}}">Pending Loss/Damage
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
                                        <a href="{{route('createUnit')}}">Create Unit</a>
                                    </li>
                                    <li>
                                        <a href="{{route('viewUnit')}}">View Unit</a>
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

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#rolesandpermission" aria-expanded="false" aria-controls="rolesandpermission">
                                <span> Roles and Permission Module </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="rolesandpermission">
                                <ul class="side-nav-third-level">
                                    <li>
                                        <a href="{{route('roles.index')}}">Roles</a>
                                    </li>
                                    <li>
                                        <a href="{{route('permissions.index')}}">Permission</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasanyrole

      	 @hasanyrole('GodEye|HQ-Officer|Area-Officer|Branch-Officer')
        <li class="side-nav-title side-nav-item">Suspension</li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#suspension" aria-expanded="false" aria-controls="incidence" class="side-nav-link">
                <i class="uil-copy-alt"></i>
                <span> Suspension </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="suspension">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{url('suspension/create')}}">Raise Suspension</a>
                    </li>

                    <li>
                        <a href="{{url('suspension/view')}}">View Suspensions</a>
                    </li>

                </ul>
            </div>
        </li>
        @endhasanyrole

	 @hasanyrole('GodEye|HQ-Officer|Area-Officer|Branch-Officer')
        <li class="side-nav-title side-nav-item">Other Loan (Losses & Damages)</li>

        <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#otherLoan" aria-expanded="false" aria-controls="incidence" class="side-nav-link">
                <i class="uil-copy-alt"></i>
                <span> Other Loan </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="otherLoan">
                <ul class="side-nav-second-level">
                    <li>
                        <a href="{{url('otherLoan/create')}}">Initiate</a>
                    </li>

                    <li>
                        <a href="{{url('otherLoan/view')}}">View</a>
                    </li>

                </ul>
            </div>
        </li>
        @endhasanyrole    
<li class="side-nav-title side-nav-item">Other Deduction</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#deduction" aria-expanded="false" aria-controls="deduction" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Other Deduction </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="deduction">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('create.staff.deduction')}}">Issue Other Deduction</a>
                        </li>

                        <li>
                            <a href="{{route('createstaff.deduction.view')}}">View Other Deduction</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Staff Loan</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#loan" aria-expanded="false" aria-controls="deduction" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Staff Loan </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="loan">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('view.staff.createloan')}}">Create Staff Loan</a>
                        </li>

                        <li>
                            <a href="{{route('view.staff.createloanlist')}}">View Staff Loan</a>
                        </li>

                    </ul>
                </div>
            </li>	

	  @hasanyrole('GodEye|HQ-Officer|Area-Officer|Branch-Officer')
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
                            <a href="{{route('stock-category.index')}}">Stock Categories</a>
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

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#navRoles" aria-expanded="false" aria-controls="sidebarFourteenthLevel" class="side-nav-link">
                    <span> Roles/Permissons </span>
                    <span class="menu-arrow"></span>
                </a>

                <div class="collapse" id="navRoles">
                    <ul class="side-nav-third-level">
                        <li>
                            <a href="{{route('roles.create ')}}">View Roles</a>
                        </li>

                        <li>
                            <a href="{{route('createStaffRole')}}">Create Roles</a>
                        </li> 

                        <li>
                            <a href="{{route('laravelroles::permissions.index')}}">View Permissions</a>
                        </li>

                        <li>
                            <a href="{{route('laravelroles::permissions.create')}}">Create Permissions</a>
                        </li>
                        
                    </ul>
                </div>
            </li> --}}
	    @endhasanyrole


	    @hasanyrole('GodEye|HQ-Officer|Area-Officer|Branch-Officer')
            <li class="side-nav-title side-nav-item">Incidence</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#incidence" aria-expanded="false" aria-controls="incidence" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Incidence </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="incidence">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('incidence.create')}}">Raise Incidence</a>
                        </li>

                        <li>
                            <a href="{{route('incidence.index')}}">View Incidence</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Salary Advance</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#salaryadvance" aria-expanded="false" aria-controls="salaryadvance" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Salary Advance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="salaryadvance">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('advance.create')}}">Request Salary Advance</a>
                        </li>

                        <li>
                            <a href="{{route('advance.index')}}">View All Request</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Bonus</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#bonus" aria-expanded="false" aria-controls="bonus" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Bonus </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="bonus">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('bonus.create')}}">Issue/Raise Bonus</a>
                        </li>

                        <li>
                            <a href="{{route('bonus.index')}}">View All Request</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="side-nav-title side-nav-item">Allowance</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#allowance" aria-expanded="false" aria-controls="allowance" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Allowance </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="allowance">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('allowance.create')}}">Request Allowance</a>
                        </li>

                        <li>
                            <a href="{{route('allowance.index')}}">View Allowance</a>
                        </li>

                    </ul>
                </div>
            </li>
	    @endhasanyrole


            @hasanyrole('GodEye|HQ-Officer|Area-Manager|Area-Office|Branch-Officer')
            <li class="side-nav-title side-nav-item side-nav-title">Menu for Area Managers</li>
            <li class="side-nav-item">
                <a href="{{route('shop-wallet.viewAll')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> View Shop Wallets </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('shop-wallet.viewAllCashReserves')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> View Cash Reserves </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('shop-wallet/cashiers/{officeId}')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> View Cashiers </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cash.viewCreate')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Create Cash Reserve </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('cashier.create')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Create Cashier </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('shop-wallet.viewFundRequests')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Fund Requests</span>
                </a>
            </li>
            <li class="side-nav-title side-nav-item side-nav-title">Balance Sheet</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProjectss" aria-expanded="false" aria-controls="sidebarProjectss" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Balance Sheet</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProjectss">
                    <ul class="side-nav-second-level">
                       <li>
                           <a href="{{route('view.balanceSheet')}}">View Balance Sheet</a>
                       </li> 
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="{{route('shop-wallet.viewSlipRequests')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Slip Requests</span>
                </a>
            </li>

            <li>
                @if($totalStaff === $totalPayslip)
                    <a href="{{route('generatepayroll')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                        <i class="uil-briefcase"></i>
                        <span>Generate Payroll</span>
                    </a> 
                @else
                    <a href="#" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link" onclick="alert('You cannot generate payroll!')">
                        <i class="uil-briefcase"></i>
                        <span>Generate Payroll</span>
                    </a> 
                @endif
            </li>

            <li class="side-nav-title side-nav-item mt-1">Profit and loss</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#profit" aria-expanded="false" aria-controls="profit" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Profit and loss </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="profit">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('viewprofitandloss')}}">Profit and loss</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endhasanyrole

	    {{-- game comm start --}}
            <li class="side-nav-title side-nav-item">Game Commission</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#comimission" aria-expanded="false" aria-controls="comimission" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Game  </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="comimission">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('game-name-index')}}">Create Game  Name</a>
                        </li>
                        <li>
                        <a href="{{url('game-commission-index')}}">Create Game Commission</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- daily overlage start --}}
            <li class="side-nav-title side-nav-item">Virtual Overage</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#overage" aria-expanded="false" aria-controls="overage" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span>Daily Overage   </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="overage">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('daily-virtual-overage-index')}}">Daily Overage  </a>
                        </li>
                        {{-- <li>
                        <a href="{{url('game-commission-index')}}">Create Game Commission</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            


            {{--            Menu For Branch Managers--}}
            @hasanyrole('GodEye|HQ-Officer|Area-Manager|Branch-Officer|Branch-Manager')
            <li class="side-nav-title side-nav-item">Menu for Branch Managers</li>
            <li class="side-nav-item">
                <a href="{{route('cash.dashboard')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>My Cash Reserve</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('cash-reserve/cashiers/{id}')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>My Cashiers </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cash.slipRequests')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Slip Requests</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cash.viewRequestFunds')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Request Funds</span>
                </a>
            </li>
            {{-- cable model start --}}
            <li class="side-nav-title side-nav-item">Cable Tv Monitor</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Cable Television </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('cable-type-index')}}">Cable Type</a>
                            <a href="{{url('cable-plan-index')}}">Cable  plan</a>
                            <a href="{{url('cable-index')}}">Cable</a>
                        </li>

                        <li>
                            <a href="{{url('subscription-cable-index')}}">Subscription for cable TV</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasanyrole

            {{--            Menu For Cashiers--}}
            @hasanyrole('GodEye|HQ-Officer|Area-Manager|Branch-Officer|Branch-Manager|Cashier')
            <li class="side-nav-title side-nav-item">Menu for Cashier</li>
            <li class="side-nav-item">
                <a href="{{route('cashier.dashboard', Auth::user()->id)}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>My Wallet Dashboard</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cashier.viewRequestFunds')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Fund</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cashier.showFundRequests')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Fund Requests</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('cashier.showSlipRequests')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Slip Requests</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{url('daily-cashier-wallet-balance-index')}}" aria-expanded="false" aria-controls="shop-wallet" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span>Cashier Daily Balancing</span>
                </a>
            </li>
            @endhasanyrole

            @hasanyrole('GodEye|HQ-Officer|Branch-Officer|Area-Officer|Area-Manager|Branch-Manager')
            <li class="side-nav-title side-nav-item mt-1">Email</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#email" aria-expanded="false" aria-controls="email" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Email </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="email">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('sendMail')}}">Send Email</a>
                        </li>
                    </ul>
                </div>
            </li>

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
                    </ul>
                </div>
            </li>
            @endhasanyrole

            @hasanyrole('HQ-Officer|Area-Officer|Branch-Manager|Area-Manager')
            <li class="side-nav-title side-nav-item">Notification </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#notification" aria-expanded="false" aria-controls="notification" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Notification </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="notification">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('/createNotification')}}">Create Notification</a>
                        </li>


                        <li>
                            <a href="{{url('/inbox')}}">Inbox</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-title side-nav-item">Property Management</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#rent" aria-expanded="false" aria-controls="rent" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Rent / Lease</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="rent">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createRent')}}">Create Rent / Lease</a>
                        </li>
                        <li>
                            <a href="{{route('viewRentPayment')}}">Rent/Lease Payment History</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#bills" aria-expanded="false" aria-controls="bills" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Bills</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="bills">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('createBill')}}">Create Bills</a>
                        </li>
                        <li>
                            <a href="{{route('viewBill')}}">Bills Payment History</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#realestate" aria-expanded="false" aria-controls="realestate" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span>Real Estate</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="realestate">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createrealestate')}}">Create Real Estate</a>
                        </li>
                        <li>
                            <a href="{{url('viewrealestate')}}">Real Estate History</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            @endhasanyrole


            @hasanyrole('GodEye|HQ-Officer|Branch-Officer|Branch-Manager|Area-Officer|Area-Manager|Cashier')
            <li class="side-nav-title side-nav-item">Others </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages2" aria-expanded="false" aria-controls="sidebarPages2" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Bank Accounts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages2">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createbankaccountview')}}">Create Account</a>
                        </li>


                        <li>
                            <a href="{{url('viewBankAccount')}}">View/Edit Bank Account</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages3" aria-expanded="false" aria-controls="sidebarPages3" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Pos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages3">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createposview')}}">Create Pos</a>
                        </li>
                        <li>
                            <a href="{{url('viewpos')}}">View/Edit Pos</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages4" aria-expanded="false" aria-controls="sidebarPages4" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Customer </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages4">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createcustomerview')}}">Create Customer</a>
                        </li>
                        <li>
                            <a href="{{url('viewCustomer')}}">View/Edit Customer</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages5" aria-expanded="false" aria-controls="sidebarPages5" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Payments </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages5">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createpaymentview')}}">Create Payment</a>
                        </li>
                        <li>
                            <a href="{{url('viewPayment')}}">View/Edit Payments</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages6" aria-expanded="false" aria-controls="sidebarPages6" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Games </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages6">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('creategameview')}}">Create Games</a>
                        </li>
                        <li>
                            <a href="{{url('viewGame')}}">View/Edit Games</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages7" aria-expanded="false" aria-controls="sidebarPages7" class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Wins </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages7">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{url('createwinview')}}">Create Win</a>
                        </li>
                        <li>
                            <a href="{{url('viewWin')}}">View/Edit Win</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endhasanyrole 

            <div class="clearfix"></div>
        </ul>

    </div>
</div>




