<?php
use App\User;
use App\Role;

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
    return view('welcome');

	/* get the role(s) through the specified user(s) */
	//could've been the individual way as well
	// $users = User::all();
	// foreach($users as $user){
	// 	echo $user->name . " - " . $user->role->name . "<br>";
	// }
	

    /* get all the users through the specified role */
    // $roles = Role::find(1);
    // foreach($roles->user as $user){
    // 	echo $user->name . " - " . $user->role->name . "<br>";
    // }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/users','AdminUsersController');

Route::get('/admin',function(){
	return view('admin.index');
});

Route::get('/roles','AdminUsersController@user_roles');


/* get the path of the user image (using the custom user profile image path method) */
// Route::get('/photo_path',function(){
// 	$user = User::findOrFail(1);
// 	return $user->photo_with_custom_path();
// });