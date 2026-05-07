<?php

use App\Http\Controllers\CostCenter\CostCenterController;
use App\Http\Controllers\Enterprise\EnterpriseController;
use \App\Http\Controllers\Financial\FinancialEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/enterprise', [EnterpriseController::class, 'store']);
Route::get('/enterprise', [EnterpriseController::class, 'index']);
Route::get('/enterprise/{id}', [EnterpriseController::class, 'show']);
Route::put('/enterprise/{id}', [EnterpriseController::class, 'update']);
Route::delete('/enterprise/{id}', [EnterpriseController::class, 'destroy']);

Route::post('/cost-centers', [CostCenterController::class, 'store']);
Route::get('/enterprise/{enterpriseId}/cost-centers',
    [CostCenterController::class, 'indexByEnterprise']
);
Route::put('/cost-centers/{id}', [CostCenterController::class, 'update']);
Route::delete('/cost-centers/{id}', [CostCenterController::class, 'destroy']);

Route::post(
    '/financial-entries', [FinancialEntryController::class, 'store']
);
