<?php
Route::group(['prefix' => config('impersonate.routes.prefix', ''), 'middleware' => config('impersonate.routes.middlewareGroup', 'web')], function () {
    Route::get(config('impersonate.routes.start', 'impersonate/{id}'), ['as' => 'impersonate.start', 'uses' => 'ImpersonateController@start'])->where('id', '[0-9]+');
    Route::get(config('impersonate.routes.stop',  'impersonate/stop'),  ['as' => 'impersonate.stop',  'uses' => 'ImpersonateController@stop']);
});