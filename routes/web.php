<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Structure
    Route::delete('structures/destroy', 'StructureController@massDestroy')->name('structures.massDestroy');
    Route::resource('structures', 'StructureController');
    Route::get('structures/reorder/list','StructureController@reorder')->name('structures.reorder');
    Route::post('structures/reorder/store','StructureController@reorderStore')->name('structures.reorderStore');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Taxonomy Course
    Route::delete('taxonomy-courses/destroy', 'TaxonomyCourseController@massDestroy')->name('taxonomy-courses.massDestroy');
    Route::post('taxonomy-courses/media', 'TaxonomyCourseController@storeMedia')->name('taxonomy-courses.storeMedia');
    Route::post('taxonomy-courses/ckmedia', 'TaxonomyCourseController@storeCKEditorImages')->name('taxonomy-courses.storeCKEditorImages');
    Route::resource('taxonomy-courses', 'TaxonomyCourseController');

    // Taxonomy Course Type
    Route::delete('taxonomy-course-types/destroy', 'TaxonomyCourseTypeController@massDestroy')->name('taxonomy-course-types.massDestroy');
    Route::post('taxonomy-course-types/media', 'TaxonomyCourseTypeController@storeMedia')->name('taxonomy-course-types.storeMedia');
    Route::post('taxonomy-course-types/ckmedia', 'TaxonomyCourseTypeController@storeCKEditorImages')->name('taxonomy-course-types.storeCKEditorImages');
    Route::resource('taxonomy-course-types', 'TaxonomyCourseTypeController');

    // Taxonomy Address Type
    Route::delete('taxonomy-address-types/destroy', 'TaxonomyAddressTypeController@massDestroy')->name('taxonomy-address-types.massDestroy');
    Route::post('taxonomy-address-types/media', 'TaxonomyAddressTypeController@storeMedia')->name('taxonomy-address-types.storeMedia');
    Route::post('taxonomy-address-types/ckmedia', 'TaxonomyAddressTypeController@storeCKEditorImages')->name('taxonomy-address-types.storeCKEditorImages');
    Route::resource('taxonomy-address-types', 'TaxonomyAddressTypeController');

    // Taxonomy Arms Category
    Route::delete('taxonomy-arms-categories/destroy', 'TaxonomyArmsCategoryController@massDestroy')->name('taxonomy-arms-categories.massDestroy');
    Route::post('taxonomy-arms-categories/media', 'TaxonomyArmsCategoryController@storeMedia')->name('taxonomy-arms-categories.storeMedia');
    Route::post('taxonomy-arms-categories/ckmedia', 'TaxonomyArmsCategoryController@storeCKEditorImages')->name('taxonomy-arms-categories.storeCKEditorImages');
    Route::resource('taxonomy-arms-categories', 'TaxonomyArmsCategoryController');

    // Taxonomy Arms Code
    Route::delete('taxonomy-arms-codes/destroy', 'TaxonomyArmsCodeController@massDestroy')->name('taxonomy-arms-codes.massDestroy');
    Route::post('taxonomy-arms-codes/media', 'TaxonomyArmsCodeController@storeMedia')->name('taxonomy-arms-codes.storeMedia');
    Route::post('taxonomy-arms-codes/ckmedia', 'TaxonomyArmsCodeController@storeCKEditorImages')->name('taxonomy-arms-codes.storeCKEditorImages');
    Route::resource('taxonomy-arms-codes', 'TaxonomyArmsCodeController');

    // Taxonomy Media Provider
    Route::delete('taxonomy-media-providers/destroy', 'TaxonomyMediaProviderController@massDestroy')->name('taxonomy-media-providers.massDestroy');
    Route::post('taxonomy-media-providers/media', 'TaxonomyMediaProviderController@storeMedia')->name('taxonomy-media-providers.storeMedia');
    Route::post('taxonomy-media-providers/ckmedia', 'TaxonomyMediaProviderController@storeCKEditorImages')->name('taxonomy-media-providers.storeCKEditorImages');
    Route::resource('taxonomy-media-providers', 'TaxonomyMediaProviderController');

    // Taxonomy Certification Type
    Route::delete('taxonomy-certification-types/destroy', 'TaxonomyCertificationTypeController@massDestroy')->name('taxonomy-certification-types.massDestroy');
    Route::post('taxonomy-certification-types/media', 'TaxonomyCertificationTypeController@storeMedia')->name('taxonomy-certification-types.storeMedia');
    Route::post('taxonomy-certification-types/ckmedia', 'TaxonomyCertificationTypeController@storeCKEditorImages')->name('taxonomy-certification-types.storeCKEditorImages');
    Route::resource('taxonomy-certification-types', 'TaxonomyCertificationTypeController');

    // Taxonomy Credit Type
    Route::delete('taxonomy-credit-types/destroy', 'TaxonomyCreditTypeController@massDestroy')->name('taxonomy-credit-types.massDestroy');
    Route::post('taxonomy-credit-types/media', 'TaxonomyCreditTypeController@storeMedia')->name('taxonomy-credit-types.storeMedia');
    Route::post('taxonomy-credit-types/ckmedia', 'TaxonomyCreditTypeController@storeCKEditorImages')->name('taxonomy-credit-types.storeCKEditorImages');
    Route::resource('taxonomy-credit-types', 'TaxonomyCreditTypeController');

    // Taxonomy Discount Type
    Route::delete('taxonomy-discount-types/destroy', 'TaxonomyDiscountTypeController@massDestroy')->name('taxonomy-discount-types.massDestroy');
    Route::post('taxonomy-discount-types/media', 'TaxonomyDiscountTypeController@storeMedia')->name('taxonomy-discount-types.storeMedia');
    Route::post('taxonomy-discount-types/ckmedia', 'TaxonomyDiscountTypeController@storeCKEditorImages')->name('taxonomy-discount-types.storeCKEditorImages');
    Route::resource('taxonomy-discount-types', 'TaxonomyDiscountTypeController');

    // Taxonomy Phone Type
    Route::delete('taxonomy-phone-types/destroy', 'TaxonomyPhoneTypeController@massDestroy')->name('taxonomy-phone-types.massDestroy');
    Route::post('taxonomy-phone-types/media', 'TaxonomyPhoneTypeController@storeMedia')->name('taxonomy-phone-types.storeMedia');
    Route::post('taxonomy-phone-types/ckmedia', 'TaxonomyPhoneTypeController@storeCKEditorImages')->name('taxonomy-phone-types.storeCKEditorImages');
    Route::resource('taxonomy-phone-types', 'TaxonomyPhoneTypeController');

    // Taxonomy Ad Service
    Route::delete('taxonomy-ad-services/destroy', 'TaxonomyAdServiceController@massDestroy')->name('taxonomy-ad-services.massDestroy');
    Route::post('taxonomy-ad-services/media', 'TaxonomyAdServiceController@storeMedia')->name('taxonomy-ad-services.storeMedia');
    Route::post('taxonomy-ad-services/ckmedia', 'TaxonomyAdServiceController@storeCKEditorImages')->name('taxonomy-ad-services.storeCKEditorImages');
    Route::resource('taxonomy-ad-services', 'TaxonomyAdServiceController');

    // Taxonomy Media Delivery
    Route::delete('taxonomy-media-deliveries/destroy', 'TaxonomyMediaDeliveryController@massDestroy')->name('taxonomy-media-deliveries.massDestroy');
    Route::post('taxonomy-media-deliveries/media', 'TaxonomyMediaDeliveryController@storeMedia')->name('taxonomy-media-deliveries.storeMedia');
    Route::post('taxonomy-media-deliveries/ckmedia', 'TaxonomyMediaDeliveryController@storeCKEditorImages')->name('taxonomy-media-deliveries.storeCKEditorImages');
    Route::resource('taxonomy-media-deliveries', 'TaxonomyMediaDeliveryController');

    // Taxonomy Media Type
    Route::delete('taxonomy-media-types/destroy', 'TaxonomyMediaTypeController@massDestroy')->name('taxonomy-media-types.massDestroy');
    Route::post('taxonomy-media-types/media', 'TaxonomyMediaTypeController@storeMedia')->name('taxonomy-media-types.storeMedia');
    Route::post('taxonomy-media-types/ckmedia', 'TaxonomyMediaTypeController@storeCKEditorImages')->name('taxonomy-media-types.storeCKEditorImages');
    Route::resource('taxonomy-media-types', 'TaxonomyMediaTypeController');

    // Taxonomy Practice Type
    Route::delete('taxonomy-practice-types/destroy', 'TaxonomyPracticeTypeController@massDestroy')->name('taxonomy-practice-types.massDestroy');
    Route::post('taxonomy-practice-types/media', 'TaxonomyPracticeTypeController@storeMedia')->name('taxonomy-practice-types.storeMedia');
    Route::post('taxonomy-practice-types/ckmedia', 'TaxonomyPracticeTypeController@storeCKEditorImages')->name('taxonomy-practice-types.storeCKEditorImages');
    Route::resource('taxonomy-practice-types', 'TaxonomyPracticeTypeController');

    // Taxonomy Profession
    Route::delete('taxonomy-professions/destroy', 'TaxonomyProfessionController@massDestroy')->name('taxonomy-professions.massDestroy');
    Route::post('taxonomy-professions/media', 'TaxonomyProfessionController@storeMedia')->name('taxonomy-professions.storeMedia');
    Route::post('taxonomy-professions/ckmedia', 'TaxonomyProfessionController@storeCKEditorImages')->name('taxonomy-professions.storeCKEditorImages');
    Route::resource('taxonomy-professions', 'TaxonomyProfessionController');

    // Taxonomy Web Category
    Route::delete('taxonomy-web-categories/destroy', 'TaxonomyWebCategoryController@massDestroy')->name('taxonomy-web-categories.massDestroy');
    Route::post('taxonomy-web-categories/media', 'TaxonomyWebCategoryController@storeMedia')->name('taxonomy-web-categories.storeMedia');
    Route::post('taxonomy-web-categories/ckmedia', 'TaxonomyWebCategoryController@storeCKEditorImages')->name('taxonomy-web-categories.storeCKEditorImages');
    Route::resource('taxonomy-web-categories', 'TaxonomyWebCategoryController');

    // Taxonomy Tag
    Route::delete('taxonomy-tags/destroy', 'TaxonomyTagController@massDestroy')->name('taxonomy-tags.massDestroy');
    Route::resource('taxonomy-tags', 'TaxonomyTagController');

    // Taxonomy Content Block Type
    Route::delete('taxonomy-content-block-types/destroy', 'TaxonomyContentBlockTypeController@massDestroy')->name('taxonomy-content-block-types.massDestroy');
    Route::resource('taxonomy-content-block-types', 'TaxonomyContentBlockTypeController');

    // Slider
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    // Slider Image
    Route::delete('slider-images/destroy', 'SliderImageController@massDestroy')->name('slider-images.massDestroy');
    Route::post('slider-images/media', 'SliderImageController@storeMedia')->name('slider-images.storeMedia');
    Route::post('slider-images/ckmedia', 'SliderImageController@storeCKEditorImages')->name('slider-images.storeCKEditorImages');
    Route::resource('slider-images', 'SliderImageController');

    // Course Topic
    Route::delete('course-topics/destroy', 'CourseTopicController@massDestroy')->name('course-topics.massDestroy');
    Route::post('course-topics/media', 'CourseTopicController@storeMedia')->name('course-topics.storeMedia');
    Route::post('course-topics/ckmedia', 'CourseTopicController@storeCKEditorImages')->name('course-topics.storeCKEditorImages');
    Route::resource('course-topics', 'CourseTopicController');

    // Course Product
    Route::delete('course-products/destroy', 'CourseProductController@massDestroy')->name('course-products.massDestroy');
    Route::post('course-products/media', 'CourseProductController@storeMedia')->name('course-products.storeMedia');
    Route::post('course-products/ckmedia', 'CourseProductController@storeCKEditorImages')->name('course-products.storeCKEditorImages');
    Route::resource('course-products', 'CourseProductController');

    // Course Coupon
    Route::delete('course-coupons/destroy', 'CourseCouponController@massDestroy')->name('course-coupons.massDestroy');
    Route::post('course-coupons/media', 'CourseCouponController@storeMedia')->name('course-coupons.storeMedia');
    Route::post('course-coupons/ckmedia', 'CourseCouponController@storeCKEditorImages')->name('course-coupons.storeCKEditorImages');
    Route::resource('course-coupons', 'CourseCouponController');

    // Course Instructor
    Route::delete('course-instructors/destroy', 'CourseInstructorController@massDestroy')->name('course-instructors.massDestroy');
    Route::post('course-instructors/media', 'CourseInstructorController@storeMedia')->name('course-instructors.storeMedia');
    Route::post('course-instructors/ckmedia', 'CourseInstructorController@storeCKEditorImages')->name('course-instructors.storeCKEditorImages');
    Route::resource('course-instructors', 'CourseInstructorController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Content Block
    Route::delete('content-blocks/destroy', 'ContentBlockController@massDestroy')->name('content-blocks.massDestroy');
    Route::post('content-blocks/media', 'ContentBlockController@storeMedia')->name('content-blocks.storeMedia');
    Route::post('content-blocks/ckmedia', 'ContentBlockController@storeCKEditorImages')->name('content-blocks.storeCKEditorImages');
    Route::get('content-blocks/{content_block_type}','ContentBlockController@index')->name('content-blocks.index');
    Route::post('content-blocks/{content_block_type}','ContentBlockController@store')->name('content-blocks.store');
    Route::get('content-blocks/{content_block_type}/create','ContentBlockController@create')->name('content-blocks.create');
    Route::get('content-blocks/{content_block_type}/{content_block}/show','ContentBlockController@show')->name('content-blocks.show');
    Route::get('content-blocks/{content_block_type}/{content_block}/edit','ContentBlockController@edit')->name('content-blocks.edit');
    Route::put('content-blocks/{content_block_type}/{content_block}','ContentBlockController@update')->name('content-blocks.update');
    Route::delete('content-blocks/{content_block_type}/{content_block}','ContentBlockController@destroy')->name('content-blocks.destroy');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // System Calendar
    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

    Route::get('/documentation', 'DevController@index')->name('documentation');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
