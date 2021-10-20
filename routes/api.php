<?php

/* Admin Api Routes */
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api', 'scopes:admin']], function () {

});

/* Auth Api Routes */
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1', 'middleware' => ['api']], function () {
    Route::post('auth/login', 'AuthController@login')->name('auth.login');
    Route::post('auth/refresh', 'AuthController@refresh')->name('auth.refresh');
    Route::post('auth/logout', 'AuthController@logout')->name('auth.logout')->middleware('auth:api');
});


/* Frontend Api Routes */
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Frontend', 'middleware' => ['api', 'auth:api', 'scopes:frontend']], function () {
    /* Topics */
    Route::apiResource('course-topics', 'CourseTopicApiController');
    Route::apiResource('course-products', 'CourseProductApiController');
    Route::apiResource('course-instructors', 'CourseInstructorApiController');
});
