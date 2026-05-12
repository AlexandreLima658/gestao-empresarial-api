<?php

use App\Http\Controllers\Cash\CashFlowController;
use App\Http\Controllers\CostCenter\CostCenterController;
use App\Http\Controllers\Enterprise\EnterpriseController;
use App\Http\Controllers\Financial\FinancialEntryController;
use App\Http\Controllers\Monthly\MonthlyClosingController;
use Illuminate\Support\Facades\Route;


Route::apiResource("/enterprise", EnterpriseController::class);

Route::apiResource("/cost-centers", CostCenterController::class);

Route::apiResource("/financial-entries", FinancialEntryController::class);

Route::apiResource("/cash-flow", CashFlowController::class);

Route::apiResource('/monthly-closing', MonthlyClosingController::class);

Route::get('/enterprise/{enterpriseId}/cost-centers',
    [CostCenterController::class, 'indexByEnterprise']
);
