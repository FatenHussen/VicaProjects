<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\ContentController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\EducationController;
use App\Http\Controllers\API\ExperienceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware("auth:api");
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware("auth:api");
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->middleware("auth:api");
    
    
});

Route::middleware("auth:api")->group(function () {

    /* Routes For MessageController  "ShowMessages and delete */
    Route::get('/message',[MessageController::class, 'index']);
    Route::get('/message/{message}',[MessageController::class, 'show']);
    Route::delete('/message/{message}',[MessageController::class, 'destroy']);


    /* Routes For ProjectController */
    Route::post('projects', [ProjectController::class, 'store']);
    Route::post('projects/{project}', [ProjectController::class, 'update']);
    Route::delete('projects/{project}', [ProjectController::class, 'destroy']);

        /* Routes for MessageController */
        Route::get('/message', [MessageController::class, 'index']);
        Route::get('/message/{message}', [MessageController::class, 'show']);
        Route::delete('/message/{message}', [MessageController::class, 'destroy']);
        Route::post('/message', [MessageController::class, 'store']); // Moved inside the group
    
        /* Routes for ProjectController */
        Route::get('projects', [ProjectController::class, 'index']);
        Route::get('projects/{project}', [ProjectController::class, 'show']);
        Route::post('projects', [ProjectController::class, 'store']);
        Route::put('projects/{project}', [ProjectController::class, 'update']);
        Route::delete('projects/{project}', [ProjectController::class, 'destroy']);
    
        /* Routes for Skills */
        Route::get('/skills', [SkillController::class, 'index']);
        Route::post('/skills', [SkillController::class, 'store']);
        Route::get('/skills/{skill}', [SkillController::class, 'show']);
        Route::put('/skills/{skill}', [SkillController::class, 'update']);
        Route::delete('/skills/{skill}', [SkillController::class, 'destroy']);
    
        /* Routes for Education */
        Route::get('/education', [EducationController::class, 'index']);
        Route::post('/education', [EducationController::class, 'store']);
        Route::get('/education/{education}', [EducationController::class, 'show']);
        Route::put('/education/{education}', [EducationController::class, 'update']);
        Route::delete('/education/{education}', [EducationController::class, 'destroy']);
    
        /* Routes for Services */
        Route::get('/services', [ServiceController::class, 'index']);
        Route::post('/services', [ServiceController::class, 'store']);
        Route::get('/services/{service}', [ServiceController::class, 'show']);
        Route::put('/services/{service}', [ServiceController::class, 'update']);
        Route::delete('/services/{service}', [ServiceController::class, 'destroy']);
    
        /* Routes for Experience */
        Route::get('/experiences', [ExperienceController::class, 'index']);
        Route::post('/experiences', [ExperienceController::class, 'store']);
        Route::get('/experiences/{experience}', [ExperienceController::class, 'show']);
        Route::put('/experiences/{experience}', [ExperienceController::class, 'update']);
        Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy']);
    });


/* Route For MessageController  " StoreMessage */
Route::post('/message',[MessageController::class, 'store']);


/* Route For ProjectController  " ViewProjects */
Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{project}', [ProjectController::class, 'show']);

 
Route::post('/content', [ContentController::class, 'store'])->name('content.store');
Route::put('/content/{content}', [ContentController::class, 'update'])->name('content.update');