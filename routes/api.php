<?php

use App\Http\Controllers\CommonOptionController;
use App\Http\Controllers\DeactivateGroupController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    /** Options */
    Route::get('leader-options', [CommonOptionController::class, 'leaders']);
    Route::get('organization-options', [CommonOptionController::class, 'organizations']);

    /** Groups */
    Route::post('groups/deactivate', DeactivateGroupController::class);

    /** Resources */
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/groups', GroupController::class);
    Route::apiResource('/organizations', OrganizationController::class);
});
