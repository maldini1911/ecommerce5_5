<?php

Route::group(['namespace' => 'Admin'], function(){
        
        Config::set('auth.defines', 'admin');

Route::get('admin/login', 'Admin@login');
Route::post('admin/login', 'Admin@login_post');
Route::get('dashboard', function(){
        return view('admin.home');
});

Route::group(['middleware' => 'admin:admin'], function(){
Route::resource('admins', 'AdminController');
Route::delete('admins/delete/all', 'AdminController@multi_delete');


//====== Start Users ===============
Route::resource('users', 'UserController');
Route::delete('users/delete/all', 'UserController@multi_delete');
//====== End Users =================
Route::get('dashboard', function(){

        return view('admin.home');
});
//=============== Settings =============
Route::get('settings', 'SettingController@setting');
Route::post('settings', 'SettingController@setting_save');
//=============== countries ==================
Route::resource('countries', 'CountryController');
Route::delete('countries/delete/all', 'CountryController@multi_delete');
//=============== cities ==================
Route::resource('cities', 'CitiesController');
Route::delete('cities/delete/all', 'CitiesController@multi_delete');
//=============== states ==================
Route::resource('states', 'StatesController');
Route::delete('states/delete/all', 'StatesController@multi_delete');
//=============== Departments ==================
Route::resource('departments', 'DepartmentController');
Route::delete('departments/delete/all', 'DepartmentController@multi_delete');
//=============== TradeMarks ==================
Route::resource('trademarks', 'TradeMarkController');
Route::delete('trademarks/delete/all', 'TradeMarkController@multi_delete');
//=============== Manufacturers ==================
Route::resource('manufacturers', 'ManufacturersController');
Route::delete('manufacturers/delete/all', 'ManufacturersController@multi_delete');
//=============== Shippings ==================
Route::resource('shippings', 'ShippingsController');
Route::delete('shippings/delete/all', 'ShippingsController@multi_delete');
//=============== Malls ==================
Route::resource('malls', 'MallControllers');
Route::delete('malls/delete/all', 'MallControllers@multi_delete');
//=============== Colors ==================
Route::resource('colors', 'ColorsController');
Route::delete('colors/delete/all', 'ColorsController@multi_delete');
//=============== Sizes ==================
Route::resource('sizes', 'SizeController');
Route::delete('sizes/delete/all', 'SizeController@multi_delete');
//=============== Weights ==================
Route::resource('weights', 'WeightsContorller');
Route::delete('weights/delete/all', 'WeightsContorller@multi_delete');
//=============== Products ==================
Route::resource('products', 'ProductsController');
Route::delete('products/delete/all', 'ProductsController@multi_delete');
Route::post('upload/image/{pid}', 'ProductsController@upload_file');
Route::post('delete/image', 'ProductsController@delete_file');
Route::post('update/image/{id}', 'ProductsController@update_product_image');
Route::post('delete/product/image/{id}', 'ProductsController@delete_product_image');
Route::post('load/weight/size', 'ProductsController@size_weight');
//-------------> Admin Logout <-----------------//
Route::any('admin/logout', 'Admin@logout');

});


Route::get('upload', function(){ return view('welcome');});
Route::post('upload', 'Upload@upload'); 

//=== langs ==
Route::get('lang/{lang}', function($lang){
session()->has('lang') ? session()->forget('lang') : '';
        if($lang == 'ar'){

                session()->put('lang', 'ar');
        }else{

                session()->put('lang', 'en');
        }
        return back();
});




});