<?php

// Localization
Route::get('/js/lang.js', ['as' => 'locale', function (Request $request) {

    Cache::forget('lang.js');
    $strings = Cache::rememberForever('lang.js', function () {
        global $request;

        $lang = $request->session()->get('locale', 'en');

        $file   = resource_path('lang/' . $lang . '/backend.php');

        $strings = [];


        if (!file_exists($file)) {
            $file   = resource_path('lang/en/backend.php');
        }
        $name           = basename($file, '.php');
        $strings[$name] = require $file;



        return $strings;
    });

    header('Content-Type: text/javascript');
    echo ('window.i18n = ' . json_encode($strings) . ';');
    exit();
}])->name('assets.lang');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/pages/getCount', 'HomeController@getUserCount')->name('getCount');

// $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
// $this->post('login', 'Auth\LoginController@login')->name('auth.login');


// Authentication Routes... 

$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

//Set profile
Route::get('/get-profile', 'ProfilesController@getProfile');
Route::post('/change-profile', 'ProfilesController@changeProfile');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::get('/api/v2/invoice/{id}/generatePDF', 'Api\V2\InvoiceController@getInvoicePDF');
Route::get('/api/v1/invoice/{id}/generatePDF', 'Api\V1\InvoiceController@getInvoicePDF');
Route::get('/api/country/{code}/states', 'HomeController@getAllStates');
Route::get('/api/get_country_info', 'Api\V2\CountriesController@getActive');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/login', 'Auth\LoginController@showAdminLoginForm')->name('login');
    Route::get('/{any?}', 'Admin\AdminHomeController@index')->where('any', '(.*)');
});

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'namespace' => 'User'], function () {
    Route::get('/{any}', 'UserHomeController@index')->where('any', '.*');
});


Route::group(['prefix' => 'users', 'middleware' => 'locale', 'as' => 'users.'], function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/login', 'Auth\LoginController@showUserLoginForm')->name('login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
    Route::post('/register', 'Auth\RegisterController@register');
});

Route::group(['prefix' => 'pages', 'middleware' => 'locale', 'as' => 'pages.'], function () {
    Route::get('/guideline', function () {
        return view('home.guideline');
    });
    Route::get('/targetcustomer', function () {
        return view('home.mobspot');
    });
    Route::get('/faq', function () {
        return view('home.faq');
    });
    Route::get('/planningadv', function () {
        return view('home.planningadv');
    });
    Route::get('/testimonials', function () {
        return view('home.testimonials');
    });
    Route::post('/create', function () {
        return redirect('/admin/campaigns/create');
    });
});