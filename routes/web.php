<?php
use App\User;
use App\Role;
use App\Photo;

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

Route::resource('/admin/users','AdminUsersController');

Route::get('/admin',function(){
	return view('admin.index');
});

Route::get('/roles','AdminUsersController@user_roles');

/* get the photo associated with the user using an accessor */
// Route::get('photo',function(){
// 	$user = User::find(4);
// 	return $user->photo_id;
// });

Route::get('/photos',function(){
	$users = User::all();
	foreach($users as $user){
		// echo $user . "<br>";
		echo $user->photo . "<br>";
	}
});

// Route::get('/user_t_photo',function(){
// 	$photo = Photo::find(1);
// 	return $photo->user;
// });

/* get the path of the user image (using the custom user profile image path method) */
Route::get('/photo_path',function(){
	$user = User::findOrFail(7);
	return $user;
});