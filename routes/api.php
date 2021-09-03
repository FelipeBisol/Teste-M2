<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityGroupController;
use App\Http\Controllers\CitiesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('city-groups',            'App\Http\Controllers\CityGroupController@getAllCityGroups');
Route::get('city-groups/{id}',      'App\Http\Controllers\CityGroupController@getCityGroup');
Route::post('city-groups',           'App\Http\Controllers\CityGroupController@createCityGroup');
Route::put('city-groups/{id}',      'App\Http\Controllers\CityGroupController@updateCityGroup');
Route::delete('city-groups/{id}',   'App\Http\Controllers\CityGroupController@deleteCityGroup');

Route::get('city',            'App\Http\Controllers\CityController@getAllCity');
Route::get('city/{id}',      'App\Http\Controllers\CityController@getCity');
Route::post('city',           'App\Http\Controllers\CityController@createCity');
Route::put('city/{id}',      'App\Http\Controllers\CityController@updateCity');
Route::delete('city/{id}',   'App\Http\Controllers\CityController@deleteCity');

Route::get('campaign',            'App\Http\Controllers\CampaignController@getAllCampaign');
Route::get('campaign/{id}',      'App\Http\Controllers\CampaignController@getCampaign');
Route::post('campaign',           'App\Http\Controllers\CampaignController@createCampaign');
Route::put('campaign/{id}',      'App\Http\Controllers\CampaignController@updateCampaign');
Route::delete('campaign/{id}',   'App\Http\Controllers\CampaignController@deleteCampaign');

Route::get('product',            'App\Http\Controllers\ProductController@getAllProduct');
Route::get('product/{id}',      'App\Http\Controllers\ProductController@getProduct');
Route::post('product',           'App\Http\Controllers\ProductController@createProduct');
Route::put('product/{id}',      'App\Http\Controllers\ProductController@updateProduct');
Route::delete('product/{id}',   'App\Http\Controllers\ProductController@deleteProduct');

Route::get('product-campaign',            'App\Http\Controllers\ProductCampaignController@getAllProductCampaign');
Route::get('product-campaign/{id}',      'App\Http\Controllers\ProductCampaignController@getProductCampaign');
Route::post('product-campaign',           'App\Http\Controllers\ProductCampaignController@createProductCampaign');
Route::put('product-campaign/{id}',      'App\Http\Controllers\ProductCampaignController@updateProductCampaign');
Route::delete('product-campaign/{id}',   'App\Http\Controllers\ProductCampaignController@deleteProductCampaign');

