<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityGroupController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProductCampaignController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('city-group',[CityGroupController::class, 'index']);
Route::get('city-group/{id}',[CityGroupController::class, 'show']);
Route::post('city-group',[CityGroupController::class, 'store']);
Route::put('city-group/{id}',[CityGroupController::class, 'update']);
Route::delete('city-group/{id}',[CityGroupController::class, 'destroy']);

Route::get('city',[CityController::class, 'index']);
Route::get('city/{id}',[CityController::class, 'show']);
Route::post('city',[CityController::class, 'store']);
Route::put('city/{id}',[CityController::class, 'update']);
Route::delete('city/{id}',[CityController::class, 'destroy']);

Route::get('product',[ProductController::class, 'index']);
Route::get('product/{id}',[ProductController::class, 'show']);
Route::post('product',[ProductController::class, 'store']);
Route::put('product/{id}',[ProductController::class, 'update']);
Route::delete('product/{id}',[ProductController::class, 'destroy']);

Route::get('campaign',[CampaignController::class, 'index']);
Route::get('campaign/{id}',[CampaignController::class, 'show']);
Route::post('campaign',[CampaignController::class, 'store']);
Route::put('campaign/{id}',[CampaignController::class, 'update']);
Route::delete('campaign/{id}',[CampaignController::class, 'destroy']);

Route::get('product-campaign',[ProductCampaignController::class, 'index']);
Route::get('product-campaign/{id}',[ProductCampaignController::class, 'show']);
Route::post('product-campaign',[ProductCampaignController::class, 'store']);
Route::put('product-campaign/{id}',[ProductCampaignController::class, 'update']);
Route::delete('product-campaign/{id}',[ProductCampaignController::class, 'destroy']);
