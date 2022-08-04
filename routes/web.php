<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EligableControlle;
use App\Http\Controllers\AnswerKeyController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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





 Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('about-us');
Route::get('/contact-us', [FrontController::class, 'contactUs'])->name('contact-us');

Route::get('/results', [FrontController::class, 'results'])->name('results');



/////////////////ELIGIBILITY ROUTE////////////
Route::get('/application-lists',[EligableControlle::class,'applicationList'])->name('applications-lists');
Route::get('/application-status/{id}',[EligableControlle::class,'applicationStatus'])->name('application-status');

Route::post('/check-eligibility-status',[EligableControlle::class,'checkEligibilityStatus'])->name('check-eligibility-status');


///////// frontend project route///////////////////
Route::get('/all-project', [ProjectController::class, 'index'])->name('all-project');
Route::get('/project-detail/{id}', [ProjectController::class, 'projectDetail'])->name('project-detail');



/////////////////frontend projecr route end /////////////////////////////////

                //download rollslip
    Route::get('/download/rollslip',[CandidateController::class,'rollnoSlip'])->name('/download/rollslip');
    Route::get('/desired/post',[CandidateController::class,'desiredPost'])->name('desired/post');
    Route::post('/download/slip',[CandidateController::class,'downloadSlip'])->name('download/slip');

    /////////////////////Answer key////////////////////////////

    Route::get('/answer-keys',[AnswerKeyController::class,'answerKey'])->name('answer-key');
    Route::get('answer-key/post/{job_id}',[AnswerKeyController::class,'jobDetailAnswer'])->name('answer-key/post');



    //////////////////RESULT //////////////////////
    Route::get('/results',[ResultController::class,'allResults'])->name('results');
    Route::get('/results-details/{id?}',[ResultController::class,'resultsDetails'])->name('results-details');
    Route::post('/check-results',[ResultController::class,'checkResults'])->name('check-results');//ajax used for this route
Auth::routes();
Route::get('/login-auth', [App\Http\Controllers\HomeController::class, 'index'])->name('login-auth');