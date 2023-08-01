<?php

// Route::get('pdfview', array('as' => 'pdfview', 'uses' => 'HomeController@pdfview'));
Route::get('/pdfview/{id}/{crypt}', 'HomeController@pdfview')->name('pdfview');
Route::get('/pdfviewbyperiod/{id}/{periode}/{year}/{crypt}', 'HomeController@pdfviewbyperiod')->name('pdfviewbyperiod');


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

use App\Http\Controllers\DelegationController;
use App\Http\Controllers\EngagementTypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TimeReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('time-report')->name('time-report.')->group(function () {
    Route::prefix('engagement-type')->name('engagement-type.')->group(function () {
        Route::get('',          [EngagementTypeController::class, 'index'])->name('index');
        Route::get('create',          [EngagementTypeController::class, 'create'])->name('create');
    });
    Route::prefix('bulk-edit')->name('bulk-edit.')->group(function () {
        Route::get('',          [TimeReportController::class, 'bulkIndex'])->name('index');
        Route::post('template',          [TimeReportController::class, 'bulkTemplateExport'])->name('templateExport');
        Route::post('',          [TimeReportController::class, 'bulkExport'])->name('export');
        Route::post('approve',          [TimeReportController::class, 'bulkApprove'])->name('bulkApprove');
        Route::post('overbduget',          [TimeReportController::class, 'bulkEditOverbudget'])->name('bulkEditOverbudget');
    });
});

Route::prefix('team')->name('team.')->group(function () {
    Route::prefix('delegations')->name('delegations.')->group(function () {
        Route::get('', [DelegationController::class, 'index'])->name('indexdelegation');
        Route::get('create', [DelegationController::class, 'create'])->name('createdelegation');
        Route::post('', [DelegationController::class, 'store'])->name('storedelegation');
        Route::delete('{id}', [DelegationController::class, 'delete'])->name('deletedelegation');
    });
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('', [GroupController::class, 'index'])->name('indexgroup');
        Route::get('create', [GroupController::class, 'create'])->name('creategroup');
        Route::post('', [GroupController::class, 'store'])->name('storegroup');
        Route::delete('{id}', [GroupController::class, 'delete'])->name('deletegroup');
    });
    Route::prefix('positions')->name('positions.')->group(function () {
        Route::get('', [PositionController::class, 'index'])->name('indexposition');
        Route::get('create', [PositionController::class, 'create'])->name('createposition');
        Route::post('', [PositionController::class, 'store'])->name('storeposition');
        Route::delete('{id}', [PositionController::class, 'delete'])->name('deleteposition');
    });
});

Route::prefix('administration')->name('administration.')->group(function () {
    Route::prefix('timereport')->name('timereport.')->group(function () {
        Route::get('clients/msid', 'AdministratorController@indexclients')->name('clientslist')->middleware('auth');
        Route::get('clients/solis', 'AdministratorController@indexclientsolis')->name('clientslistsolis')->middleware('auth');
        Route::get('addclient', 'AdministratorController@createclients')->middleware('auth');
        Route::post('insertclient', 'AdministratorController@insertclients')->middleware('auth');
        Route::get('{id}/deleteclient', 'AdministratorController@deleteclient')->middleware('auth');
        Route::get('{id}/detail', 'AdministratorController@clientdetail')->middleware('auth');
        Route::get('{id}/editclient', 'AdministratorController@editclient')->middleware('auth');
        Route::post('{id}/updateclient', 'AdministratorController@updateclient')->middleware('auth');

        Route::get('tasks', 'AdministratorController@indextasks')->name('taskslist')->middleware('auth');
        Route::get('addtask', 'AdministratorController@createtasks')->middleware('auth');
        Route::post('inserttask', 'AdministratorController@inserttasks')->middleware('auth');
        Route::get('{id}/deletetask', 'AdministratorController@deletetask')->middleware('auth');

        Route::get('divisions', 'AdministratorController@indexdivisions')->name('divisionlist')->middleware('auth');
        Route::get('adddivision', 'AdministratorController@createdivisions')->middleware('auth');
        Route::post('insertdivision', 'AdministratorController@insertdivision')->middleware('auth');
        Route::get('{id}/deletedivision', 'AdministratorController@deletedivision')->middleware('auth');
    });
});

Route::prefix('cuti')->name('cuti.')->group(function () {
    
   Route::get('home', 'TimeReportController@cuti')->name('cutihome')->middleware('auth');
   Route::get('pengajuancuti', 'TimeReportController@createleave')->name('pengajuancuti')->middleware('auth');
   Route::post('pengajuancuti/process', 'TimeReportController@requestleave')->middleware('auth');
   Route::get('home/{id}/delete', 'TimeReportController@deleterequest')->middleware('auth');
   Route::get('home/{id}/detail', 'TimeReportController@detailstatuscuti')->middleware('auth');

    Route::get('list', 'AdministratorController@leavelist')->name('leavelist')->middleware('auth');
    Route::get('list/{nip}', 'AdministratorController@leavelistnip')->middleware('auth');
    Route::get('list/delete/{id}', 'AdministratorController@destroyleave')->middleware('auth');

});

// Route::get('/time-report/bulk-edit', 'TimeReportController@indexBulk');
// Route::get('/timereport/bulk/edit/{period}', 'TimeReportController@exportEditTemplate')->name('bulkedit');

Route::post('/input/timereport', 'TimeReportController@import')->name('time-report-import')->middleware('auth');
Route::post('/approve/timereport', 'TimeReportController@import')->name('time-report-import')->middleware('auth');

Route::get('/home', 'HomeController@dashboard')->name('house')->middleware('auth');
Route::get('/reset/password', 'UserController@editpassword')->name('editpassword')->middleware('auth');
Route::post('/reset/password/process', 'UserController@updatepassword')->name('updatepassword')->middleware('auth');


Route::get('/reset/password/{nip}', 'UserController@editemployeepassword')->name('editemployeepassword');
Route::post('/reset/password/{id}/process', 'UserController@updateemployeepassword')->name('updateemployeepassword');


Route::get('/news', function () {
    return view('news');
})->name('news')->middleware('auth');

Route::get('/payslips/{year}', 'PayrollController@payslips')->name('payslips')->middleware('auth');

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/teammanagement', 'AdministratorController@teammanagementindex')->name('teammanagementindex')->middleware('auth');
Route::post('/teammanagement/move/{nip}', 'AdministratorController@teammanagementmove')->name('teammanagementmove')->middleware('auth');
Route::post('/teammanagement/changeincharge/{nip}', 'AdministratorController@teammanagementchangeincharge')->name('teammanagementchangeincharge')->middleware('auth');


Route::post('/manualinput/bulkmodify', 'AdministratorController@bulkleave')->middleware('auth');
Route::post('/manualinput/bulkmodify/plus', 'AdministratorController@bulkleavesurplus')->middleware('auth');
Route::get('/manualinput', 'AdministratorController@manualinputindex')->name('manualinputlist')->middleware('auth');
Route::post('/manualinput/modify/{id}', 'AdministratorController@manualinputmodify')->middleware('auth');
Route::get('/manualinput/checkdetail/{id}', 'AdministratorController@manualinputdetail')->name('manualinputdetail')->middleware('auth');

Route::get('/adminrequestleavelist', 'HomeController@requestleavelist')->middleware('auth');
Route::get('/adminrequestleavelist/approve/{nip}/{id}', 'HomeController@approverequestform')->middleware('auth');
Route::get('/addnote/{nip}/{id}', 'HomeController@addnote')->middleware('auth');
Route::post('/submitnote/{nip}/{id}', 'HomeController@submitnote')->middleware('auth');

Route::get('/adminrequestleavelist/decline/{nip}/{id}', 'HomeController@declinerequestform')->middleware('auth');

Route::post('/adminrequestleavelist/approved/{nip}/{id}', 'HomeController@approverequest')->middleware('auth');
Route::post('/adminrequestleavelist/declined/{nip}/{id}', 'HomeController@declinerequest')->middleware('auth');

Route::get('/detailcuti/{id}', 'HomeController@detailcuti')->middleware('auth');
Route::get('/account/{id}', 'UserController@account')->middleware('auth');
Route::get('/searchmanualinput', 'HomeController@search')->middleware('auth');


Route::get('/userlist', 'UserController@index');
Route::get('/userlist/{id}/edit', 'UserController@edit');
Route::put('/userlist/{id}', 'UserController@update');
Route::get('/userlist/{id}/delete', 'UserController@destroy');
Route::get('/input/registrasi', 'UserController@create');
Route::post('/input', array('as' => 'form', 'uses' => 'UserController@inputuser'));
Route::get('/successinput', function () {
    return view('successinput');
});
Route::get('/timereportlist', 'TimeReportController@index')->middleware('auth');

Route::get('/input', function () {
    return view('inputuser');
});
//Route::get('/laravel/storage/app/{file}', 'TimeReportController@showfile')->middleware('auth');

Route::get('/input/timereport', 'TimeReportController@create')->name('inputtimereport')->middleware('auth');

Route::get('/timereportsummary/{id}/{period}', 'TimeReportController@summary')->middleware('auth');

Route::post('/inputtimereport/process', array('as' => 'form', 'uses' => 'TimeReportController@processinputtimereport'))->middleware('auth');
Route::get('/inputtimereport/process', array('as' => 'form', 'uses' => 'TimeReportController@processinputtimereport'))->middleware('auth');
Route::post('/inserttimereport', 'TimeReportController@inputtimereport')->middleware('auth');
Route::get('/timesheets/detail/{date?}/{year?}', 'TimeReportController@timesheetdetail')->middleware('auth');
Route::get('/timesheets/main', 'TimeReportController@timesheetmain')->middleware('auth');
Route::get('/timesheets/approval/incharge/{id}', 'TimeReportController@inchargeapproval')->middleware('auth');
Route::get('/timesheets/approval/period/all/{period}', 'TimeReportController@approveAllByPeriod')->middleware('auth');
Route::get('/timesheets/approval/period/{period}/{nip}', 'TimeReportController@approveByPeriod')->middleware('auth');

Route::get('/timesheets/approval/hr/{id}', 'TimeReportController@hrapproval')->middleware('auth');
Route::get('/timesheets/approval/partner/{id}', 'TimeReportController@partnerapproval')->middleware('auth');

Route::get('/timesheets/delete/{id}', 'TimeReportController@deletetimereport')->middleware('auth');
Route::get('/timesheets/edit/{id}', 'TimeReportController@edittimereport')->middleware('auth');
Route::get('/timesheets/download', 'TimeReportController@downloadindtimereport')->middleware('auth');

//Route::get('/getimporttimereport', 'ImportController@getImport');
//Route::post('/importtimereport', 'ImportController@import')->name('importtimereport');

//Route::group(['middleware' => 'App\Http\Middleware\IsAdmin'], function () {
//});

Auth::routes();

//// Route for view/blade file.
//Route::get('importExport', 'ImportController@importExport');
//// Route for export/download tabledata to .csv, .xls or .xlsx
//Route::get('downloadExcel/{type}', 'ImportController@downloadExcel');
//// Route for import excel data to database.
//Route::post('importExcel', 'ImportController@importExcel');
//Route::get('/importExcel', 'ImportController@importExport');
////Route::post('/storeData', 'ImportController@storeData');

Route::get('import/excel', 'ImportController@importExport')->middleware('auth');
Route::post('/home/import/timereport', 'ImportController@import')->name('importtimereport')->middleware('auth');

//Route::post('/home', 'ImportController@import')->middleware('auth');
Route::get('import/client', 'ImportController@importExportClient')->middleware('auth');
Route::post('/home/import/client', 'ImportController@importClient')->name('importclient')->middleware('auth');
Route::post('/home/import/users', 'ImportController@importUsers')->name('importusers')->middleware('auth');

Route::get('/user/add', 'AdministratorController@adduserform')->name('adduserform')->middleware('auth');
Route::post('/user/add/process', 'AdministratorController@adduser')->name('adduser')->middleware('auth');
Route::get('/user/list', 'AdministratorController@listuser')->name('listuser')->middleware('auth');

//Route::get('partner/reporting/payrolldata', function () {})->middleware('auth');

Route::get('/partner/reporting/payrolldata', 'ReportsController@payrolldata')->middleware('auth');
Route::get('/partner/reporting/payrollhistory/{year}', 'ReportsController@payrollhistory')->middleware('auth');
Route::get('/partner/reporting/greenformula', 'ReportsController@greenformula')->middleware('auth');
Route::get('/partner/reporting/biodata', 'ReportsController@biodata')->middleware('auth');
Route::get('/partner/reporting/timereport', 'ReportsController@timereport')->middleware('auth');

Route::get('partner/reporting/payrollhistory/{id}/{periode}', 'HomeController@viewslipfromreport');

Route::get('/partner/reporting/timereport/detail/{id}', 'TimeReportController@reportdetail')->name('reportdetail')->middleware('auth');
Route::post('/partner/reporting/timereport/detail/{id}/{timereportid}', 'TimeReportController@editoverbudget')->name('editoverbudget')->middleware('auth');

Route::get('/partner/reporting/timereport/download/', 'ExportController@downloadtimereport')->middleware('auth');
Route::get('/partner/reporting/payrolldata/download/', 'ExportController@downloadpayrolldata')->middleware('auth');
Route::get('/partner/reporting/payrollhistory/download/', 'ExportController@downloadpayrollhistory')->middleware('auth');
Route::get('/partner/reporting/greenformula/download/', 'ExportController@downloadgreenformula')->middleware('auth');


Route::get('/partner/reporting/advanced', 'ReportsController@advancedreport')->middleware('auth');
Route::get('/partner/reporting/advanced', 'ReportsController@advancedreporting')->middleware('auth');

//Route::get('partner/reporting/advanced', function () {})->middleware('auth');
//Route::get('partner/reporting/advanced/', function () {})->middleware('auth');

Route::get('//partner/reporting/advanced/client/{clientid}', 'TimeReportController@clienttotal');

Route::get('/account/{id}/detail', 'HomeController@account');
Route::get('/reporterror', 'TimeReportController@sendreporterror');

Route::get('/home/encryptslip/{crypt}', 'HomeController@encryptslip')->name('encryptslip');
Route::get('/home/encryptslipperiod/{year}/{crypt}', 'HomeController@encryptslipperiod')->name('encryptslipperiod');



//        if () {
//            $totals =
//                ->where('periode', '=', $month)
//                ->where('kota', '=', \request('kota'))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//        } elseif (\request()->has('institusi')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', $month)
//                ->where('institusi', '=', \request('institusi'))
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//        } elseif (\request()->has('periode')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', \request('periode'))
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//        } elseif (\request()->has('institusi') && \request()->has('city') && \request()->has('periode')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', \request('periode'))
//                ->where('kota', '=', \request('kota'))
//                ->where('institusi', '=', \request('institusi'))
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//        } elseif (\request()->has('join1')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', $month)
//                ->where('kota', '=', 'batam')
//                ->where('institusi', '=', 'solis')
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//
//        } elseif (\request()->has('join2')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', $month)
//                ->where('kota', '=', 'batam')
//                ->where('institusi', '=', 'msid')
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//
//        } elseif (\request()->has('join3')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', $month)
//                ->where('kota', '=', 'jakarta')
//                ->where('institusi', '=', 'solis')
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//
//        } elseif (\request()->has('join4')) {
//            $totals = DB::table('payrollhistory')
//                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                ->where('periode', '=', $month)
//                ->where('kota', '=', 'jakarta')
//                ->where('institusi', '=', 'msid')
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//
//        } else {
//            $totals = DB::table('payrollhistory')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
//                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
//                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
//                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
//                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
////                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
////                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
////                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
//                ->get();
//            $totalitas = DB::table('payrollinput')
//                ->where('periode', '=', $month)
//                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
//                ->get();
//        }

Route::get('exportPDF', 'PayrollController@exportPDF');
Route::get('pdfview', array('as' => 'pdfview', 'uses' => 'PayrollController@pdfview'));


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
Route::get('/searchmanualpayrollhistory', 'PayrollController@searchmanualpayrollhistory');

Route::get('/payroll/run/search/', 'PayrollController@searchmanualrunpayroll');
Route::get('/searchmanualinput', 'PayrollController@searchemployee');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payrollhome', 'PayrollController@home');
Route::get('/biodatahome', 'DatabaseController@home');

Route::get('/biodata/home', 'DatabaseController@index');
Route::get('/biodata/{id}/edit', 'DatabaseController@edit');
Route::post('/biodata/{id}', 'DatabaseController@update');
Route::get('/biodata/{id}/delete', 'DatabaseController@destroybiodata');

Route::get('/payroll/data', 'PayrollController@index')->name('indexpayrolldata');
Route::get('/payroll/data/{id}/edit', 'PayrollController@edit')->name('editpayrolldata');
Route::post('/payroll/data/{id}', 'PayrollController@update');
Route::post('/payroll/data/{id}/resign', 'PayrollController@resign');
Route::post('/payroll/data/{id}/changegroup', 'PayrollController@changegroup');

Route::get('/payroll/data/{id}/delete', 'PayrollController@destroy');
Route::get('/payroll/data/{id}/increase/form', 'PayrollController@increaseform');
Route::post('/payroll/data/{id}/increase/process', 'PayrollController@increaseprocess')->name('increaseprocess');

Route::get('/delete/payrollhistory/{id}', 'PayrollController@deletepayrollhistory');

Route::get('/koreksiinput/{id}/edit', 'PayrollController@koreksiinputview');

Route::get('/payroll/run', 'PayrollController@runpayrollindex');
Route::get('/payroll/run/payrolling/{nip}/{month}/{nama}', 'PayrollController@payrolling');
Route::get('/payroll/run/payrolling/all/{period}', 'PayrollController@payrollingall');
Route::get('/payroll/run/payrolling/simulation/{period}', 'PayrollController@simulatePayrollingAll');
Route::get('/payroll/run/payrolling/delete/{id}', 'PayrollController@deletepayrollinput');

Route::post('/timereport/unlock/{id}/', 'TimeReportController@setAsUnlocked')->name('unlockTimeReport');
Route::post('/timereport/lock/{id}/', 'TimeReportController@setAsLocked')->name('lockTimeReport');

Route::get('/payroll/history', 'PayrollController@payrollhistoryindex');
//Route::get('/account/{id}/detail', 'DatabaseController@account');
Route::get('/account/delete/file/{id}/{emid}', 'DatabaseController@deletefile');

Route::get('/biodata/{id}/detail', 'DatabaseController@biodatadetail');

Route::get('/insertpayroll', 'PayrollInput@create');
Route::post('/insertpayroll/inserting', array('as' => 'form', 'uses' => 'PayrollInput@input'));

Route::get('/user/biodata/form', 'DatabaseController@create');
Route::post('/user/biodata/add', array('as' => 'form', 'uses' => 'DatabaseController@input'));
Route::get('/user/registration/form', 'PayrollController@create');
Route::post('/user/registration/add', array('as' => 'form', 'uses' => 'PayrollController@input'));

Route::get('/importemployee', 'ImportController@getImport')->name('import');
Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
Route::post('/import_process', 'ImportController@processImport')->name('import_process');

Route::get('/importbiodata', 'ImportController@getImportBiodata')->name('import');
Route::post('/import_parse_biodata', 'ImportController@parseImportBiodata')->name('import_parse_biodata');
Route::post('/import_process_biodata', 'ImportController@processImportBiodata')->name('import_process_biodata');

Route::get('/importpayrollinput', 'ImportController@getImportPayrollInput')->name('import');
Route::post('/import_parse_payrollinput', 'ImportController@parseImportPayrollInput')->name('import_parse_payrollinput');
Route::post('/import_process_payrollinput', 'ImportController@processImportPayrollInput')->name('import_process_payrollinput');

Route::get('/importusers', 'ImportController@getImportUsers')->name('import');
Route::post('/import_parse_users', 'ImportController@parseImportUsers')->name('import_parse_users');
Route::post('/import_process_users', 'ImportController@processImportUsers')->name('import_process_users');

Route::get('/koreksiinput', 'PayrollController@koreksiinput');

Route::get('/uploadfileform', 'FileController@forminsert');
Route::post('/uploadfile/process', 'FileController@process');

Route::get('file/upload/{id}', 'FileController@form')->name('file.form');
Route::get('profilepicture/upload/{id}', 'FileController@ppform');
Route::get('file/index', 'FileController@index')->name('file.index');
Route::post('file/upload/{id}/process', 'FileController@upload');
Route::put('file/update/{file}', 'FileController@update')->name('file.update');
Route::post('profilepicture/upload/{id}/process', 'FileController@uploadprofilepicture');

Route::get('downloadsummary', 'DatabaseController@downloadsummary');

Route::get('downloaddata', 'DatabaseController@downloaddata');
Route::post('importdatapayrollinput', 'DatabaseController@importdata')->name('importdatapayrollinput');
Route::post('importdataemployeepayroll', 'DatabaseController@importdataemployeepayroll')->name('importdataemployeepayroll');
Route::post('importbiodata', 'DatabaseController@importdataemployeebiodata')->name('importdataemployeebiodata');

Route::get('deletepayrollinputthismonth/{period}', 'PayrollController@deletepayrollinputthismonth')->name('deletepayrollinputthismonth');
Route::get('deletepayrollinputthismonthsmj/{period}', 'PayrollController@deletepayrollinputthismonthsmj')->name('deletepayrollinputthismonthsmj');
Route::get('deletepayrollinputthismonthmsj/{period}', 'PayrollController@deletepayrollinputthismonthmsj')->name('deletepayrollinputthismonthmsj');
Route::get('deletepayrollinputthismonthsmb/{period}', 'PayrollController@deletepayrollinputthismonthsmb')->name('deletepayrollinputthismonthsmb');
Route::get('deletepayrollinputthismonthmsb/{period}', 'PayrollController@deletepayrollinputthismonthmsb')->name('deletepayrollinputthismonthmsb');

Route::get('deletepayrollhistorythismonth/{period}', 'PayrollController@deletepayrollhistorythismonth')->name('deletepayrollhistorythismonth');
Route::get('deletepayrollhistorythismonthsmj/{period}', 'PayrollController@deletepayrollhistorythismonthsmj')->name('deletepayrollhistorythismonthsmj');
Route::get('deletepayrollhistorythismonthmsj/{period}', 'PayrollController@deletepayrollhistorythismonthmsj')->name('deletepayrollhistorythismonthmsj');
Route::get('deletepayrollhistorythismonthsmb/{period}', 'PayrollController@deletepayrollhistorythismonthsmb')->name('deletepayrollhistorythismonthsmb');
Route::get('deletepayrollhistorythismonthmsb/{period}', 'PayrollController@deletepayrollhistorythismonthmsb')->name('deletepayrollhistorythismonthmsb');
