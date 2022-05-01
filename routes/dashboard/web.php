<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix(env('DASH_URL'))->name(env('DASH_URL') . '.')->middleware(['auth:__tala_','web'])->group(function () {

            Route::get('index', 'HomeController@index')->name('index');
            Route::get('profile', 'HomeController@profile')->name('profile');
            Route::post('profile', 'HomeController@update_profile')->name('profile');
            Route::post('profile/password', 'HomeController@change_password')->name('profile.password');

            Route::get('settings','SettingController@index')->name('settings');
            Route::post('settings','SettingController@update')->name('settings');

            Route::resource('features', 'FeatureController')->except(['destroy']);
            Route::get('features/block/{id}', 'FeatureController@block')->name('features.block');
            Route::get('features/active/{id}', 'FeatureController@active')->name('features.active');
            Route::get('features/remove/{id}', 'FeatureController@remove')->name('features.remove');


            Route::resource('benefits', 'BenefitController')->except(['destroy']);
            Route::get('benefits/block/{id}', 'BenefitController@block')->name('benefits.block');
            Route::get('benefits/active/{id}', 'BenefitController@active')->name('benefits.active');
            Route::get('benefits/remove/{id}', 'BenefitController@remove')->name('benefits.remove');

            Route::resource('partners', 'PartnerController')->except(['destroy']);
            Route::get('partners/block/{id}', 'PartnerController@block')->name('partners.block');
            Route::get('partners/active/{id}', 'PartnerController@active')->name('partners.active');
            Route::get('partners/remove/{id}', 'PartnerController@remove')->name('partners.remove');

            Route::resource('projects', 'ProjectController')->except(['destroy']);
            Route::get('projects/block/{id}', 'ProjectController@block')->name('projects.block');
            Route::get('projects/active/{id}', 'ProjectController@active')->name('projects.active');
            Route::get('projects/remove/{id}', 'ProjectController@remove')->name('projects.remove');


            Route::resource('statistics', 'StatisticController')->except(['destroy']);
            Route::get('statistics/block/{id}', 'StatisticController@block')->name('statistics.block');
            Route::get('statistics/active/{id}', 'StatisticController@active')->name('statistics.active');
            Route::get('statistics/remove/{id}', 'StatisticController@remove')->name('statistics.remove');

            Route::resource('users', 'UserController')->except(['destroy']);
            Route::get('users/remove/{id}', 'UserController@remove')->name('users.remove');

        });
    });
