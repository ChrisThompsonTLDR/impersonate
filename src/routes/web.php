<?php

use Christhompsontldr\Impersonate\Http\Controllers\ImpersonateController;

Route::group(['prefix' => config('impersonate.routes.prefix'), 'middleware' => config('impersonate.routes.middlewareGroup')], function () {
    Route::get(config('impersonate.routes.stop'),  [ImpersonateController::class, 'stop']) ->name('impersonate.stop');
    Route::get(config('impersonate.routes.start'), [ImpersonateController::class, 'start'])->name('impersonate.start');
});
