<?php
Route::group(['prefix' => config('impersonate.routes.prefix', 'admin/users')], function () {
    Route::get(config('impersonate.routes.start', 'impersonate/{id}'), ['as' => 'impersonate.start', 'uses' => 'ImpersonateController@start'])->where('id', '[0-9]+');
    Route::get(config('impersonate.routes.stop', 'impersonate/stop'),  ['as' => 'impersonate.stop',  'uses' => 'ImpersonateController@stop']);
});