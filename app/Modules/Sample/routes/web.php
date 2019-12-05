<?php 
$module_namespace = "Modules\Sample\Controllers";

Route::prefix('/')->namespace($module_namespace)->group(function () {
    Route::get('/', "SampleController@index")->name("homepage");
});