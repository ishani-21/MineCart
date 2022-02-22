<?php

use App\Http\Controllers\Seller\Auth\BrandController;
use App\Http\Controllers\Seller\Auth\CategoryController;
use App\Http\Controllers\Seller\Auth\DashboardController;
use App\Http\Controllers\Seller\Auth\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Auth\RegisterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('Seller',  function () {
    return redirect()->route('seller.login');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('paymentpage', function () {
		return view('Seller.Store.payment');
	});
    // Login
    Route::get('login',                         'LoginController@showLoginForm')->name('login');
    Route::post('login',                        'LoginController@login');
    Route::post('logout',                       'LoginController@logout')->name('logout');

    // Register
    Route::get('otp',                           'RegisterController@varifyOtpShow')->name('varify_otp_show');
    Route::get('register',                      'RegisterController@showRegisterForm')->name('register');
    Route::post('individual-register',          'RegisterController@individualRegister')->name('individual_register');
    Route::post('bussiness-register',           'RegisterController@businessRegister')->name('bussiness_register');
    Route::get('business-register',             'RegisterController@showBusinessRegisterForm')->name('business_register');

    //forgot password
    Route::get('forgot',                        'RegisterController@showForgetPasswordForm')->name('forgot_password_show');
    Route::post('forgot-password',              'RegisterController@submitForgetPasswordForm')->name('forgot_password');
    Route::get('reset-password/{token}',        'RegisterController@showResetPasswordForm')->name('reset_password_get');
    Route::post('reset-password',               'RegisterController@submitResetPasswordForm')->name('reset_password_post');
    Route::post('verify-otp',                   'RegisterController@verifyOtp')->name('verify_otp');

    // Social Login
    Route::get('login/google',                  'LoginController@redirectToProviderGoogle')->name('google');
    Route::get('login/google/callback',         'LoginController@handleProviderCallbackGoogle');

    Route::get('login/facebook',                'LoginController@redirectToProviderFacebook')->name('facebook');
    Route::get('login/facebook/callback',       'LoginController@handleProviderCallbackFacebook');
});
Route::group(['middleware' => 'auth:seller'], function () {

    //Dashboard
    Route::get('dashboard',                     [DashboardController::class, 'index'])->name('main');
    Route::get('welcome',                       [DashboardController::class, 'frontPage'])->name('front');

    // Profile
    Route::get('show-edit-profile',             'Auth\RegisterController@showEditProfile')->name('show_edit_profile');
    Route::post('update-profile/{id}',          'Auth\RegisterController@updateProfile')->name('update_profile');
    Route::post('set-state',                    'Auth\RegisterController@state')->name('set_state');
    Route::post('set-city',                     'Auth\RegisterController@')->name('set_city');

    //Change Password
    Route::get('/changePassword',               [RegisterController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',              [RegisterController::class, 'changePasswordPost'])->name('changePasswordPost');

    // Store
    Route::get('store-list',                    'Auth\StoreController@showStoreList')->name('store_list');
    Route::get('add-store',                     'Auth\StoreController@addStore')->name('add_store');
    Route::post('create-store',                 'Auth\StoreController@createStore')->name('create_store');
    Route::get('store-status',                  'Auth\StoreController@storeStatus')->name('store_status');
    Route::post('en-name',                      'Auth\StoreController@enName')->name('en_name');
    Route::post('ar-name',                      'Auth\StoreController@arName')->name('ar_name');
    Route::get('show-store/{id}',               'Auth\StoreController@showStore')->name('show_store');
    Route::get('edit-store/{id}',               'Auth\StoreController@editStore')->name('edit_store');
    Route::post('update-store/{id}',            'Auth\StoreController@updateStore')->name('update_store');
    Route::post('delete-store/{id}',            'Auth\StoreController@deleteStore')->name('delete_store');

    //brand
    Route::get('brand-list',                    [BrandController::class, 'showBrand'])->name('brand_list');
    Route::post('brand-get',                    [BrandController::class, 'getBrand'])->name('get-brand');
    Route::post('brand-select',                 [BrandController::class, 'selectedBrand'])->name('select_brand');

    //Category
    Route::get('category-list',                 [CategoryController::class, 'showCategory'])->name('category_list');
    Route::post('category-get',                 [CategoryController::class, 'getCategory'])->name('get-category');
    Route::post('category-store',               [CategoryController::class, 'storeCategory'])->name('store-category');
    Route::post('slecet-category',              [CategoryController::class, 'slecetCategory'])->name('slecetCategory');

    //Product
    Route::resource('product',                  'Auth\ProductController')->except('destroy');
    Route::post('delete',                       [ProductController::class, 'destroy'])->name('delete');
    Route::post('remove',                       [ProductController::class, 'removeImages'])->name('delete_image');
    Route::get('product-status',                [ProductController::class, 'status'])->name('product_status');

    // Notification
    Route::get('show-notification',             'Auth\NotificationController@show')->name('show_notification');
    Route::get('count-notification',            'Auth\NotificationController@count')->name('count_notification');
    Route::post('delete-notification/{id}',     'Auth\NotificationController@delete')->name('delete_noti');

    // Payment
	Route::post('paymentPage',                  'Auth\StoreController@paymentPage')->name('paymentPage');
	Route::post('payment',                      'Auth\StoreController@payment')->name('payment');

});
