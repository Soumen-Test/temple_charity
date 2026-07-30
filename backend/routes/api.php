<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\Organization\OrganizationController;
use App\Http\Controllers\Api\V1\Temple\TempleController;
use App\Http\Controllers\Api\V1\Project\ProjectController;
use App\Http\Controllers\Api\V1\Campaign\CampaignController;
use App\Http\Controllers\Api\V1\Donor\DonorController;
use App\Http\Controllers\Api\V1\Donation\DonationController;
use App\Http\Controllers\Api\V1\Payment\PaymentController;
use App\Http\Controllers\Api\V1\Receipt\ReceiptController;
use App\Http\Controllers\Api\V1\File\FileController;
use App\Http\Controllers\Api\V1\Expense\ExpenseController;
use App\Http\Controllers\Api\V1\Ledger\LedgerController;
use App\Http\Controllers\Api\V1\OpeningBalance\OpeningBalanceController;
use App\Http\Controllers\Api\V1\FinancialSummary\FinancialSummaryController;
use App\Http\Controllers\Api\V1\Public\WebsiteContentController;
use App\Http\Controllers\Api\V1\Public\WebsiteContentController as PublicWebsiteContentController;

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
        Route::apiResource(
            'campaigns',
            CampaignController::class
        );

        Route::apiResource(
            'donors',
            DonorController::class
        );
        Route::apiResource(
            'donations',
            DonationController::class
        );
        Route::apiResource(
            'payments',
            PaymentController::class
        );

        Route::post(
            'payments/{payment}/confirm',
            [PaymentController::class, 'confirm']
        );

        Route::apiResource(
            'payments',
            PaymentController::class
        );

        Route::apiResource(
            'receipts',
            ReceiptController::class
        )->only([
            'index',
            'show',
            'destroy',
        ]);

        Route::apiResource(
            'files',
            FileController::class
        )->only([
            'store',
            'show',
            'destroy',
        ]);

        Route::post(
            'projects/{project}/files',
            [ProjectController::class, 'uploadFile']
        );

        Route::apiResource(
            'expenses',
            ExpenseController::class
        )->only([
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ]);

        Route::post(
            'expenses/{expense}/submit',
            [ExpenseController::class, 'submit']
        );

        Route::post(
            'expenses/{expense}/approve',
            [ExpenseController::class, 'approve']
        );

        Route::post(
            'expenses/{expense}/reject',
            [ExpenseController::class, 'reject']
        );

        Route::post(
            'expenses/{expense}/files',
            [ExpenseController::class, 'uploadFile']
        );

        Route::get(
            'expenses/{expense}/files',
            [ExpenseController::class, 'files']
        );

        Route::delete(
            'expenses/{expense}/files/{file}',
            [ExpenseController::class, 'detachFile']
        );

        Route::get(
            'ledger',
            [LedgerController::class, 'index']
        );
        Route::apiResource(
            'opening-balances',
            OpeningBalanceController::class
        )->only([
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ]);

        Route::get(
            'financial-summary',
            [FinancialSummaryController::class, 'index']
        );
        Route::apiResource(
            'website-contents',
            WebsiteContentController::class
        )->only([
            'index',
            'store',
            'show',
            'update',
            'destroy',
        ]);


    });

    Route::prefix('public')->group(function () {

        Route::get(
            '/website-contents',
            [PublicWebsiteContentController::class, 'index']
        );

        Route::get(
            '/website-contents/{contentKey}',
            [PublicWebsiteContentController::class, 'show']
        );

    });
    