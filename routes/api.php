<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Course Topic
    Route::post('course-topics/media', 'CourseTopicApiController@storeMedia')->name('course-topics.storeMedia');
    Route::apiResource('course-topics', 'CourseTopicApiController');

    // Course Product
    Route::post('course-products/media', 'CourseProductApiController@storeMedia')->name('course-products.storeMedia');
    Route::apiResource('course-products', 'CourseProductApiController');

    // Course Instructor
    Route::post('course-instructors/media', 'CourseInstructorApiController@storeMedia')->name('course-instructors.storeMedia');
    Route::apiResource('course-instructors', 'CourseInstructorApiController');
});
