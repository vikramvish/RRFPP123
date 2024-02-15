<?php

use App\Http\Controllers\blogpageController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\formController;
use App\Http\Controllers\lampimodelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\paymentpageController;
use App\Http\Controllers\previewController;
use App\Http\Controllers\ReceipttController;
use App\Http\Controllers\refundPolicyController;
use App\Http\Controllers\ResponceController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'RAJASTHAN RELIEF FUND PAYMENT PORTAL';
});

Route::get('/Responce', [ResponceController::class, 'index']);

Route::get('/Receiptt', [ReceipttController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    // Route::group(['middleware' => 'auth.check'], function () {

    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    Route::get('/addSchDept', [dashboardController::class, 'addSchDept']);
    Route::get('/add_new_scheme', [dashboardController::class, 'newscheme']);
    Route::post('store-form', [dashboardController::class, 'insert']);
    Route::get('/add_new_dept', [dashboardController::class, 'newdepartment']);
    Route::get('/add_dept_content', [dashboardController::class, 'deptcontent']);
    // Route::post('/add_dept_content/{DepartmentId}', [dashboardController::class, 'addnew']);
    Route::post('/adddept', [dashboardController::class, 'register']);

    Route::get('/updateDepartment/{DepartmentId}', [dashboardController::class, 'edit']);
    Route::post('/update-department/{DepartmentId}', [dashboardController::class, 'savenew']);
    Route::get('/deletedepartment/{DepartmentId}', [dashboardController::class, 'delete']);

    Route::get('/DeptEdit/{DepartmentId}', [dashboardController::class, 'deptedit']);
    Route::put('/Dept-Edit/{DepartmentId}', [dashboardController::class, 'deptupdate']);
    Route::get('/deletedept/{DepartmentId}', [dashboardController::class, 'deletedept']);

    Route::get('/status-update/{DepartmentId}', [dashboardController::class, 'IsActive']);
    Route::get('/status-update-scheme/{SchemeId}', [dashboardController::class, 'IsActiveSch']);

    Route::get('/departmentshow', [dashboardController::class, 'showdept']);
    Route::get('/schemeshow', [dashboardController::class, 'showScheme']);
    Route::get('/SchemeEdit/{SchemeId}', [dashboardController::class, 'schemeEdit']);
    Route::put('/scheme-Edit/{SchemeId}', [dashboardController::class, 'Schemeupdate']);

    Route::get('/SchConfigration', [dashboardController::class, 'SchConfigration'])->name('SchConfigration');

    Route::get('/addSch_config/{SchemeId}', [dashboardController::class, 'addschConfig']);
    Route::put('/SchConfigration-update/{SchemeId}', [dashboardController::class, 'SchConfigrationUpdate']);
// Route::get('/SchemeConfigration',[dashboardController::class, 'view']);

    Route::get('/merchantshow', [dashboardController::class, 'showmerchant']);
    Route::get('/MerchantEdit/{id}', [dashboardController::class, 'Merchantedit']);
    Route::put('/Merchant-Edit/{id}', [dashboardController::class, 'Merchantupdate']);

    Route::get('/bankdetailshow', [dashboardController::class, 'showbankdetails']);
    Route::get('/bankdetails/{id}', [dashboardController::class, 'bankdetailsedit']);
    Route::put('/bankdetails-Edit/{id}', [dashboardController::class, 'bankdetailsupdate']);

    Route::get('/refund', [dashboardController::class, 'refundlogs'])->name('refundlogs');
    Route::post('/refundInitilize', [dashboardController::class, 'refundinitilize'])->name('refundlog');
    // Route::post('/refundlog', [dashboardController::class, 'refundlog'])->name('refundlogini');
    Route::get('/refund_response', [dashboardController::class, 'refundResponse'])->name('refund.response');

    Route::get('/SSOmaping', [dashboardController::class, 'SSOmaping'])->name('SSOmaping');
    Route::get('/addSSOuser', [dashboardController::class, 'newSSO']);
    Route::post('store-sso', [dashboardController::class, 'SSOinsert']);
    Route::get('/ssoEdit/{user_id}', [dashboardController::class, 'userSSOEdit']);
    Route::put('/sso-Edit/{user_id}', [dashboardController::class, 'ssoupdate']);
    Route::get('/deptmapping/{user_id}', [dashboardController::class, 'deptmapping'])->name('deptmapping.search');
    Route::post('/deptmapping/{UserName}', [dashboardController::class, 'deptmappingUpdate'])->name('deptmapping.update');

    Route::get('/get-schemes', [dashboardController::class, 'getSchemes']);
    Route::get('/search_transaction', [dashboardController::class, 'search'])->name('search');
    Route::get('/verify', [dashboardController::class, 'search']);
    Route::get('/download_reports', [dashboardController::class, 'downloadReports'])->name('downloadReports');
    Route::get('/txn_log', [dashboardController::class, 'txnlogs'])->name('txnlog');
    Route::get('/get-report', [dashboardController::class, 'getReport']);
    Route::post('/verify', [dashboardController::class, 'submitVerifyForm'])->name('verify');
    
    Route::get('/user-details/{prn}', [dashboardController::class, 'userDetails'])->name('userDetails');
    Route::get('/Pdf_Format', [dashboardController::class, 'pdfformat']);
    // Route::fallback([dashboardController::class, 'handle404']);
    Route::fallback(function () {
        return response()->view('website.invalid_request', [], 404);
    });
});
Route::middleware('guest')->group(function () {
// LOGIN/Registration/Logout ROUTES
Route::get('/Pdf', [dashboardController::class, 'pdf']);
Route::get('/loginsso', [LoginController::class, 'ssologin'])->name('loginsso');

Route::post('login-user', [LoginController::class, 'loginUser'])->name('login-user');

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::post('/register-user', [LoginController::class, 'registerUser'])->name('register-user');

Route::get('logout', [LoginController::class, 'logout']);
});
//donation main website
Route::get('/website', [WebsiteController::class, 'index']);

Route::get('/paymentpage/{slug}', [paymentpageController::class, 'index']);

Route::post('/personal-info', [paymentpageController::class, 'Register']);
Route::post('/Annonmous-user-info', [paymentpageController::class, 'AnnonmousPreview']);
Route::post('/confirm-info', [previewController::class, 'Register']);
Route::post('/confirm-annonmus', [previewController::class, 'Annonmous']);

Route::get('/preview', [previewController::class, 'index']);
Route::get('/previewAnnonmous', [previewController::class, 'anonmus']);

Route::get('/blog/{DepartmentId}', [blogpageController::class, 'index']);

Route::fallback(function () {
    return response()->view('website.invalid_request', [], 404);
});
Route::fallback(function () {
    return response()->view('website.dublicatePRN_error', [], 404);
});
Route::fallback(function () {
    return response()->view('website.invalid_page', [], 404);
});

Route::get('/lampi', [lampimodelController::class, 'index']);

Route::get('/contactus', [ContactController::class, 'contactus']);

Route::get('/RefundPolicy', [refundPolicyController::class, 'refundpolicy']);
Route::get('/TermsCondition', [refundPolicyController::class, 'TermsCondition']);
Route::get('/PrivacyPolicy', [refundPolicyController::class, 'PrivacyPolicy']);
Route::get('/CancellationPolicy', [refundPolicyController::class, 'CancellationPolicy']);
Route::get('/ChargebackGuidelines', [refundPolicyController::class, 'ChargebackGuidelines']);

Route::get('/form',[formController::class, 'index']);
Route::post('/form-store',[formController::class, 'store']);