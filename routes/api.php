<?php

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

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('api')->group(function () {
    if (config('amplify.api.contact_detail', false)) {
        Route::get('contacts/{contact_code}', \Amplify\System\Api\Http\Controllers\ContactFindController::class)
            ->name('api.contact-by-code');
    }
});
