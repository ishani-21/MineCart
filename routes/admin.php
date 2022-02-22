<?php

use Illuminate\Support\Facades\Route;

Route::get('admin',  function () {
    return redirect()->route('admin.login');
});

Route::group(['namespace' => 'Auth'], function () {
    # Login Routes
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@login');
    Route::post('logout',   'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('dashboard',                        'DashboardController@index')->name('main');

    # admin update password
    Route::get('change-password',                  'DashboardController@changePassword')->name('change-password');
    Route::patch('update-password',                'DashboardController@updatePassword')->name('update-password');

    #admin category
    Route::group(['prefix' => 'Category', 'as' => "Category."], function () {
        Route::get('category',                    'CategoryController@create')->name('categoryview')->middleware(['permission:category_create']);
        Route::post('categorystore',              'CategoryController@store')->name('categorystore')->middleware(['permission:category_create']);
        Route::get('list',                        'CategoryController@index')->name('categoryindex')->middleware(['permission:category_view']);
        Route::get('show/{id}',                   'CategoryController@show')->name('categoryshow')->middleware(['permission:category_view']);
        Route::get('edit/{id}',                   'CategoryController@edit')->name('categoryedit')->middleware(['permission:category_update']);
        Route::post('update/{id}',                'CategoryController@update')->name('categoryupdate')->middleware(['permission:category_update']);
        Route::post('edit/subcategory',           'CategoryController@subedit')->name('subcategoryedit')->middleware(['permission:category_update']);
        Route::post('subcategory/update',         'CategoryController@subupdate')->name('subcategoryupdate')->middleware(['permission:category_update']);
        Route::post('subdelete',                  'CategoryController@subdelete')->name('subdelete')->middleware(['permission:category_delete']);
        Route::post('catchangestatus',            'CategoryController@catchangestatus')->name('catchangestatus')->middleware(['permission:category_status']);
    });

    #admin Brand
    Route::group(['prefix' => 'Brand', 'as' => "Brand."], function () {
        Route::get('list',                       'BrandController@index')->name('brandindex')->middleware('permission:brand_view');
        Route::get('brand',                      'BrandController@create')->name('brandview')->middleware('permission:brand_create');
        Route::post('brandstore',                'BrandController@store')->name('brandstore')->middleware('permission:brand_create');
        Route::get('edit/{id}',                  'BrandController@edit')->name('edit')->middleware('permission:brand_update');
        Route::post('update',                    'BrandController@update')->name('update')->middleware('permission:brand_update');
        Route::post('delete',                    'BrandController@delete')->name('delete')->middleware('permission:brand_delete');
        Route::patch('changestatus',             'BrandController@changeStatus')->name('changestatus')->middleware('permission:brand_status');
    });

    #admin seller
    Route::group(['prefix' => 'Seller', 'as' => "Seller."], function () {
        Route::get('list',                       'SellerController@index')->name('sellerindex')->middleware('permission:seller_view');
        Route::patch('changestatus',             'SellerController@changeStatus')->name('changestatus')->middleware('permission:seller_status');
        Route::get('view/{id}',                  'SellerController@view')->name('view')->middleware('permission:seller_view');
        Route::patch('status',                   'SellerController@status')->name('status')->middleware('permission:seller_status');
    });

    #admin Membership Plan
    Route::group(['prefix' => 'Membership', 'as' => "Membership."], function () {
        Route::get('list',                       'MembershipController@index')->name('membershipindex')->middleware('permission:membership_view');
        Route::post('membershipstore',           'MembershipController@store')->name('membershipstore')->middleware('permission:membership_create');
        Route::get('edit',                       'MembershipController@edit')->name('edit')->middleware('permission:membership_update');
        Route::post('update',                    'MembershipController@update')->name('update')->middleware('permission:membership_update');
        Route::post('delete',                    'MembershipController@delete')->name('delete')->middleware('permission:membership_delete');
        Route::patch('changestatus',             'MembershipController@changeStatus')->name('changestatus')->middleware('permission:membership_status');
    });

    #admin Store 
    Route::group(['prefix' => 'store', 'as' => "store."], function () {
        Route::get('list',                       'StoreController@index')->name('index')->middleware('permission:store_view');
        Route::get('show/{id}',                      'StoreController@show')->name('show')->middleware('permission:store_view');
        Route::patch('changestatus',             'StoreController@changeStatus')->name('changestatus')->middleware('permission:store_status');
        Route::patch('isapprove',                'StoreController@isapprove')->name('isapprove')->middleware('permission:store_status');
        Route::post('delete',                    'StoreController@delete')->name('delete')->middleware('permission:store_delete');
    });

    #admin Product 
    Route::group(['prefix' => 'product', 'as' => "product."], function () {
        Route::get('list',                       'ProductController@index')->name('index')->middleware('permission:product_view');
        Route::get('show/{id}',                  'ProductController@show')->name('show')->middleware('permission:product_view');
        Route::patch('changestatus',             'ProductController@changeStatus')->name('changestatus')->middleware('permission:product_status');
        Route::patch('isapprove',                'ProductController@isapprove')->name('isapprove')->middleware('permission:product_status');
        Route::post('delete',                    'ProductController@delete')->name('delete')->middleware('permission:product_delete');
    });

    #admin Role 
    Route::group(['prefix' => 'role', 'as' => "role."], function () {
        Route::get('list',                       'RoleController@index')->name('index')->middleware('permission:role_view');
        Route::post('rolestore',                 'RoleController@store')->name('rolestore')->middleware('permission:role_create');
        Route::get('edit/{id}',                  'RoleController@edit')->name('edit')->middleware('permission:role_update');
        Route::post('update',                    'RoleController@update')->name('update')->middleware('permission:role_update');
        Route::post('delete',                    'RoleController@delete')->name('delete')->middleware('permission:role_delete');
    });
    # adminUser
    Route::group(['prefix' => 'adminUser', 'as' => "adminUser."], function () {
        Route::get('index',                      'AdminController@index')->name('index')->middleware('permission:admin_view');
        Route::post('store',                     'AdminController@store')->name('store')->middleware('permission:admin_create');
        Route::get('edit',                       'AdminController@edit')->name('edit')->middleware('permission:admin_update');
        Route::post('update',                    'AdminController@update')->name('update')->middleware('permission:admin_update');
        Route::post('delete',                    'AdminController@delete')->name('delete')->middleware('permission:admin_delete');
    });
});
