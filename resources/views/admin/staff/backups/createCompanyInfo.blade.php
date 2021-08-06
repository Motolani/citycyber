
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
                    
                    <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Staff</li>
                </ol>
            </div>
            <h4 class="page-title">Create Staff</h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    
    <div class="col-12" id = "h_div" style = "align-content:right, float:right">
        <div class="card">
            <div class="card-body" >
                <h4 class="header-title" style = "">Staff Management</h4>
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
		    <form method = "POST" action = "{{route('createOffice')}}">
			@csrf
                        <div class="row">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Staff Status 
                                </p>
                                <select id = "state" class="form-control select2" name = "state" data-toggle="select2">
                                    <option>Select</option>
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
                                <select id = "staffBranch" class="form-control select2" name = "staffBranch" data-toggle="select2">
                                    <option>Select Branch</option>
                                    <option>Isolo</option>
                                    <option>Mushin</option>
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <br/>

                        <!-- Bank Details Start -->
                        <div class="row">

                            <div class="col-lg-3 mt-3 mt-lg-0">
                                <label for="example-date" class="form-label">Select Bank</label>
                                <select id = "gender" class="form-control select2" name = "gender" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Gtbank</option>
                                    <option>Access</option>
                                </select>
                            </div> <!-- end col -->

                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Account Name</label>
                                    <input name = "accountName" required type="text" class="form-control" data-provide="accountName" id="accountName">
                                </div>
                            </div> <!-- end col -->



                            <div class="col-lg-3">
                                <div class="mb-0">
                                    <label class="form-label">Account Number</label>
                                    <input name = "accountNumber" required type="text" class="form-control" data-provide="accountNumber" id="accountNumber">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-3 mt-3 mt-lg-0">
                                <label for="example-date" class="form-label">Select Gender</label>
                                <select id = "gender" class="form-control select2" name = "gender" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <br/>


                        <!-- bankd Details Ends-->




                        <!-- staff unit and department starts -->
                        <div class="row">

                            <div class="col-lg-4 mt-4 mt-lg-0">
                                <label for="example-date" class="form-label">Staff Unit</label>
                                <select id = "gender" class="form-control select2" name = "gender" data-toggle="select2">
                                    <option>Select Staff Unit</option>
                                    <option>Regular Spot</option>
                                    <option>VIP</option>
                                </select>
                            </div> <!-- end col -->

                            <div class="col-lg-4 mt-4 mt-lg-0">
                                <label for="example-date" class="form-label">Staff Department</label>
                                <select id = "gender" class="form-control select2" name = "gender" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Branch Management</option>
                                    <option>Director's Office</option>
                                </select>
                            </div> <!-- end col -->


                            <div class="col-lg-4 mt-4 mt-lg-0">
                                <label for="example-date" class="form-label">Staff Department Role</label>
                                <select id = "gender" class="form-control select2" name = "gender" data-toggle="select2">
                                    <option>Select</option>
                                    <option>Member </option>
                                    <option>Department Head</option>
                                </select>
                            </div> <!-- end col -->


                            
                        </div>
                        <!-- staff unit and department ends -->



                        <table class="table table-hover guarantor" >
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
								<tr>
									<td>1</td>
									
									<td>
										<input placeholder="FirstName  LastName" autocomplete="off" value="" class="form-control underline" id="g_name"  type="text" name="g_name[]">
									</td>

									<td>
										<input autocomplete="off" value="" class="form-control underline" id="g_phone"  type="text" name="g_phone[]">
									</td>
									
									<td>
										<input autocomplete="off" value="" class="form-control underline" id="g_email"  type="text" name="g_email[]">
									</td>

									<td>
										<input  autocomplete="off" value="" class="form-control underline" id="g_office_address"  type="text" name="g_office_address[]">
									</td>

									<td>
										<input autocomplete="off" value="" class="form-control underline" id="g_home_address"  type="text" name="g_home_address[]">
									</td>

									<td></td>

								</tr>
							</tbody>
					   </table>
					   
						<div class="more_guarantor" style="margin-bottom: 25px">
								<span class="btn btn-primary">Click to Add More Guarantors <i class="fa fa-plus"></i></span>
						</div>






                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Resumption Date</label>
                                    <input name = "resumptionDate" required type="text" class="form-control" data-provide="phone" id="resumptionDate">
                                </div>
                            </div> <!-- end col -->


                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Assumption date</label>
                                    <input name = "assumptionDate" type="text" class="form-control" data-provide="typeahead" id="assumptionDate">
                                </div>
                            </div> <!-- end col -->

                            <div class="col-lg-4">
                                <div class="mb-0">
                                    <label class="form-label">Termination Date</label>
                                    <input name = "terminationDate" type="text" class="form-control" data-provide="typeahead" id="terminationDate">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-lg-6 mt-3 mt-lg-0">
                                <p class="mb-1 fw-bold text-muted"></p>
                                <p class="text-muted font-14">
                                    Staff Level 
                                </p>
                                <select id = "state" class="form-control select2" name = "state" data-toggle="select2">
                                    <option>Select Staff Level</option>
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
                                <select id = "staffBranch" class="form-control select2" name = "staffBranch" data-toggle="select2">
                                    <option>select Staff Resumption Type</option>
                                    <option>Isolo</option>
                                    <option>Mushin</option>
                                </select>
                            </div> <!-- end col -->
                        </div>

                        <div class="row" style="margin-top:10px">


                            <div class="col-lg-6">
                                <div class="mb-0">

                                </div>
                            </div> <!-- end col -->


                            <div style="justify-content:flex-end" class="col-lg-6 pull-right">
                                <button class="btn btn-primary" style="float: right;" id="submit">Next</button>
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
		$('div.more_guarantor').click(function(e)
		{
			//look for previous delete button and remove
			$('table.guarantor tr:last').find('td:last').html("");
			
			//clone business
			var last_tr=$('table.guarantor tr:last').clone();
			//implement changes and clear all data
			last_tr.find(':text').val('');
			first_td_data=last_tr.find('td:first').html();
			first_td_data++;
			last_tr.find('td:first').html(first_td_data);
			last_tr.find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");
			$('table.guarantor tr:last').after(last_tr);
			
		});




        //delete rows in tables #guarantor,work and education tables
		$('form').on('click','.remove_tr',function(e)
			{
			   var whr = $(this).closest('table').attr('class');
			   if(whr.indexOf("guarantor") !== -1)
				{
					var to="guarantor";
				}else if (whr.indexOf("work_experience") !== -1)
				{
					var to="work_experience";
				}else if (whr.indexOf("education") !== -1)
				{
					var to="education";
				}
					
										
					$(this).closest('tr').slideUp(500).remove();
					
					if($('table.'+to+' tbody tr').length!=1)
					{
					//After deleting, add delete button on remaining tr
					$('table.'+to+' tr:last').find('td:last').html("<span style='cursor:pointer; display:inline !important' class='remove_tr btn btn-danger btn-xs'><i class='fa fa-trash-o'> Remove</i></span>");	
					}
				
				
			}
			);
    //  $(document).ready(function(){
    //     let aa =$('#h_div');
    //     let header = $('headerShow');
	// console.log("h_div logger ----",aa);
    //    	header.hide();
    //     aa.hide();
    //     $('#h_div_status').text('hide div successfully');
    // });
    // $(function () {
    //     $(document).ready(function(){
    //     let aa =$('#h_div');
    //     console.log("h_div logger ----",aa);
    //     aa.hide();
    //     $("#hide").click(function(){
    //         $("div").hide();
    //     });


        
    //     $("#getParents").click(function(){
    //         let header = $('headerShow');
    //         let level_id = $(this).val();
	    
	
	//     let levels = $('#level').val();
	//     let level = levels.split('|', 1)[0];
	//     let levelName = levels.split('|', 2)[1];
	//     $("#officeType").val(levelName);

    //         //let levelInput = `<input value="${levels}" type = "hidden" id = "level"> </input>`;
    //         $("#parentOfficeId").val(level);
    //         console.log("level_iddddPhil",level);
    //         getParent(level);

            

    //         //$("#kdd").html(total);
    //         //$("div").show();
    //     });
    //     });

    //     function getParent(level_id) {
    //         let url = "{{url('api/loadParent')}}";
    //     console.log('mymessage' + url);
    //     $.ajax({
    //         url: url,
    //         type: 'post',
    //         data: {level: level_id},

    //         success: function (data) {
    //             //$('#addons option:not(:first)').remove();
    //             loadParent(data);

    //             console.log("response",data);
    //         },
    //         error: function (xhr, err) {
    //             var responseTitle= $(xhr.responseText).filter('title').get(0);
    //             alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err) );
    //         }

    //     });

    //     }
    //     function loadParent(data) {
    //         console.log('thisadata',data);
	//     let aa =$('#h_div');
	//     let startcad = $('#first_card');
	  
    //     console.log("h_div loggererere ----",aa);
    //     aa.show();$('#first_cardB').hide();
	// startcad.hide();
    //         $.each(data.data, function(key, lev){
	// 	console.log("level", lev);
    //             let option = `<option value="${lev.level}|${lev.location}|${lev.type}"> ${lev.type}</option>`;
    //             $("#types").append(option);
    //         });

    //         //Change the text of the default "loading" option.
    //         $('#addons-select').removeClass('d-none').addClass('d-block')
    //         $('#addon-loader').removeClass('d-block').addClass('d-none');
    //         $('#submit').removeClass('d-none').addClass('d-block');
    //     }

    // });
 </script>

@endsection






