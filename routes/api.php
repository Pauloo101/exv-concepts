<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisaFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/userlogin', [AuthController::class , 'userLogin']);
Route::post('/userregister', [AuthController::class , 'userRegister']);
Route::post('/adminlogin', [AuthController::class, 'adminLogin']);
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/visa-type', [VisaFormController::class, 'getVisaType']);
    Route::post('/update-visa-type', [VisaFormController::class, 'updateVisaType']);
    Route::post('/save-form', [VisaFormController::class, 'saveForm']);
    Route::get('/application-form', [VisaFormController::class, 'getApplicationForm']);
    Route::post('/upload-file', [VisaFormController::class, 'uploadFile']);
});


Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('tier4-to-tier2', [AdminController::class, 'getTier4ToTier2Applicants']);
    Route::get('get-direct-work-visa', [AdminController::class, 'getDirectWorkVisaApplicants']);
    Route::get('specific-applicant', [AdminController::class, 'getSpecficApplicant']);
    Route::get('download-file', [AdminController::class, 'downloadApplicantFile']);
    Route::post('set-applicant-interview', [AdminController::class, 'setApplicantInterview']);
    Route::post('add-comment', [AdminController::class, 'addComments']);
});
