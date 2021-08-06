<?php
//use App\Http\Controllers\ViewControllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/attendance', function () {
    return view('auth.attendance');
});

Route::post('/attendance', 'ViewControllers\Attendance@attendance')->name('attendance');


Route::get('/viewAttendance', 'ViewControllers\MainOperation@manageAttendance')->name('viewAttendance');


Route::post('/homeTest', 'HomeController@homeTest')->name('homeTest');


Route::get('/createOffice', 'ViewControllers\MainViewController@createOfficeRequest')->name('createOffice');


/*Route::get('/viewOffices', function () {
    return view('admin.viewOffices');
});*/
//viewOffices
//createOffice
//getLevel
Route::get('/viewOffices', 'ViewControllers\MainViewController@getAllOffice')->name('viewOffices');

Route::post('/createOffice', 'ViewControllers\MainViewController@createOfficeRequest')->name('createOffice');
Route::get('/getLevel', 'ViewControllers\MainViewController@getLevel')->name('getLevel');
/*Route::get('officeInfo', function () {
    return view('admin.offices.officeInfo');
});
Route::get('/department', '')->name('department');
Route::get('/staffstatus', function(){
return view('admin.staff.data.viewStatus');
})->name('staffstatus');
*/

Route::get('/officeInfo', 'ViewControllers\MainViewController@officeInfo')->name('officeInfo');
Route::post('/updateOffice', 'ViewControllers\MainViewController@updateOffice')->name('updateOffice');

Route::resource('department', 'DepartmentController');
Route::resource('staffstatus', 'StaffStatusController');

Route::put('/staffstatus/{id}', 'StaffStatusController@update');
Route::post('/staffstatus', 'StaffStatusController@create');
Route::get('/deletestatus/{id}', 'StaffStatusController@destroy');

Route::put('/department/{id}', 'DepartmentController@update');
Route::post('/department', 'DepartmentController@create');
Route::get('/deletedepartment/{id}', 'DepartmentController@destroy');

//create staff routes

//PostRouteStartsForStaffCreate


Route::post('/newStaff', 'ViewControllers\MainViewController@createStaffOne')->name('newStaff');
Route::post('/createstaffConpanyInfo', 'ViewControllers\MainViewController@createStaffCompanyInfo')->name('createstaffConpanyInfo');
Route::post('/createWorkAndEduction', 'ViewControllers\MainViewController@createWorkAndEduction')->name('createWorkAndEduction');
Route::post('/submitStaffForm', 'ViewControllers\MainViewController@submitStaffForm')->name('submitStaffForm');

Route::get('viewStaffProfile', 'ViewControllers\MainViewController@viewStaffProfile')->name('viewStaffProfile');

Route::get('/viewStaffTable', 'ViewControllers\MainViewController@viewStaffTable')->name('viewStaffTable');
//createWorkAndEduction
//PostRouteEndsFOrStaffCreate


//getRouteStartsForStaff
Route::get('staffProfile/{ref}', 'ViewControllers\MainViewController@viewStaffProfile');
Route::post('uploaddocs', 'ViewControllers\DocumentUploadController@uploadDocument');
/*
Route::get('viewStaffTable', function () {
    return view('admin.staff.viewStaffTable');
});
*/

//viewStaffTable


Route::get('newStaff', function () {
    return view('admin.staff.newStaff');
});
//newStaff
Route::get('createCompanyInfo', function () {
    return view('admin.staff.createCompanyInfo');
});


Route::get('eduAwork', function () {
    return view('admin.staff.createEduAndWorkExperience');
});

Route::get('createFileUpload', function () {
    return view('admin.staff.createFileUpload');
});
//getRouteEndsForStaff


//end create staff routes


//crud for staff level starts

Route::get('/createLevel', 'ViewControllers\MainViewController@createLevel')->name('createLevel');
Route::post('/createLevel', 'ViewControllers\MainViewController@createLevel')->name('createLevel');
Route::get('/viewLevel', 'ViewControllers\MainViewController@viewLevel')->name('viewLevel');
Route::post('editLevel', 'ViewControllers\MainViewController@updateLevel');
Route::post('updateLevel', 'ViewControllers\MainViewController@updateLevel')->name('updateLevel');
Route::post('deleteLevel', 'ViewControllers\MainViewController@deleteLevel');
//crud for staff level ends


//crud for staff Unit starts

Route::get('/createUnit', 'ViewControllers\MainViewController@createUnit')->name('createUnit');
Route::post('/createUnit', 'ViewControllers\MainViewController@createUnit')->name('createUnit');
Route::get('/viewUnit', 'ViewControllers\MainViewController@viewUnit')->name('viewUnit');
Route::get('editUnit/{id}', 'ViewControllers\MainViewController@editUnit');
Route::post('updateUnit', 'ViewControllers\MainViewController@updateUnit');
Route::post('deleteUnit', 'ViewControllers\MainViewController@deleteUnit');
//crud for staff Unit ends


//resumption Crud
Route::get('/createResumption', 'ViewControllers\MainViewController@createResumption')->name('createResumption');
Route::post('/createResumption', 'ViewControllers\MainViewController@createResumption')->name('createResumption');
Route::get('/viewResumption', 'ViewControllers\MainViewController@viewResumption')->name('viewResumption');
Route::post('updateAndDeleteResumption', 'ViewControllers\MainViewController@updateAndDeleteResumption');



//Document Crud
Route::get('/createDocument', 'ViewControllers\MainViewController@createDocument')->name('createDocument');
Route::post('/createDocument', 'ViewControllers\MainViewController@createDocument')->name('createDocument');
Route::get('/viewDocument', 'ViewControllers\MainViewController@viewDocument')->name('viewDocument');
Route::post('updateAndDeleteDocument', 'ViewControllers\MainViewController@updateAndDeleteDocument');




//Status Crud
Route::get('/createStatus', 'ViewControllers\MainViewController@createStatus')->name('createStatus');
Route::post('/createStatus', 'ViewControllers\MainViewController@createStatus')->name('createStatus');
Route::get('/viewStatus', 'ViewControllers\MainViewController@viewStatus')->name('viewStatus');
Route::post('updateAndDeleteStatus', 'ViewControllers\MainViewController@updateAndDeleteStatus');


//StaffRole Crud
Route::get('/createStaffRole', 'ViewControllers\MainViewController@createStaffRole')->name('createStaffRole');
Route::post('/createStaffRole', 'ViewControllers\MainViewController@createStaffRole')->name('createStaffRole');
Route::get('/viewStaffRole', 'ViewControllers\MainViewController@viewStaffRole')->name('viewStaffRole');
Route::post('updateAndDeleteStaffRole', 'ViewControllers\MainViewController@updateAndDeleteStaffRole');



//StaffOffence Crud
Route::get('/createOffence', 'ViewControllers\MainViewController@createOffence')->name('createOffence');
Route::post('/createOffence', 'ViewControllers\MainViewController@createOffence')->name('createOffence');
Route::get('/viewOffence', 'ViewControllers\MainViewController@viewOffence')->name('viewOffence');
Route::post('updateAndDeleteOffence', 'ViewControllers\MainViewController@updateAndDeleteOffence');


//staffallowance crud
Route::post('createallowance', 'AllowanceController@create')->name('createallowance');
Route::get('/allallowances', 'AllowanceController@index')->name('allallowances');
Route::get('/allowance', 'AllowanceController@allowance')->name('allowance');
Route::get('/deleteallowance/{id}', 'AllowanceController@destroy');
Route::get('/showallowance/{id}', 'AllowanceController@show');
Route::post('updateallowance/{id}', 'AllowanceController@update');
//staff bonus crud
Route::get('/allbonuses', 'BonusController@index');
Route::post('createbonus', 'BonusController@create');
Route::get('/newbonus', 'BonusController@bonuspage');
Route::get('/deletebonus/{id}', 'BonusController@destroy');
Route::get('/showbonus/{id}', 'BonusController@show');
Route::post('updatebonus/{id}', 'BonusController@update');

Route::get('/alldeduction', 'DeductionController@index');
Route::post('creatededuction', 'DeductionController@create');
Route::get('/newdeduction', 'DeductionController@deductionpage');
Route::get('/deletededuction/{id}', 'DeductionController@destroy');
Route::get('/showdeduction/{id}', 'DeductionController@show');
Route::post('updatededuction/{id}', 'DeductionController@update');

Route::get('/alllateness', 'LatenessController@index');
Route::post('createlateness', 'LatenessController@create');
Route::get('/newlateness', 'LatenessController@latenesspage');
Route::get('/deletelateness/{id}', 'LatenessController@destroy');
Route::get('/showlateness/{id}', 'LatenessController@show');
Route::post('updatelateness/{id}', 'LatenessController@update');
//createFileUpload
//createCompanyInfo


//view Incidence 
Route::get('/viewCreateIncidence', 'ViewControllers\MainViewController@viewCreateIncidence');
Route::post('/viewCreateIncidence', 'ViewControllers\MainViewController@viewCreateIncidence');


Route::prefix('incident')->group(function () {
    Route::get('/pending', 'IncidenceController@viewPendingIncidence')->name('viewPendingIncident');
    Route::get('/approve/{id}', 'IncidenceController@approve')->name('approvePendingIncident');
    Route::get('/deny/{id}', 'IncidenceController@deny')->name('denyPendingIncident');
    Route::post('/bulk-action', 'IncidenceController@bulkAction')->name('bulkPendingIncident');
});
//end view Incidence

Route::prefix('advance')->group(function () {
    Route::get('/pending', 'AdvanceController@viewPendingIncidence')->name('viewPendingAdvance');
    Route::get('/approve/{id}', 'AdvanceController@approve')->name('approvePendingAdvance');
    Route::get('/deny/{id}', 'AdvanceController@deny')->name('denyPendingAdvance');
    Route::post('/bulk-action', 'AdvanceController@bulkAction')->name('bulkPendingAdvance');
});


Route::prefix('bonus')->group(function () {
    Route::get('/pending', 'BonusController@viewPendingIncidence');
    Route::get('/approve/{id}', 'BonusController@approve');
    Route::get('/deny/{id}', 'BonusController@deny');
    Route::post('/bulk-action', 'BonusController@bulkAction');
});


Route::prefix('allowance')->group(function () {
    Route::get('/pending', 'AllowanceController@viewPendingIncidence');
    Route::get('/approve/{id}', 'AllowanceController@approve');
    Route::get('/deny/{id}', 'AllowanceController@deny');
    Route::post('/bulk-action', 'AllowanceController@bulkAction');
});


Route::prefix('deduction')->group(function () {
    Route::get('/pending', 'DeductionController@viewPendingIncidence');
    Route::get('/approve/{id}', 'DeductionController@approve');
    Route::get('/deny/{id}', 'DeductionController@deny');
    Route::post('/bulk-action', 'DeductionController@bulkAction');
});

Route::prefix('loan')->group(function () {
    Route::get('/pending', 'LoanController@viewPendingIncidence');
    Route::get('/approve/{id}', 'LoanController@approve');
    Route::get('/deny/{id}', 'LoanController@deny');
    Route::post('/bulk-action', 'LoanController@bulkAction');
});

Route::prefix('suspension')->group(function () {
    Route::get('/pending', 'SuspensionController@viewPendingIncidence');
    Route::get('/approve/{id}', 'SuspensionController@approve');
    Route::get('/deny/{id}', 'SuspensionController@deny');
    Route::post('/bulk-action', 'SuspensionController@bulkAction');
});

Route::prefix('loss-damage')->group(function () {
    Route::get('/pending', 'LossDamageController@viewPendingIncidence');
    Route::get('/approve/{id}', 'LossDamageController@approve');
    Route::get('/deny/{id}', 'LossDamageController@deny');
    Route::post('/bulk-action', 'LossDamageController@bulkAction');
});

Route::get('/viewCreateBonus', 'ViewControllers\MainViewController@viewCreateBonus');
Route::post('/viewCreateBonus', 'ViewControllers\MainViewController@viewCreateBonus');



Route::get('/viewCreateSuspension', 'ViewControllers\MainViewController@viewCreateSuspension');
Route::post('/viewCreateSuspension', 'ViewControllers\MainViewController@viewCreateSuspension');


Route::get('/viewCreateAdvance', 'ViewControllers\MainOperation@viewCreateAdvance');
Route::post('/viewCreateAdvance', 'ViewControllers\MainOperation@viewCreateAdvance');



Route::get('/viewCreateAllowance', 'ViewControllers\MainOperation@viewCreateAllowance');
Route::post('/viewCreateAllowance', 'ViewControllers\MainOperation@viewCreateAllowance');


Route::get('/viewCreateDeduction', 'ViewControllers\MainOperation@viewCreateDeduction');
Route::post('/viewCreateDeduction', 'ViewControllers\MainOperation@viewCreateDeduction');


Route::get('/viewCreateLoan', 'ViewControllers\MainOperation@viewCreateLoan');
Route::post('/viewCreateLoan', 'ViewControllers\MainOperation@viewCreateLoan');

Route::get('/allLeaveType', 'ViewControllers\MainViewController@viewLeave');
Route::get('createLeaveType', 'ViewControllers\MainViewController@createLeaveType');
Route::post('/updateDeleteLeaveType', 'ViewControllers\MainViewController@updateDeleteLeaveType');
Route::get('/deleteLeavetype/{id}', 'ViewControllers\MainViewController@deleteOffType');
/*Route::get('viewsss', function () {
    return view('admin.staff.data.viewLeave');
});*/

Route::get('/allLeaveCategory', 'ViewControllers\MainViewController@viewLeaveCategory');
Route::get('createLeaveCategory', 'ViewControllers\MainViewController@createLeaveCategory');
Route::post('createLeaveCategory', 'ViewControllers\MainViewController@updateDeleteLeaveCategory');
Route::post('/updateDeleteLeaveCategory', 'ViewControllers\MainViewController@updateDeleteLeaveCategory');
//Route::get('/deleteLeavetype/{id}', 'ViewControllers\MainViewController@deleteOffCategory');


//Route::post('createLeaveCategory', 'ViewControllers\MainViewController@updateDeleteLeaveCategory');
Route::get('viewLeaveRequest', 'ViewControllers\MainOperation@viewLeaveRequest');
Route::get('requestLeave', 'ViewControllers\MainOperation@returnCreateLeave');



//officeInfo
Route::get('/home', 'HomeController@index')->name('home');
