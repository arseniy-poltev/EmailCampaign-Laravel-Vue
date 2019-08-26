<?php

Route::group(['prefix' => '/v1', 'middleware' => ['auth:api'], 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('auth.change_password');

    Route::get('getCities/{cId}', 'CitiesController@getCities');
    Route::get('getKeyAnswers/{kId}', 'KeyAnswersController@getKeyAnswers');

    Route::apiResource('rules', 'RulesController', ['only' => ['index']]);
    Route::apiResource('permissions', 'PermissionsController');
    Route::apiResource('roles', 'RolesController');
    Route::apiResource('users', 'UsersController');

    Route::apiResource('campaigns', 'CampaignsController');
    Route::apiResource('countries', 'CountriesController');
    Route::apiResource('cities', 'CitiesController');
    Route::apiResource('currencies', 'CurrenciesController');
    Route::apiResource('invoices', 'InvoiceController');
    Route::apiResource('topics', 'TopicsController');
    Route::apiResource('filter-keys', 'FilterKeysController');
    Route::apiResource('key-answers', 'KeyAnswersController');
    Route::apiResource('languages', 'LanguagesController');
    Route::get('campaignsSummary', 'CampaignsController@summary');
    Route::get('getAvailableUsers/{code}', 'CountriesController@getAvaliableUsers');
});



Route::group(['prefix' => '/v2', 'middleware' => ['auth:api'], 'namespace' => 'Api\V2', 'as' => 'api.'], function () {
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('auth.change_password');

    Route::apiResource('campaigns', 'CampaignsController');
    Route::get('campaignsSummary', 'CampaignsController@summary');
    Route::post('campaigns/getTarget', 'CampaignsController@getTarget');
    Route::get('campaigns/{id}/invoice', 'CampaignsController@getInvoice');
    Route::post('campaigns/stripePay', 'CampaignsController@stripePay');
    Route::get('getInvoices', 'InvoiceController@index');
    Route::get('countries/activeCountries', 'CountriesController@getActive');
});

Route::group(['prefix' => '/common', 'middleware' => ['auth:api']], function () {

    Route::get('clearNotification', 'NotificationController@clearUnreadNotification');
    Route::post('setDeviceInfo', 'Auth\ResetDeviceInfoController@setDeviceInfo');
});