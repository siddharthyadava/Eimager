<?php
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\hr\HrController;
use App\Http\Controllers\Contact\ContactController;
use App\Models\Admin;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about.about');
});
Route::get('/clear-cache', function() {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    return "Cache cleared!";
});


Route::get('login', [AuthController::class, 'index'])->name('login-page');
// Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-page');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
// Route::get('dashboard', [AuthController::class, 'dashboard']); 
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// });
// Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
// Route::get('/experience', [AuthController::class, 'experience'])->name('experience-page');
Route::get('/userprofile', [AuthController::class, 'userprofile'])->name('userprofile-page');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/userprofile', [AuthController::class, 'userprofile'])->name('userprofile');
// });
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register/store', [AuthController::class, 'store']); 
Route::post('/post-login', [AuthController::class, 'login']);
Route::post('/experience/addexperience', [AuthController::class, 'addexperience']);
Route::get('/experience/allexperience', [AuthController::class, 'allexperience']);
Route::get('/user/fetchUserProfile', [AuthController::class, 'fetchUserProfile']);
Route::post('/experience/addApprovalRequest', [AuthController::class, 'addApprovalRequest']);
Route::post('/experience/deleteExperience', [AuthController::class, 'deleteExperience']);
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
// Route::get('/userprofile', [AuthController::class, 'showUserProfile'])->name('userprofile');
Route::get('/approval', [AuthController::class, 'approval'])->name('approval-page');
Route::post('/qualification/addqualification', [AuthController::class, 'addQualification']);
Route::get('/qualification/allQualification', [AuthController::class, 'allQualification']);
Route::post('/profile-update-request', [AuthController::class, 'addProfileUpdateRequest']);
Route::post('/upload-evidence-image', [AuthController::class, 'uploadProfileRequestEvidenceImage'])->name('upload.profile.image'); 


// hr-portal
Route::get('hr-registration', [HrController::class, 'registration'])->name('hr-register-page'); 
Route::post('/hr/store', [HrController::class, 'store']);
Route::get('hr-login', [HrController::class, 'index'])->name('hr-login-page');
Route::post('/hr-post-login', [HrController::class, 'login']);
Route::get('/hrdashboard', [HrController::class, 'hrdashboard'])->name('hrdashboard');
Route::post('/hrlogout', [HrController::class, 'hrlogout'])->name('hrlogout');
Route::get('/hr/approval-requests', [HrController::class, 'viewApprovalRequests'])->name('hr.approval.requests');
Route::post('/hr/update-approval-status', [HrController::class, 'updateApprovalStatus']);
Route::get('/hr/profile', [HRController::class, 'showProfile'])->name('hr.profile');
Route::get('/hr/employeeprofile', [HRController::class, 'showEmployeeProfile'])->name('hr.employeeprofile');
Route::post('/hr/employeeprofilesearch', [HRController::class, 'searchEmployeeProfile'])->name('hr.employeeprofilesearch');
Route::post('/hr/profileotprequest', [HRController::class, 'sendOtpRequest'])->name('hr.profileotprequest');
Route::post('/hr/approvalrejectionotprequest', [HRController::class, 'sendApprovalOrRejectionRequest'])->name('hr.approvalrejectionotprequest');
Route::post('/hr/approvalrejectionotpverification', [HRController::class, 'approvalRejectionOtpVerification'])->name('hr.approvalRejectionOtpVerification');
Route::get('/hr/experienceByEimagerId', [HRController::class, 'employeeExperienceByEimagerId'])->name('hr.employeeExperienceByEimagerId');
Route::post('/hr/approvalAndStatusByEmployer', [HRController::class, 'addApprovalAndStatusByEmployer'])->name('hr.addApprovalAndStatusByEmployer');
Route::post('/hr/addcomplaint', [HRController::class, 'addComplaint']);
Route::get('/hr/allComplaint', [HRController::class, 'allComplaint']);
Route::post('/hr/lastworkingdayotprequest', [HRController::class, 'sendLastWorkingDayOtpRequest']);
Route::post('/hr/lastworkingdayotpverification', [HRController::class, 'lastworkingdayOtpVerification'])->name('hr.approvalRejectionOtpVerification');
Route::post('/hr/updateLastWorkingDay', [HRController::class, 'updateLastWorkingDay']);
Route::get('/hr/usersearch', [HRController::class, 'searchUserByEimager']);
// Route::post('/hr/otprequest', [HRController::class, 'sendOtpRequest'])->name('hr.profileotprequest');
Route::post('/hr/profiledeactivateotprequest', [HRController::class, 'sendProfileDeactivateOtpRequest'])->name('hr.profiledeactivateotprequest');
Route::post('/hr/profiledeactivateverification', [HRController::class, 'profiledeactivateVerification'])->name('hr.approvalRejectionOtpVerification');
Route::post('/hr/deactivateHrProfile', [HRController::class, 'deactivateHrProfile']);
Route::post('/hr/checkpartialregistration', [HRController::class, 'checkPartialRegistration']);
Route::post('/hr/deletepartiallycreatedaccount', [HRController::class, 'deletePartiallyCreatedAccount']);

//Test Mail
Route::get('testmail', [HrController::class, 'testmailpage'])->name('test-mail-page');
Route::post('/testmail', [HRController::class, 'testmail']);



//Mail
Route::get('/send-mail', [MailController::class, 'sendMail']);

//Admin
Route::get('/insert-admin', [AdminController::class, 'insertAdmin']);
Route::get('/admin-login', [AdminController::class, 'index'])->name('admin-login');
Route::post('/admin-login', [AdminController::class, 'login']);
Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin-dashboard');
Route::get('/admin/report', [AdminController::class, 'fetchAdminReport']);
Route::get('/admin/hr_registration_by_date', [AdminController::class, 'fetchHrRegistrationByDate']);
Route::get('/admin/employee_registration_by_date', [AdminController::class, 'fetchUserRegistrationByDate']);
Route::post('/admin-logout', [AdminController::class, 'logout']); 
Route::get('/admin/approval-requests', [AdminController::class, 'viewAllApprovalRequests'])->name('admin.approval.requests'); 
Route::get('/admin/profile-update-requests', [AdminController::class, 'viewAllProfileUpdateRequests']); 
Route::post('/admin/profile-update-requests-approval', [AdminController::class, 'userProfileUpdateRequestApprovalOrRejection']);
Route::get('/admin/viewAllEmployer', [AdminController::class, 'viewAllEmployer']); 
Route::post('/admin/deactivateHrProfileByAdmin', [AdminController::class, 'deactivateHrProfileByAdmin']);
// Route::get('/admin/contacts', [AdminController::class, 'contacts']);
//  Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts')->middleware('auth');
// Route::get('/admin/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
// Route::get('/admin/contacts-data', [AdminController::class, 'contactsData'])->name('admin.contacts.data')->middleware('auth');
// Route::get('/admin/contacts', [AdminController::class, 'contacts']);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('../admin-dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');

    // this must exist
    Route::delete('/contacts/{id}', [AdminController::class, 'destroyContact'])->name('contacts.destroy');

    // optional ajax delete
    Route::post('/contacts/{id}/ajax-delete', [AdminController::class, 'ajaxDestroyContact'])->name('contacts.ajaxDestroy');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('../admin-dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');

    // this must exist
    Route::delete('/careers/{id}', [AdminController::class, 'destroyCareer'])->name('careers.destroy');

    // optional ajax delete
    Route::post('/careers/{id}/ajax-delete', [AdminController::class, 'ajaxDestroyCareer'])->name('careers.ajaxDestroy');
});



// common routes 
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit'); 
Route::post('/career/submit', [ContactController::class, 'careerstore'])->name('career.submit');
Route::post('/verify-otp', [HrController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/save-social-links', [AuthController::class, 'socialstore'])->name('sociallink.save');
Route::post('/upload-profile-image', [AuthController::class, 'uploadProfileImage'])->name('upload.profile.image'); 
Route::post('/hr/register-step1', [HRController::class, 'storeStep1'])->name('hr.register.step1');
Route::post('/hr/register-step2', [HRController::class, 'storeStep2'])->name('hr.register.step2');
Route::post('/hr/register-step3', [HRController::class, 'storeStep3'])->name('hr.register.step3');
Route::post('/verifyregister-otp', [HrController::class, 'verifyregisterOtp']); 
Route::post('/addstore', [HrController::class, 'addstore']);

Route::post('/forgot-password/send-otp', [HrController::class, 'forgotpasswordsendOtp'])->name('forgot.password.send.otp');

Route::post('/forgot-password/verify-otp', [HrController::class, 'forgotpasswordverifyOtp'])->name('forgot.password.verify.otp');

Route::get('/reset-password/{token}', [HrController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/reset-password', [HrController::class, 'resetPassword'])->name('reset.password.submit');



Route::post('/upload-profile-image-hr', [HrController::class, 'uploadProfileImageHr'])->name('upload.profile.image'); 

Route::post('/forgot-password/send-otp', [AuthController::class, 'forgotpasswordsendOtp'])->name('forgot.password.send.otp');

Route::post('/forgot-password/verify-otp', [AuthController::class, 'forgotpasswordverifyOtp'])->name('forgot.password.verify.otp'); 

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.submit');

Route::post('/user/store', [AdminController::class, 'store'])->name('user.store');
Route::post('/user/registertwo', [AuthController::class, 'storeStep2']);