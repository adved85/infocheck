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
        Route::get('/', function () {
            return view('welcome');
        });
    Route::get('/search/{s?}', 'SearchesController@getIndex')->where('s', '[\w\d]+')->name('search');
    Route::get('/about', 'About_us@index')->name('about_us');
    //Route::get('/{text}', 'IndexController@error')->name('error');
    Route::post('/posts/{id}/comment/', 'OpenSinglePost@add_comment')->name('single_post.add_comment');
    Route::post('/faqs/leave_question', 'ShowAllFaqs@leave_question')->name('leave.question');
    Route::get('/', 'IndexController@index')->name('index_page');
    Route::get('/post/{category_name}', 'OpenCategoryPosts@index')->name('category_posts');
    Route::get('/posts/{unique_id}/{title}', 'OpenSinglePost@index')->name('single_post');

    // Route::get('home/add_comment', 'HomeController@add_comment')->name('add_comment')->middleware(['role:i_user','verified']);

    Route::get('/tags/{tag_name}', 'CurrentTagPosts@index')->name('tags');
    Route::get('/faqs', 'ShowAllFaqs@index')->name('faqs');
    Route::get('/archieves/{date}', 'ArchievesController@openArchieve')->name('archieves');





    Auth::routes();
    Auth::routes(['verify'=>true]);

    // Prevent reseting mail-pass and registration
    Route::match(['get', 'post'], 'password/reset', function(){
        return redirect()->route('login', app()->getLocale());
    });
    Route::match(['get', 'post'], 'password/email', function(){
        return redirect()->route('login', app()->getLocale());
    });

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home/admin_home', 'HomeController@admin_home')->name('admin_home')->middleware(['role:i_admin']);
// Route::get('home/add_question', 'HomeController@add_question')->name('add_question')->middleware(['role:i_user','verified']);
// Route::get('home/add_comment', 'HomeController@add_comment')->name('add_comment')->middleware(['role:i_user','verified']);


    Route::post('subscribe/saveEmail', 'SubscribeController@saveEmail')->name('subscribe.saveEmail');
    Route::get('subscribe/verify/{token}', 'SubscribeController@verify')->name('subscribe.verify'); // subscribe.verify
    Route::get('subscribe/resend/{token}', 'SubscribeController@resend')->name('subscribe.resend');
    Route::get('subscribe/activate/{token}', 'SubscribeController@activate')->name('subscribe.activate');
    Route::get('subscribe/deactivate/{token}', 'SubscribeController@deactivate')->name('subscribe.deactivate');




});

$sitemap_rules = [
    'prefix' => 'sitemap',
    'namespace' => 'Sitemap',
  ];
  Route::group($sitemap_rules, function () {
    Route::get('/', 'SitemapController@index');
    Route::get('/posts', 'SitemapController@posts');
    Route::get('/questions', 'SitemapController@questions');
  });

Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::get('/{error}', function () {
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
        Route::get('category/translate/{id}', 'CategoryController@translate')->name('admin.category.translate');
        Route::post('category/storetrans', 'CategoryController@storetrans')->name('admin.category.storetrans');

        Route::resource('question', 'QuestionController', ['as' => 'admin']);
        Route::get('question/post/{q_id}', 'QuestionController@post')->name('admin.question.post');
        Route::post('question/post/reply', 'QuestionController@postReply')->name('admin.question.post.reply');
        Route::post('question/reset/{q_id}', 'QuestionController@resetReply')->name('admin.question.reset');

        Route::resource('answer', 'AnswerController', ['as' => 'admin']);
        Route::get('answer/create/{q_id?}', 'AnswerController@create')->name('admin.answer.create');

        Route::resource('post', 'PostController', ['as'=>'admin']);
        Route::get('post/create/{q_id?}', 'PostController@create')->name('admin.post.create');
        Route::get('post/translate/{id}', 'PostController@translate')->name('admin.post.translate');
        Route::get('post/relationship/{id}', 'PostController@relationship')->name('admin.post.relationship'); // relationship

        Route::post('/document/uploadimage', 'DocumentController@uploadimage')->name('admin.document.uploadimage');
        Route::post('/document/uploadfile', 'DocumentController@uploadfile')->name('admin.document.uploadfile');
        Route::post('/document/savedocstatus', 'DocumentController@savedocstatus')->name('admin.document.savedocstatus');

        Route::post('/document/savepicstatus', 'DocumentController@savepicstatus')->name('admin.document.savepicstatus');

        Route::post('/comment/savecommentstatus', 'CommentController@savecommentstatus')->name('admin.comment.savecommentstatus');
        Route::post('/comment/changeStatus', 'CommentController@changeStatus')->name('admin.comment.changeStatus');
        Route::get('/comment', 'CommentController@index')->name('admin.comment.index');

        Route::get('/user', 'UserController@index')->name('admin.user.index');
        Route::put('/user/changeStatus/{id}', 'UserController@changeStatus')->name('admin.user.changeStatus');


        Route::get('email/compose/{user_id}', 'EmailController@compose')->name('admin.email.compose');
        Route::post('email/send/', 'EmailController@send')->name('admin.email.send');
        Route::post('email/sendReply/', 'EmailController@sendReply')->name('admin.email.sendReply'); // answer and post-link

        Route::get('/subscribe', 'SubscribeController@index')->name('admin.subscribe.index');
        Route::get('/subscribe/resend/{subs_id}', 'SubscribeController@resend')->name('admin.subscribe.resend');
        Route::post('/subscribe/changeStatus/{subs_id}', 'SubscribeController@changeStatus')->name('admin.subscribe.changeStatus');
        Route::delete('/subscribe/destroy/{subs_id}', 'SubscribeController@destroy')->name('admin.subscribe.destroy');

        Route::post('/subscribe/prepareToSend', 'SubscribeController@prepareToSend')->name('admin.subscribe.prepareToSend');
        Route::get('/subscribe/mailing', 'SubscribeController@mailing')->name('admin.subscribe.mailing');

        Route::get('/about', 'AboutCompanyController@index')->name('admin.about.index');
        Route::get('/about/edit/{id}', 'AboutCompanyController@edit')->name('admin.about.edit');
        Route::put('/about/update/{id}', 'AboutCompanyController@update')->name('admin.about.update');
        Route::post('/about/changeStatus/{id}', 'AboutCompanyController@changeStatus')->name('admin.about.changeStatus');

        Route::get('/lang', 'LangController@index')->name('admin.lang.index');
        Route::delete('/lang/destroy/{lang_id}', 'LangController@destroy')->name('admin.lang.destroy');
        Route::get('/lang/edit/{lang_id}', 'LangController@edit')->name('admin.lang.edit');
        Route::put('/lang/update/{lang_id}', 'LangController@update')->name('admin.lang.update');
        Route::get('/lang/create', 'LangController@create')->name('admin.lang.create');
        Route::post('/lang/store', 'LangController@store')->name('admin.lang.store');
        Route::post('/lang/changeStatus/{lang_id}', 'LangController@changeStatus')->name('admin.lang.changeStatus');
});






// /* Clear Cache facade value: */
// Route::get('{locale}/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     return '<h1>Cache facade value cleared</h1>';
// });

// /* Reoptimized class loader: */
// Route::get('{locale}/optimize', function() {
//     $exitCode = Artisan::call('optimize');
//     return '<h1>Reoptimized class loader</h1>';
// });

// //* Route cache: */
// Route::get('{locale}/route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return '<h1>Routes cached</h1>';
// });

// /* Clear Route cache: */
// Route::get('{locale}/route-clear', function() {
//     $exitCode = Artisan::call('route:clear');
//     return '<h1>Route cache cleared</h1>';
// });

// /* Clear View cache: */
// Route::get('{locale}/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return '<h1>View cache cleared</h1>';
// });

/* Clear Config cache: */
Route::get('{locale}/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
