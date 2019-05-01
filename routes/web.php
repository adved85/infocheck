<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| Links for Social-login API's
| As you can see, we have 2 methods added into LoginController of Auth.
*/
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');


Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => ['localize']
    ], function () {

    // Route::get('/', 'IndexController@index')->name('index_page');
    // Route::get('/{category_name}', 'OpenCategoryPosts@index')->name('category_posts');

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();
    Auth::routes(['verify'=>true]);

    // Prevent reseting mail-pass and registration
    Route::match(['get', 'post'], 'password/reset', function(){
        return redirect()->route('login', app()->getLocale());
    });
    Route::match(['get', 'post'], 'password/email', function(){
        return redirect()->route('login', app()->getLocale());
    });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/admin_home', 'HomeController@admin_home')->name('admin_home')->middleware(['role:i_admin']);
Route::get('home/add_question', 'HomeController@add_question')->name('add_question')->middleware(['role:i_user','verified']);
Route::get('home/add_comment', 'HomeController@add_comment')->name('add_comment')->middleware(['role:i_user','verified']);
});

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('{password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::group([
    'prefix'=>'{locale}/admin',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'namespace'=>'Admin',
    'middleware' => ['role:i_admin','localize'],
    ], function () {

        Route::get('/', 'DashboardController@index')->name('admin.index');
        Route::post('poster/update', 'DashboardController@updatePosterType')->name('admin.poster.update');

        Route::resource('category', 'CategoryController', ['as'=>'admin']);
        Route::post('category/position/update','CategoryController@positionUpdate')->name('admin.category.position.update');

});
