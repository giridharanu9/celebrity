<?php

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

Route::get('/', function () {
	// phpinfo();
    return view('Frontend.home');
});

// Route::get('/admin', function () {
// 	// phpinfo();
//     return view('welcome');
// });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

//Route::get('/admin', 'AdminController@index')->name('home');
Route::group(
	[
		'prefix' => 'admin',  //link url parameter
		'namespace' => 'Admin', //folder
		'middleware' => 'App\Http\Middleware\AdminMiddleware'
	], function() {

		Route::match(['get', 'post'], '/', 'AdminController@index');
		Route::get('/changepassword', 'AdminController@changepassword');
		Route::post('/changepassword', 'AdminController@savenewpassword')->name('admin.changepassword');

		Route::resource('poll', 'PollController');
		Route::post('/poll/changestatus', 'PollController@changestatus');
		Route::post('/poll/listDatatable', 'PollController@listDatatable');

		Route::resource('category', 'CategoryController');
		Route::post('/category/changestatus', 'CategoryController@changestatus');
		Route::post('/category/listDatatable', 'CategoryController@listDatatable');

		Route::resource('skill', 'SkillController');
		Route::post('/skill/changestatus', 'SkillController@changestatus');
		Route::post('/skill/listDatatable', 'SkillController@listDatatable');

		Route::resource('celebrity', 'CelebrityController');
		Route::post('/celebrity/changestatus', 'CelebrityController@changestatus');

		Route::post('/celebrity/listDatatable', 'CelebrityController@listDatatable');

});

Route::get('/celebrity/polls', 'Admin\CelebrityController@polls')->name('celebrity.polls');
Route::get('users_rating/{id}', 'Admin\CelebrityController@usersRating');
Route::get('getlikesrank/{id}', 'Admin\CelebrityController@getCelebrityLikesRank');

//Frontend Controller

Route::get('fronthome', 'Admin\FrontEndController@home');
Route::get('view_celebrity/{id}', 'Admin\FrontEndController@viewCelebrity');
Route::get('user/{id}','Admin\FrontEndController@user');
Route::post('save_user', 'Admin\FrontEndController@saveUser');
Route::get('user_profile/{id}', 'Admin\FrontEndController@userProfile');
Route::get('celebrity/search', 'Admin\FrontEndController@searchCelebrity');

// For autocomplete
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
Route::get('celebrity/searchajax',array('as'=>'celebrity/searchajax','uses'=>'Admin\FrontEndController@autoSearchCelebrity'));

Route::post('user-login', 'Auth\LoginController@authenticatedCustomLogin')->name('ajax_login');
// close Autocomplete

Route::post('celebrity_questions', 'Admin\FrontEndController@CelebrityQuestion');
Route::group(['middleware' => 'auth'], function()
{

Route::get('celeb_like/{id}','Admin\FrontEndController@celebLike');
Route::get('add_favorite/{id}','Admin\FrontEndController@addFavorite');
Route::get('remove_favorite/{id}','Admin\FrontEndController@removeFavorite');
Route::get('celeb_dislike/{id}','Admin\FrontEndController@celebDislike');
Route::get('celeb_follow/{id}','Admin\FrontEndController@celebFollow');
Route::get('celeb_unfollow/{id}','Admin\FrontEndController@celebUnfollow');
Route::post('rating/{id}', 'Admin\FrontEndController@rating');
});

Route::get('invite_friends/{id}','Admin\FrontEndController@inviteFriends');

##FrontPageController

Route::get('actress', 'Admin\FrontPageController@actress');
Route::get('actors', 'Admin\FrontPageController@actors');
Route::get('singers', 'Admin\FrontPageController@singers');
Route::get('artists', 'Admin\FrontPageController@artists');
Route::get('politicians', 'Admin\FrontPageController@politicians');
Route::get('sports', 'Admin\FrontPageController@sports');
Route::get('music', 'Admin\FrontPageController@music');
Route::get('movies', 'Admin\FrontPageController@movies');
Route::get('all_users', 'Admin\FrontPageController@allUsers');
Route::get('view_users/{id}', 'Admin\FrontPageController@viewUsers');
Route::get('follow_user/{id}', 'Admin\FrontPageController@followUser');
Route::get('unfollow_user/{id}', 'Admin\FrontPageController@unfollowUser');
Route::post('polls_respond/{id}', 'Admin\FrontPageController@pollsRespond');
Route::post('save_subscribe', 'Admin\FrontPageController@saveSubscribe');
Route::post('save_reference/{id}', 'Admin\FrontPageController@saveReference');
Route::get('view_polls', 'Admin\FrontPageController@viewPolls');


##ActivityController

Route::post('add_activity', 'Admin\ActivityController@addActivity');
Route::get('manage_activity', 'Admin\ActivityController@manageActivity');

##about us
Route::get('about_us', 'Admin\FrontPageController@getAboutUs');

##contact us
Route::get('contact_us', 'Admin\FrontPageController@getContactUs');

##Partner with us
Route::get('partner_with_us', 'Admin\FrontPageController@getPartner');

##Advertisement with us
Route::get('advertisement_with_us', 'Admin\FrontPageController@getAdvertisement');
