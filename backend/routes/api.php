<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\Organization\OrganizationController;
use App\Http\Controllers\Api\V1\Temple\TempleController;
use App\Http\Controllers\Api\V1\Project\ProjectController;



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );

    /*
    |--------------------------------------------------------------------------
    | Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {

        Route::get(
            '/me',
            [AuthController::class, 'me']
        );

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        );
    });
});


/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
*/

    Route::prefix('v1')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::apiResource(
            'organizations',
            OrganizationController::class
        );

        Route::apiResource(
            'temples',
            TempleController::class
        );

        Route::apiResource(
            'projects',
            ProjectController::class
        );
    });
    