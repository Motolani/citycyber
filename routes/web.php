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

use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\RoleController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/attendance', function () {
    return view('auth.attendance');
});
//attendance routes
Route::post('/attendance', 'ViewControllers\Attendance@attendance')->name('attendance');
Route::get('/viewAttendance', 'ViewControllers\MainOperation@manageAttendance')->name('viewAttendance');


Route::post('/homeTest', 'HomeController@homeTest')->name('homeTest');



/* create incidence */
Route::get('/createincidence', 'IncidenceController@viewCreateIncidence')->name('incidence.create');
Route::post('/storeincidence', 'IncidenceController@storeIncidence')->name('incidence.store');
Route::get('/incidence', 'IncidenceController@viewIncidence')->name('incidence.index');

/* salary advance */
Route::get('/createadvance', 'ViewControllers\MainOperation@viewCreateAdvance')->name('advance.create');
Route::post('/storeadvance', 'ViewControllers\MainOperation@storeAdvance')->name('advance.store');
Route::get('/advance', 'ViewControllers\MainOperation@viewSalaryAdvances')->name('advance.index');

/* bonus */
Route::get('/createbonus', 'BonusController@viewCreateBonus')->name('bonus.create');
Route::post('/storebonus', 'BonusController@storeBonus')->name('bonus.store');
Route::get('/bonus', 'BonusController@viewBonusAdvances')->name('bonus.index');


/* allowance */
Route::get('/createallowance', 'ViewControllers\MainOperation@viewCreateAllowance')->name('allowance.create');
Route::post('/storeallowance', 'ViewControllers\MainOperation@storeAllowance')->name('allowance.store');
Route::get('/allowances', 'ViewControllers\MainOperation@viewAllowance')->name('allowance.index');



Route::prefix('reason')->group(function () {
    Route::get('/', 'ReasonController@index')->name('reason.index');
    Route::get('/delete/{id}', 'ReasonController@delete')->name('reason.delete');
    Route::post('/create', 'ReasonController@createNewReason')->name('reason.createNewReason');
});



//stockModule Route Start
//crud for staff Unit starts
Route::prefix('stock')->group(function () {
    Route::post('/new-stock-regular', 'Inventories@createNewStockRegular')->name('stock.newStockRegular');
});

Route::prefix('stock-categories')->group(function () {
    Route::get('/', 'StockCategoriesController@index')->name('stock-category.index');
    Route::post('/create', 'StockCategoriesController@create')->name('stock-category.create');
    Route::get('/delete/{id}', 'StockCategoriesController@delete')->name('stock-category.delete');
});

// New route for loan
Route::get('/viewCreateStaffLoanList', 'ViewControllers\MainOperation@viewCreateStaffLoanList')->name('view.staff.createloanlist');
Route::get('/viewCreateStaffLoan', 'ViewControllers\MainOperation@viewCreateStaffLoan')->name('view.staff.createloan');
Route::post('postCreateStaffLoan', 'ViewControllers\MainOperation@postCreateStaffLoans');

// New route for Deductions
Route::get('/createstaffdeduction', 'DeductionController@createstaffdeductionpage')->name('create.staff.deduction');
Route::post('createstaffdeduction', 'DeductionController@createStaffDeduction');
Route::get('/allstaffdeduction', 'DeductionController@viewstaffdeduction')->name('createstaff.deduction.view');

Route::get('/createStockView', 'Inventories@CreateinventoryView')->name('createStockView');
Route::get('/createStock', 'Inventories@createStock')->name('createStock');
Route::get('/viewStock', 'Inventories@viewStock')->name('viewStock');
Route::get('/assignProductToOffice', 'Inventories@assignProductToOfficeView')->name('assignProductToOffice');
Route::get('/assignProduct/ToOffice', 'Inventories@assignProductToOffice')->name('assignProduct.ToOffice');
Route::get('/viewTransafer', 'Inventories@viewTransafer')->name('viewTransafer.ToOffice');
Route::post('/approveDisapproveStock', 'Inventories@approveDisapproveStock')->name('approveDisapproveStock');
//viewTransafer
//stockModule Route End

//assignProduct
Route::get('/createOffice', 'ViewControllers\MainViewController@createOfficeRequest')->name('createOffice');
Route::get('/viewOffices', 'OfficeController@getAllOffice')->name('viewOffices');
Route::get('/viewRegions', 'OfficeController@getRegion')->name('viewRegions');
Route::get('/viewAreas', 'OfficeController@getArea')->name('viewAreas');
Route::get('/viewHubOne', 'OfficeController@getHubOne')->name('viewHubOne');
Route::get('/viewHubTwo', 'OfficeController@getHubTwo')->name('viewHubtwo');
//Route::get('/viewBranches', 'OfficeController@getBranches')->name('viewBranches');
Route::get('/createOfficeForm','OfficeController@getOffice');
Route::post('/createOffice', 'OfficeController@createOfficeRequest')->name('createOffice');
Route::get('/getLevel', 'ViewControllers\MainViewController@getLevel')->name('getLevel');
// OFFICE INDEX
Route::get('/viewBranches', 'OfficeController@index')->name('viewBranches');



Route::get('/view-branch','BranchController@BranchIndex')->name('BranchIndex');
Route::get('/create-branch','BranchController@createBranch');
Route::post('/store-branch','BranchController@storeBranch')->name('storeBranch');
Route::get('/edit-branch/{id}','BranchController@editBranch')->name('editBranch');
Route::post('/update-branch/{id}','BranchController@updateBranch')->name('updateBrnch');
Route::post('/delete-branch','BranchController@deleteBranch')->name('deleteBranch');

Route::get('/viewStructural-standard-requirement','StructuralStandardRequirementController@StructuralStandardIndex')->name('structuralRequirements');
Route::get('/createStructural-standard-requirement','StructuralStandardRequirementController@createStructuralstandard');
Route::post('/store-Structuralstandard','StructuralStandardRequirementController@storeStructuralstandard')->name('storeStructuralstandard');
Route::get('/edit-structuralstandard/{id}','StructuralStandardRequirementController@editStructuralstandard')->name('editStructuralstandard');
Route::post('/update-structuralstandard','StructuralStandardRequirementController@updateStructuralstandard')->name('updateStructuralstandard');
Route::post('/delete-structuralstandard','StructuralStandardRequirementController@deleteStructuralstandard')->name('deleteStructuralstandard');
	

Route::get('/view-asset','AssetController@AssetIndex')->name('AssetIndex');
Route::get('/create-asset','AssetController@createAsset');
Route::post('/store-asset','AssetController@storeAsset')->name('storeAsset');
Route::get('/edit-asset/{id}','AssetController@editAsset')->name('editAsset');
Route::post('/update-asset/{id}','AssetController@updateAsset')->name('updateAsset');
Route::post('/delete-asset','AssetController@deleteAsset')->name('deleteAsset');


Route::get('/view-gameservice','GameServiceController@gameServiceIndex')->name('gameServiceIndex');
Route::get('/create-gameservice','GameServiceController@createGameservice');
Route::post('/store-gameservice','GameServiceController@storeGameservice')->name('storeGameservice');
Route::get('/edit-gameservive/{id}','GameServiceController@editGameservice')->name('editGameservice');
Route::post('/update-gameservice/{id}','GameServiceController@updateGameservice')->name('updateGameservice');
Route::post('/delete-gameservice','GameServiceController@deleteGameservice')->name('deleteGameservice');

Route::get('/view-sundayleave','SundayLeaveController@sundayLeave')->name('sundayLeave');
Route::get('/create-sundayleave','SundayLeaveController@createSundayleave')->name('createSundayleave');
Route::post('/store-sundayleave','SundayLeaveController@storeSundayleave')->name('storeSundayleave');
Route::get('/edit-sundayleave/{id}','SundayLeaveController@editSundayleave')->name('editSundayleave');
Route::post('/update-sundayleave/{id}','SundayLeaveController@updateSundayleave')->name('updateSundayleave');
Route::post('/delete-sundayleave','SundayLeaveController@deleteSundayleave')->name('deleteSundayleave');
Route::post('/submit','SundayLeaveController@sumbitSundayleave')->name('sumbitSundayleave');
/*Route::get('officeInfo', function () {
    return view('admin.offices.officeInfo');
});
Route::get('/department', '')->name('department');
Route::get('/staffstatus', function(){
return view('admin.staff.data.viewStatus');
})->name('staffstatus');
*/


//Office Routes
Route::prefix('office')->group(function () {
    Route::get('/{officeid}/stocks', 'OfficeController@viewStocks')->name('office.viewStocks');
    Route::get('/stock/accept/{id}', 'OfficeController@acceptStock')->name('office.acceptStock');
    Route::post('/stock/reject/{id}', 'OfficeController@rejectStock')->name('office.rejectStock');

    Route::get('/{officeid}/photos/add', 'PhotoController@viewAddPhotos')->name('viewAddPhotos');
    Route::post('/{officeid}/photos/add', 'PhotoController@doAddPhotos')->name('doAddPhotos');
    Route::get('/create-store/{officeid}', 'OfficeController@createStore')->name('office.createStore');
});


Route::get('/officeInfo', 'OfficeController@officeInfo')->name('officeInfo');
Route::post('/updateOffice', 'OfficeController@updateOffice')->name('updateOffice');

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
Route::post('/submitStaffForm', 'StaffController@submitStaffForm')->name('submitStaffForm');

Route::get('viewStaffProfile', 'StaffController@viewStaffProfile')->name('viewStaffProfile');

Route::get('/viewStaffTable', 'ViewControllers\MainViewController@viewStaffTable')->name('viewStaffTable');
// filter view table
Route::get('/filterViewTable','ViewControllers\MainViewController@applyFilters')->name('filterStaffTable');
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

Route::get('newStaff', 'StaffController@viewNewStaff');

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
Route::prefix('unit')->group(function () {
    Route::get('/createUnit', 'UnitController@createUnit')->name('createUnit');
    Route::post('/createUnit', 'UnitController@createUnit')->name('createUnit');
    Route::get('/viewUnit', 'UnitController@viewUnit')->name('viewUnit');
    Route::get('editUnit/{id}', 'UnitController@viewEditUnit')->name('unit.edit');
    Route::post('updateUnit', 'UnitController@updateUnit')->name('unit.doEdit');
    Route::get('deleteUnit/{id}', 'UnitController@deleteUnit')->name('unit.delete');
});
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



//Offence Crud
Route::get('/createOffence', 'ViewControllers\MainViewController@createOffence')->name('createOffence');
Route::post('/createOffence', 'ViewControllers\MainViewController@createOffence')->name('createOffence');
Route::get('/viewOffence', 'ViewControllers\MainViewController@viewOffence')->name('viewOffence');
Route::post('updateAndDeleteOffence', 'ViewControllers\MainViewController@updateAndDeleteOffence');


//Allowance crud
Route::post('createallowance', 'AllowanceController@create')->name('createallowance');
Route::get('/allallowances', 'AllowanceController@index')->name('allallowances');
Route::get('/allowance', 'AllowanceController@allowance')->name('allowance');
Route::get('/deleteallowance/{id}', 'AllowanceController@destroy');
Route::get('/showallowance/{id}', 'AllowanceController@show');
Route::post('updateallowance/{id}', 'AllowanceController@update');

//bonus crud
Route::get('/allbonuses', 'BonusController@index');
Route::post('createbonus', 'BonusController@create');
Route::get('/newbonus', 'BonusController@bonuspage');
Route::get('/deletebonus/{id}', 'BonusController@destroy');
Route::get('/showbonus/{id}', 'BonusController@show');
Route::post('updatebonus/{id}', 'BonusController@update');

Route::get('/alldeduction', 'DeductionController@index')->name('staff.deduction.view');
Route::post('creatededuction', 'DeductionController@create');
Route::get('/newdeduction', 'DeductionController@deductionpage')->name('new.staff.deduction');
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
Route::get('/viewCreateIncidence', 'IncidenceController@viewCreateIncidence');
Route::post('/viewCreateIncidence', 'IncidenceController@viewCreateIncidence');


Route::prefix('incident')->group(function () {
    Route::get('/pending', 'IncidenceController@viewPendingIncidence')->name('viewPendingIncident');
    Route::get('/approve/{id}', 'IncidenceController@approve')->name('approvePendingIncident');
    Route::get('/deny/{id}', 'IncidenceController@deny')->name('denyPendingIncident');
    Route::post('/bulk-action', 'IncidenceController@bulkAction')->name('bulkPendingIncident');
});
//end view Incidence

//Pending Advance Routes
Route::prefix('advance')->group(function () {
    Route::get('/pending', 'AdvanceController@viewPendingIncidence')->name('viewPendingAdvance');
    Route::get('/approve/{id}', 'AdvanceController@approve')->name('approvePendingAdvance');
    Route::get('/deny/{id}', 'AdvanceController@deny')->name('denyPendingAdvance');
    Route::post('/bulk-action', 'AdvanceController@bulkAction')->name('bulkPendingAdvance');
});

//Pending Bonus Routes
Route::prefix('bonus')->group(function () {
    Route::get('/pending', 'BonusController@viewPendingIncidence');
    Route::get('/approve/{id}', 'BonusController@approve');
    Route::get('/deny/{id}', 'BonusController@deny');
    Route::post('/bulk-action', 'BonusController@bulkAction');
});


//Pending Allowance Routes
Route::prefix('allowance')->group(function () {
    Route::get('/pending', 'AllowanceController@viewPendingIncidence');
    Route::get('/approve/{id}', 'AllowanceController@approve');
    Route::get('/deny/{id}', 'AllowanceController@deny');
    Route::post('/bulk-action', 'AllowanceController@bulkAction');
});


//Pending Deduction Routes
Route::prefix('deduction')->group(function () {
    Route::get('/pending', 'DeductionController@viewPendingIncidence');
    Route::get('/approve/{id}', 'DeductionController@approve');
    Route::get('/deny/{id}', 'DeductionController@deny');
    Route::post('/bulk-action', 'DeductionController@bulkAction');
});

//Pending Loan Routes
Route::prefix('loan')->group(function () {
    Route::get('/pending', 'LoanController@viewPendingIncidence');
    Route::get('/approve/{id}', 'LoanController@approve');
    Route::get('/deny/{id}', 'LoanController@deny');
    Route::post('/bulk-action', 'LoanController@bulkAction');
});

//Pending Suspension Routes
Route::prefix('suspension')->group(function () {
    Route::get('/pending', 'SuspensionController@viewPendingIncidence');
    Route::get('/approve/{id}', 'SuspensionController@approve');
    Route::get('/deny/{id}', 'SuspensionController@deny');
    Route::post('/bulk-action', 'SuspensionController@bulkAction');
    Route::get('/create', 'SuspensionController@viewCreateSuspension');
    Route::post('/create', 'SuspensionController@storeSuspension');
    Route::get('/view', 'SuspensionController@viewSuspensions');
});

//Balance Sheet
/* Route::prefix('balance-sheet')->group(function () {
    Route::get('/view', 'BalanceSheetController@viewBalanceSheet')->name('view.balanceSheet');
    Route::get('/details/advances', 'BalanceSheetController@viewBalanceSheetDetail')->name('view.balanceSheet.detail.advance');
    Route::get('/detail/wins', 'BalanceSheetController@viewBalanceSheetDetailWins')->name('view.balanceSheet.detail.win');
    Route::get('/detail/bonuses', 'BalanceSheetController@viewBalanceSheetDetailBonuses')->name('view.balanceSheet.detail.bonus');
    Route::get('/detail/deductions', 'BalanceSheetController@viewBalanceSheetDetailDeductions')->name('view.balanceSheet.detail.deduction');
}); */


//Pending Loss/Damage Routes
Route::prefix('loss-damage')->group(function () {
    Route::get('/staff/view', 'LossDamageController@staffViewDamages')->name('staff.damages');
    Route::post('/create-damages', 'LossDamageController@createStaffDamages')->name('create.staff.damages');
    Route::get('/pending', 'LossDamageController@viewPendingIncidence');
    Route::get('/approve/{id}', 'LossDamageController@approve');
    Route::get('/deny/{id}', 'LossDamageController@deny');
    Route::post('/bulk-action', 'LossDamageController@bulkAction');
});

Route::prefix('otherLoan')->group(function () {
    Route::get('/create', 'LossDamageController@viewOtherLoans');
    Route::post('/create', 'LossDamageController@storeOtherLoan');
    Route::get('/view', 'LossDamageController@viewlossdamage');

});

Route::get('/viewCreateBonus', 'BonusController@viewCreateBonus');
Route::post('/viewCreateBonus', 'BonusController@viewCreateBonus');

//Petty Cash Routes
Route::prefix('pettycash')->group(function () {
    Route::get('/deny/{id}', 'PettyCashController@deny');
    Route::get('/create', 'PettyCashController@viewCreate');
    Route::get('/categories', 'PettyCashController@viewCategories')->name('pettycash.viewCategories'); //new routes
    Route::post('/categories/add', 'PettyCashController@doAddCategory')->name('pettycash.doAddCategory'); //new routes
    Route::get('/categories/delete/{id}/', 'PettyCashController@doDeleteCategory')->name('pettycash.doDeleteCategory'); // new routes
    Route::get('/approve/{id}', 'PettyCashController@approve');
    Route::post('/create', 'PettyCashController@create')->name("createPettyCash");
    Route::get('/my-requests', 'PettyCashController@myRequests')->name("myRequests");
    Route::get('/pending', 'PettyCashController@viewPending')->name("viewPendingPettyCash");
    Route::post('/bulk-action', 'PettyCashController@bulkAction')->name('bulkActionPettyCash');
    Route::post('/submit-expense', 'PettyCashController@submitExpense')->name("submitExpense");
    Route::get('/accept-receipt/{id}', 'PettyCashController@acceptReceipt')->name("pettycash.acceptReceipt");
    Route::post('/reject-receipt/{id}', 'PettyCashController@rejectReceipt')->name("pettycash.rejectReceipt");
    Route::get('/submit-expense/{id}', 'PettyCashController@viewSubmitExpense')->name("viewSubmitExpense");
    Route::get('/submitted-receipts', 'PettyCashController@viewSubmittedReceipts')->name("pettycash.viewSubmittedReceipts");
    Route::get('/delete-petty-cash/{id}','PettyCashController@doDeleteRequest')->name("pettycash.doDeleteRequest");

    /* retirement stage */
    Route::get('/retire/create', 'PettyCashController@retireForm')->name('createRetire');
    Route::post('/store', 'PettyCashController@storeRetireForm')->name('storeRetire');
    Route::get('/retire/view', 'PettyCashController@viewRetiredPettyCash')->name('viewRetired');

    Route::get('retire-petty-cash/{id}', 'PettyCashController@retirePettyCash')->name('retirePettyCash');
});


//Cash Advance Routes
Route::prefix('cash-advance')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CashAdvanceController@viewCategories')->name('cash-advance.viewCategories');
        Route::post('/add', 'CashAdvanceController@doAddCategory')->name('cash-advance.doAddCategory');
        Route::get('/add', 'CashAdvanceController@viewAddCategory')->name('cash-advance.viewAddCategory');
	Route::get('/delete/{id}/', 'CashAdvanceController@doDeleteCategory')->name('cash-advance.doDeleteCategory');
	 Route::get('/delete-cash-request/{id}/', 'CashAdvanceController@doDeleteRequest')->name('cash-advance.doDeleteRequest');
    });
Route::get('/retire-cash-request/{id}/', 'CashAdvanceController@retireForm')->name('cash-advance.retire');
        Route::post('/store', 'CashAdvanceController@retirementStore')->name('cash-advance-retire.store');

    Route::post('/create', 'CashAdvanceController@create')->name('cash-advance.create');
    Route::get('/deny/{id}', 'CashAdvanceController@deny')->name('cash-advance.deny');
    Route::get('/create', 'CashAdvanceController@viewCreate')->name('cash-advance.viewCreate');
    Route::get('/approve/{id}', 'CashAdvanceController@approve')->name('cash-advance.approve');
    Route::get('/pending', 'CashAdvanceController@viewPending')->name("cash-advance.viewPending");
    Route::get('/my-requests', 'CashAdvanceController@myRequests')->name("cash-advance.myRequests");
    Route::post('/submit-expense', 'CashAdvanceController@submitExpense')->name("cash-advance.submitExpense");
    Route::post('/bulk-action', 'CashAdvanceController@bulkAction')->name('cash-advance.bulkActionPettyCash');
    Route::get('/submit-expense/{id}', 'CashAdvanceController@viewSubmitExpense')->name("cash-advance.viewSubmitExpense");
});


//Address Routes
Route::prefix('address')->group(function () {
    Route::get('/get-cities-by-state/{stateid}', 'AddressController@getCitiesByState')->name('getCitesByState');
    Route::get('/get-states-by-country/{countryid}', 'AddressController@getStatesByCountry')->name('getStatesByCountry');
});


//Set As Default
Route::prefix('photo')->group(function () {
    Route::get('/delete/{photoid}', 'PhotoController@delete')->name('photo.delete');
    Route::get('/set-as-default/{photoid}', 'PhotoController@setAsDefault')->name('setAsDefault');
});


//Shop Wallet Routes
Route::prefix('shop-wallet')->group(function () {
    /* Route::get('/{id}/cashiers', 'CashierWalletController@viewCashiers'); */
    Route::post('/fund/{id}', 'ShopWalletController@fundWallet')->name('shop.fund')->middleware('validate-amount');
    Route::get('/fund/{shopid}', 'ShopWalletController@viewFund')->name('shop.viewFund');
    Route::get('/view/{id}', 'ShopWalletController@dashboard')->name('shop-wallet.dashboard');
    Route::get('/createwallet', 'ShopWalletController@viewCreateWallet')->name('shop-wallet.viewCreateWallet');
    Route::post('/createwallet/{id}', 'ShopWalletController@createWallet')->name('createWallet');
    Route::get('/view-all', 'ShopWalletController@viewAll')->name('shop-wallet.viewAll');
    Route::get('/cash-reserves', 'ShopWalletController@viewAllCashReserves')->name('shop-wallet.viewAllCashReserves');
    Route::get('/cashiers/{officeId}', 'CashierWalletController@viewCashiers')->name('shop-wallet.cashiers');
    Route::get('/request-funds', 'ShopWalletController@showRequestFunds')->name('shop-wallet.showRequestFunds');
    Route::post('/request-funds', 'ShopWalletController@requestFunds')->name('shop-wallet.requestFunds')->middleware('validate-amount');
    Route::get('/fund-requests', 'ShopWalletController@viewFundRequests')->name('shop-wallet.viewFundRequests');
    Route::get('/slip-requests', 'ShopWalletController@viewSlipRequests')->name('shop-wallet.viewSlipRequests');
    Route::get('/approve-slip/{id}', 'ShopWalletController@approveSlipRequest')->name('shop-wallet.approveSlipRequest');
    Route::post('/disapprove-slip/{id}', 'ShopWalletController@disapproveSlipRequest')->name('shop-wallet.disapproveSlipRequest');
    Route::get('/approve-fund-request/{id}', 'ShopWalletController@approveCashierFundRequest')->name('shop-wallet.approveCashierFundRequest');
    Route::post('/disapprove-fund-request/{id}', 'ShopWalletController@disapproveCashierFundRequest')->name('shop-wallet.disapproveCashierFundRequest');
});


//Cashier Wallet Routes
Route::prefix('cashier')->group(function () {
    Route::get('/dashboard', 'CashierWalletController@dashboard')->name('cashier.dashboard');
    Route::get('/add', 'CashierWalletController@viewAdd')->name('cashier.viewAdd');
    Route::post('/add', 'CashierWalletController@createWallet')->name('cashier.create');
    Route::get('/accept/{id}', 'CashierWalletController@acceptFunds')->name('cashier.acceptFunds');
    Route::post('/reject/{id}', 'CashierWalletController@rejectFunds')->name('cashier.rejectFunds');
    Route::post('/request', 'CashierWalletController@requestFunds')->name('cashier.request')->middleware('validate-amount');
    Route::get('/callback/{cashierid}', 'CashierWalletController@callbackFunds')->name('cashier.callbackFunds');
    Route::get('/request', 'CashierWalletController@viewRequestFunds')->name('cashier.viewRequestFunds');
    Route::get('/fund-requests', 'CashierWalletController@showFundRequests')->name('cashier.showFundRequests');
    Route::get('/slip-requests', 'CashierWalletController@showSlipRequests')->name('cashier.showSlipRequests');
    Route::get('/accept-slip/{id}', 'CashierWalletController@acceptSlipRequest')->name('cashier.acceptSlipRequest');
    Route::post('/reject-slip/{id}', 'CashierWalletController@rejectSlipRequest')->name('cashier.rejectSlipRequest');
    Route::get('/fund/{cashierid}', 'CashierWalletController@viewFundCashier')->name('cashier.viewFundCashier');
    Route::post('/fund', 'CashierWalletController@fundCashier')->name('cashier.fund')->middleware('validate-amount');
});


//Cash Reserve Wallet Routes
Route::prefix('cash-reserve')->group(function () {
    Route::get('/', 'CashReserveController@dashboard')->name('cash.dashboard');
    Route::get('/add', 'CashReserveController@viewAdd')->name('cash.viewAdd');
    Route::get('/create', 'CashReserveController@viewCreate')->name('cash.viewCreate');
    Route::get('/fund-requests', 'CashReserveController@fundRequests')->name('cash.fundRequests');
    Route::post('/create', 'CashReserveController@createWallet')->name('cash.create');
    Route::post('/fund-cashier', 'CashReserveController@fundCashier')->name('cash.fund-cashier')->middleware('validate-amount');
    Route::get('/fund/{id}', 'CashReserveController@viewFundCashReserve')->name('cash.viewFundCashReserve')->middleware('validate-amount');
    Route::post('/fund', 'CashReserveController@fundCashReserve')->name('cash.fundCashReserve')->middleware('validate-amount');
    Route::post('/request', 'CashReserveController@requestFunds')->name('cash.request')->middleware('validate-amount');
    Route::get('/request', 'CashReserveController@viewRequestFunds')->name('cash.viewRequestFunds');
    Route::get('/fund/{id}', 'CashReserveController@viewFundCashReserve')->name('cash.viewFundCashReserve');
    Route::get('/callback/{id}', 'CashReserveController@callbackFunds')->name('cash.callbackFunds');
    Route::get('/slip-requests', 'CashReserveController@showSlipRequests')->name('cash.slipRequests');
    Route::get('/cashiers/{id}', 'CashierWalletController@viewCashiers')->name('cash.viewCashiers');
    Route::get('/accept-cashier-request/{id}', 'CashReserveController@acceptCashierRequest')->name('cash.acceptCashierRequest');
    Route::post('/reject-cashier-request/{id}', 'CashReserveController@rejectCashierRequest')->name('cash.rejectCashierRequest');
});


// Route::get('/viewCreateBonus', 'ViewControllers\MainViewController@viewCreateBonus');
// Route::post('/viewCreateBonus', 'ViewControllers\MainViewController@viewCreateBonus');


Route::get('/viewCreateSuspension', 'SuspensionController@viewCreateSuspension');
Route::post('/viewCreateSuspension', 'SuspensionController@viewCreateSuspension');


Route::get('/viewCreateAdvance', 'ViewControllers\MainOperation@viewCreateAdvance')->name('viewCreateAdvanceGet');
Route::post('/viewCreateAdvance', 'ViewControllers\MainOperation@viewCreateAdvance')->name('viewCreateAdvancePost');

Route::get('/viewCreateAllowance', 'ViewControllers\MainOperation@viewCreateAllowance')->name('viewCreateAllowanceGet');
Route::post('/viewCreateAllowance', 'ViewControllers\MainOperation@viewCreateAllowance')->name('viewCreateAllowancePost');


Route::get('/viewCreateDeduction', 'ViewControllers\MainOperation@viewCreateDeduction');
Route::post('/viewCreateDeduction', 'ViewControllers\MainOperation@viewCreateDeduction');


Route::get('/viewCreateLoan', 'ViewControllers\MainOperation@viewCreateLoan')->name('view.staff.loan');
Route::post('/viewCreateLoan', 'ViewControllers\MainOperation@viewCreateLoan');

Route::get('/allLeaveType', 'ViewControllers\MainViewController@viewLeave');
Route::get('createLeaveType', 'ViewControllers\MainViewController@createLeaveType');
Route::post('createLeaveType', 'ViewControllers\MainViewController@createLeaveType');
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
Route::get('viewLeaveRequest', 'ViewControllers\MainOperation@viewLeaveRequest')->name('viewLeaveRequest');
Route::get('requestLeave', 'ViewControllers\MainOperation@returnCreateLeave')->name('returnCreateLeaveGet');
Route::post('requestLeave', 'ViewControllers\MainOperation@returnCreateLeave')->name('returnCreateLeavePost');


Route::get('/sendMail', 'SendEmailController@sendMail')->name('sendMail');

//Notifications Logic
Route::get('createNotification', 'NotificationController@createNotificationForm');
Route::post('createNotification', 'NotificationController@createNotification')->name("createNotification");
Route::get('readNotif/{id}', 'NotificationController@readNotif');
Route::get('inbox', 'NotificationController@inbox')->name("inbox");



//officeInfo
Route::get('/home', 'HomeController@index')->name('home');


//crud for POS
Route::get('createposview', 'PosController@createPosForm');
Route::get('createPosFormData', 'PosController@createPosFormData')->name('createPosFormData');
Route::get('viewpos', 'PosController@viewPos');
Route::get('updateanddeletedos', 'PosController@updateAndDeletePos');



//crud for Customer
Route::get('createcustomerview', 'CustomerController@createCustomerForm');
Route::get('createCustomerFormData', 'CustomerController@createCustomerFormData')->name('createCustomerFormData');
Route::get('viewCustomer', 'CustomerController@viewCustomer');
Route::get('updateanddeletecustomer', 'CustomerController@updateAndDeleteCustomer');


//crud for Payment
Route::get('createpaymentview', 'PaymentController@createPaymentForm');
Route::get('createPaymentFormData', 'PaymentController@createPaymentFormData')->name('createPaymentFormData');
Route::get('viewPayment', 'PaymentController@viewPayment');
Route::get('updateanddeletepayment', 'PaymentController@updateAndDeletePayment');



//crud for GameFormData
Route::get('creategameview', 'GameController@createGameForm');
Route::post('gameValidation', 'GameController@gameValidation')->name("gameValidation");
Route::get('createGameFormData', 'GameController@createGameFormData')->name('createGameFormData');
Route::get('viewGame', 'GameController@viewGame');
Route::get('updateanddeletegame', 'GameController@updateAndDeleteGame');

//gameValidation

//crud for WinFormData
Route::get('createwinview', 'WinController@createWinForm');
Route::get('createWinFormData', 'WinController@createWinFormData')->name('createWinFormData');
Route::get('viewWin', 'WinController@viewWin');
Route::get('updateanddeletewin', 'WinController@updateAndDeleteWin');


//crud for Property mgt - Rent
Route::get('createRent', 'RentController@createRentForm')->name('createRent');
Route::post('storeCreateRent', 'RentController@createRent')->name("storeCreateRent");
Route::get('viewRentPayment', 'RentController@viewRentPayment')->name('viewRentPayment');
Route::get('/editRent/{id}', 'RentController@editRentForm')->name('editRent');
Route::put('/updateRent/{id}', 'RentController@updateRent')->name('updateRent');
Route::delete('deleteRent/{id}', 'RentController@deleteRent')->name('deleteRent');


Route::get('createBill', 'RentController@createBillForm')->name('createBill');
Route::post('storecreateBill', 'RentController@createBill')->name("storecreateBill");
Route::get('viewBill', 'RentController@viewBill')->name('viewBill');
Route::get('/editBill/{id}', 'RentController@editBillForm')->name('editBill');
Route::put('/updateBill/{id}', 'RentController@updateBill')->name('updateBill');
Route::delete('deleteBill/{id}', 'RentController@deleteBill')->name('deleteBill');


/* Route::get('createEnv', 'RentController@createEnvForm')->name('createEnv');
Route::post('storecreateEnv', 'RentController@createEnv')->name("storecreateEnv");
Route::get('viewEnv', 'RentController@viewEnv')->name('viewEnv');
Route::get('/editEnv/{id}', 'RentController@editEnvForm')->name('editEnv');
Route::put('/updateEnv/{id}', 'RentController@updateEnv')->name('updateEnv');
Route::delete('deleteEnv/{id}', 'RentController@deleteEnv')->name('deleteEnv'); */


/* real estate crud starts here */

Route::get('viewrealestate', 'RealestateController@index')->name('viewrealestate');
Route::get('createrealestate', 'RealestateController@create')->name('createrealestate');
Route::post('storerealestate', 'RealestateController@store')->name('storerealestate');
Route::get('editrealestate/{id}', 'RealestateController@edit')->name('editrealestate');
Route::put('updaterealestate/{id}', 'RealestateController@update')->name('updaterealestate');
Route::delete('deleterealestate/{id}', 'RealestateController@destroy')->name('deleterealestate');

/* real estate crud ends here */

/* profit and loss starts here */
Route::get('viewprofitandloss', 'ProfitLossController@profitAndLoss')->name('viewprofitandloss');
Route::post('/viewprofitandloss', 'ProfitLossController@viewProfitLoss')->name('profitLossAccount');

/* profit and loss ends here */


/* payslip starts here */

Route::get('createstaff','PayslipController@createstaffpayslip')->name('createstaff');
Route::post('staffdetails','PayslipController@savestaffData')->name('staffdetails');
Route::get('staff_payslip','PayslipController@viewpayslip')->name('staff_payslip');
Route::get('viewpayslip','PayslipController@viewallpayslip')->name('viewpayslip');
Route::get('generatepayroll','PayslipController@viewpayroll')->name('generatepayroll');
Route::delete('/deletepayslip/{id}','PayslipController@destroyPayslip')->name('deletePayslip');
Route::post('/generatepayroll', 'PayslipController@viewQueriedPayroll')->name('queryPayroll');

/* payslip ends here */


/* Balance sheet starts here */
Route::prefix('balance-sheet')->group(function () { 
    Route::get('/view', 'BalanceSheetController@viewBalanceSheet')->name('view.balanceSheet');
    Route::post('/view/query', 'BalanceSheetController@viewBalanceSheetQuery')->name('view.balanceSheetPost');
    Route::get('/view/query/detail/salaryadvances', 'BalanceSheetController@BalanceSheetQueryDetailSalaryAdvances')->name('balanceSheet.detail.salaryAdvances');
    Route::get('/view/query/detail/wins', 'BalanceSheetController@BalanceSheetQueryDetailWins')->name('balanceSheet.detail.wins');
    Route::get('/view/query/detail/bonues', 'BalanceSheetController@BalanceSheetQueryDetailBonuses')->name('balanceSheet.detail.bonues');
    Route::get('/view/query/detail/deductions', 'BalanceSheetController@BalanceSheetQueryDetailDeductions')->name('balanceSheet.detail.deductions');
    Route::get('/view/query/detail/loans', 'BalanceSheetController@BalanceSheetQueryDetailLoans')->name('balanceSheet.detail.loans');
    Route::get('/view/query/detail/cashAdvance', 'BalanceSheetController@BalanceSheetQueryDetailCashAdvance')->name('balanceSheet.detail.cashAdvance');
    Route::get('/view/query/detail/lateness', 'BalanceSheetController@BalanceSheetQueryDetailLateness')->name('balanceSheet.detail.lateness');
    Route::get('/view/query/detail/lossDamages', 'BalanceSheetController@BalanceSheetQueryDetailLossDamages')->name('balanceSheet.detail.lossDamages');
    Route::get('/view/query/detail/offences', 'BalanceSheetController@BalanceSheetQueryDetailOffences')->name('balanceSheet.detail.offences');
    Route::get('/view/query/detail/officeStocks', 'BalanceSheetController@BalanceSheetQueryDetailOfficeStocks')->name('balanceSheet.detail.officeStocks');
    Route::get('/view/query/detail/pettyCash', 'BalanceSheetController@BalanceSheetQueryDetailPettyCash')->name('balanceSheet.detail.pettyCash');
    Route::get('/view/query/detail/poolWallet', 'BalanceSheetController@BalanceSheetQueryDetailPoolWallet')->name('balanceSheet.detail.poolWallet');
    Route::get('/view/query/detail/cashierWallet', 'BalanceSheetController@BalanceSheetQueryDetailCashierWallet')->name('balanceSheet.detail.cashierWallet');
    Route::get('/view/query/detail/inventoryStore', 'BalanceSheetController@BalanceSheetQueryDetailInventoryStore')->name('balanceSheet.detail.inventoryStore');
    Route::get('/view/query/detail/shopWallet', 'BalanceSheetController@BalanceSheetQueryDetailShopWallet')->name('balanceSheet.detail.shopWallet');
    Route::get('/view/query/detail/cashReserveWallet', 'BalanceSheetController@BalanceSheetQueryDetailCashReserveWallet')->name('balanceSheet.detail.cashReserveWallet');



    Route::get('/detail/cashierWallet', 'BalanceSheetController@viewBalanceSheetDetailCashierWallet')->name('view.balanceSheet.detail.cashierWallet');
    Route::get('/detail/cashReserveWallet', 'BalanceSheetController@viewBalanceSheetDetailCashReserveWallet')->name('view.balanceSheet.detail.cashReserveWallet');
    Route::get('/detail/shopWallet', 'BalanceSheetController@viewBalanceSheetDetailShopWallet')->name('view.balanceSheet.detail.shopWallet');
    Route::get('/detail/inventoryStore', 'BalanceSheetController@viewBalanceSheetDetailInventoryStore')->name('view.balanceSheet.detail.inventoryStore');
    Route::get('/details/advances', 'BalanceSheetController@viewBalanceSheetDetailSalaryAdvances')->name('view.balanceSheet.detail.advance');
    Route::get('/detail/wins', 'BalanceSheetController@viewBalanceSheetDetailWins')->name('view.balanceSheet.detail.win');
    Route::get('/detail/bonuses', 'BalanceSheetController@viewBalanceSheetDetailBonuses')->name('view.balanceSheet.detail.bonus');
    Route::get('/detail/deductions', 'BalanceSheetController@viewBalanceSheetDetailDeductions')->name('view.balanceSheet.detail.deduction');
    Route::get('/detail/loans', 'BalanceSheetController@viewBalanceSheetDetailLoans')->name('view.balanceSheet.detail.loan');
    Route::get('/detail/cashAdvances', 'BalanceSheetController@viewBalanceSheetDetailCashAdvance')->name('view.balanceSheet.detail.cashAdvance');
    Route::get('/detail/lateness', 'BalanceSheetController@viewBalanceSheetDetailLateness')->name('view.balanceSheet.detail.lateness');
    Route::get('/detail/lossDamages', 'BalanceSheetController@viewBalanceSheetDetailLossDamages')->name('view.balanceSheet.detail.lossDamages');
    Route::get('/detail/offences', 'BalanceSheetController@viewBalanceSheetDetailOffences')->name('view.balanceSheet.detail.offences');
    Route::get('/detail/officeStocks', 'BalanceSheetController@viewBalanceSheetDetailOfficeStocks')->name('view.balanceSheet.detail.officeStocks');
    Route::get('/detail/poolWallet', 'BalanceSheetController@viewBalanceSheetDetailPoolWallet')->name('view.balanceSheet.detail.poolWallet');
    Route::get('/detail/pettyCash', 'BalanceSheetController@viewBalanceSheetDetailPettyCash')->name('view.balanceSheet.detail.pettyCash');
});

/* Balance sheet ends here */

//crud for BankAcountFormData
Route::get('createbankaccountview', 'BankController@createBankAccountForm');
Route::get('createBankAccountFormData', 'BankController@createBankAccountFormData')->name('createBankAccountFormData');
Route::get('viewBankAccount', 'BankController@viewBankAccount');
Route::get('updateanddeletebankaccount', 'BankController@updateAndDeleteBankAccount');

//createPosFormData

//Roles and Permissions
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', 'RoleController');
});


//Cashier sport wallets reports crud
Route::get('daily-cashier-wallet-balance-index','DailyCashierBalancingController@dailyCashierBalancingIndex');
Route::get('/create-daily-cashier-wallet-balance','DailyCashierBalancingController@createDailyCashierBalancing');
Route::post('/store-daily-cashier-wallet-balance','DailyCashierBalancingController@storeDailyCashierBalancing');
Route::get('/view-daily-cashier-wallet-balance/{id}','DailyCashierBalancingController@showDailyCashierBalancing');
Route::get('/delete-daily-cashier-wallet-balance/{id}','DailyCashierBalancingController@deleteDailyCashierBalancing');

//cable type crud
Route::get('cable-type-index','CableTypeController@cableTypeIndex');
Route::get('/create-cable-type','CableTypeController@createcableTypePlan');
Route::post('/store-cable-type','CableTypeController@storecableTypePlan');
Route::get('/edit-cable-type/{id}','CableTypeController@editcableTypePlan');
Route::post('/update-cable-type','CableTypeController@updatecableTypePlan')->name('updatetype');
Route::get('/delete-cable-type/{id}','CableTypeController@deletecableTypePlan')->name('deletetype');



//cable plan and amount crud
Route::get('cable-plan-index','CablePlanController@cablePlanIndex');
Route::get('/create-cable-plan','CablePlanController@createCablePlan');
Route::post('/store-cable-plan','CablePlanController@storeCablePlan');
Route::get('/edit-cable-plan/{id}','CablePlanController@editCablePlan');
Route::post('/update-cable-plan','CablePlanController@updateCablePlan')->name('updateplan');
Route::get('/delete-cable-plan/{id}','CablePlanController@deleteCablePlan')->name('deleteplan');

//cable tv route i.e cable providers ctud
Route::get('cable-index','CableProvidersController@index');
Route::get('/create-cable-providers','CableProvidersController@createCableProviders');
Route::post('/store-cable-providers','CableProvidersController@storeCableProviders');
Route::get('/edit-cable-providers/{id}','CableProvidersController@editCableProviders');
Route::post('/update-cable-providers','CableProvidersController@updateCableProviders')->name('updatecable');
Route::get('/delete-cable-providers/{id}','CableProvidersController@deleteCableProviders')->name('deletecable');


//subscription  route crud
Route::get('subscription-cable-index','CableSubscriptionController@subscriptionIndex');
Route::get('/create-cable-subscription','CableSubscriptionController@createCableSupscription');
Route::post('/store-cable-subscription','CableSubscriptionController@storeCableSubscription');
Route::get('/edit-cable-subscription/{id}','CableSubscriptionController@editCableSubscription');
Route::post('/update-cable-subscription','CableSubscriptionController@updateCableSubscription')->name('updatesubscription');
Route::get('/delete-cable-subscription/{id}','CableSubscriptionController@deleteCableSubscription')->name('deletesubscription');

//daily virtual  overage  route
Route::get('daily-virtual-overage-index','DailyOverageController@dailyVirtualOverageIndex');
  Route::get('create-daily-overage','DailyOverageController@createDailyVirtualOverage');
  Route::post('store-daily-overage','DailyOverageController@storeDailyVirtualOverage');
// Route::get('view-daily-overage/{id}','DailyOverageController@viewDailyVirtualOverage');
Route::get('/edit-daily-overage/{id}','DailyOverageController@editDailyVirtualOverage');
Route::post('/update-daily-overage/{id}','DailyOverageController@updateDailyVirtualOverage')->name('updatevirtualoverage');
Route::get('/delete-daily-overage/{id}','DailyOverageController@deleteDailyVirtualOverage')->name('deletevirtualoverage');

//game commision route
Route::get('game-commission-index','GameCommissionController@gameCommissionIndex');
 Route::get('create-game-commission','GameCommissionController@createGameCommission');
 Route::post('store-game-commission','GameCommissionController@storeGameCommission');
Route::get('view-game-commission/{id}','GameCommissionController@viewGameCommission');
Route::get('/edit-game-commission/{id}','GameCommissionController@editGameCommission');
Route::post('/update-game-commission/{id}','GameCommissionController@updateGameCommission')->name('updategamecommission');
Route::get('/delete-game-commission/{id}','GameCommissionController@deleteGameCommission')->name('deletegamecommission');
//game name
Route::get('game-name-index','GameNameController@GameNameIndex');
Route::get('/create-game-name','GameNameController@createGameName');
Route::post('/store-game-name','GameNameController@storeGameName');
Route::get('/edit-game-name/{id}','GameNameController@editGameName');
Route::post('/update-game-name/{id}','GameNameController@updateGameName')->name('updategamename');
Route::get('/delete-game-name/{id}','GameNameController@deleteGameName')->name('deletegamename');
