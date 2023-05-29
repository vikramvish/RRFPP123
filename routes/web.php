<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

use App\Http\Controllers\SuccessController;
use App\Http\Controllers\ResponceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\lampimodelController;

use App\Http\Controllers\ourmissionController;
use App\Http\Controllers\helpSupportController;
use App\Http\Controllers\refundPolicyController;
use App\Http\Controllers\refundprocessController;
use App\Http\Controllers\paymentpageController;
use App\Http\Controllers\blogpageController;
use App\Http\Controllers\previewController;
use App\Http\Controllers\ReceipttController;
use App\Http\Controllers\dashboardController;
    
Route::get('/', function () {
    echo 'Testing';
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
Route::post('/add_dept_content/{DepartmentId}', [dashboardController::class, 'addnew']);
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

Route::get('/SSOmaping', [dashboardController::class, 'SSOmaping'])->name('SSOmaping');
Route::get('/addSSOuser', [dashboardController::class, 'newSSO']);
Route::post('store-sso', [dashboardController::class, 'SSOinsert']);
Route::get('/ssoEdit/{id}', [dashboardController::class, 'userSSOEdit']);
Route::put('/sso-Edit/{id}', [dashboardController::class, 'ssoupdate']);
});

Route::get('/department', [DepartmentController::class, 'index'])->name('department');
Route::get('/departmentedit/{DepartmentId}', [DepartmentController::class, 'edit']);
Route::put('/save-department/{DepartmentId}', [DepartmentController::class, 'savenew']);
Route::get('/deletedepartment/{DepartmentId}', [DepartmentController::class, 'delete']);
Route::get('/NewDepartment', [DepartmentController::class, 'newdept'])->name('NewDepartment');
Route::post('store-form', [DepartmentController::class, 'register']);
Route::get('/NewScheme', [DepartmentController::class, 'newscm']);
Route::post('store-form', [DepartmentController::class, 'insert']);

Route::get('/add-department', [DepartmentController::class, 'editable']);
Route::post('/add-department', [DepartmentController::class, 'addnew']);

Route::get('/department', [DepartmentController::class, 'departmentdata']);

// LOGIN/Registration/Logout ROUTES
 
Route::get('/loginsso', [LoginController::class, 'ssologin'])->name('loginsso');

Route::post('login-user', [LoginController::class, 'loginUser'])->name('login-user');

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/registration', [LoginController::class, 'registration']);
Route::get('/changePass', [LoginController::class, 'changePass']);

Route::post('/register-user', [LoginController::class, 'registerUser'])->name('register-user');

Route::get('logout', [LoginController::class, 'logout']);

//donation main website
Route::get('/website', [WebsiteController::class, 'index']);

Route::get('/paymentpage/{slug}', [paymentpageController::class, 'index']);

Route::post('/website-form', [paymentpageController::class, 'Register']);
 Route::post('/website-Annonmous', [paymentpageController::class, 'AnnonmousPreview']);
Route::post('/website-dept', [previewController::class, 'Register']);
Route::post('/website-form2', [previewController::class, 'Annonmous']);

Route::get('/preview', [previewController::class, 'index']);
Route::get('/previewAnnonmous', [previewController::class, 'anonmus']);

Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/blogpage/{DepartmentId}', [blogpageController::class, 'index']);

Route::get('/lampi', [lampimodelController::class, 'index']);

Route::get('/contactus', [ContactController::class, 'contactus']);

Route::get('/RefundPolicy', [refundPolicyController::class, 'refundpolicy']);
Route::get('/TermsCondition', [refundPolicyController::class, 'TermsCondition']);
Route::get('/PrivacyPolicy', [refundPolicyController::class, 'PrivacyPolicy']);
Route::get('/CancellationPolicy', [refundPolicyController::class, 'CancellationPolicy']);
Route::get('/ChargebackGuidelines', [refundPolicyController::class, 'ChargebackGuidelines']);
