<?php

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', function ()    {
        return "this is login";
    });
});