<?php
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Photo;
use App\Post;

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



// Route::group(['middleware'=>'admin'],function(){
// 	Route::resource('/admin/users','AdminUsersController');
// });


Route::middleware(['auth','admin'])->group(function(){
	Route::get('/admin',function(){
		return view('admin.index');
	});
	Route::resource('/admin/users','AdminUsersController');
	Route::resource('/admin/posts','AdminPostsController');
	Route::resource('/admin/categories','AdminCategoriesController');
});


/**
	because of my silly mistake in admin.blade.php I had to contact Edwin and he helped me by suggesting to create a controller for the admin page and calling the /admin route like this:-
**/
// Route::get('/admin','AdminController@index')->middleware(['auth','admin']);

/* Log out the currently authenticated user */
Route::get('/logout',function(){
	Auth::logout();
	return redirect('/login');
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












/*****************************************  Admin Post Routes  *************************************/

/* get the post associated with the user */
Route::get('/post/{id}',function($id){
	$user = User::findOrFail($id);
	foreach($user->posts as $post){
		echo $post . '<br>';
	}
});

/* get the user who created the post */
Route::get('/user/{id}',function($id){
	$post = Post::findOrFail($id);
	return $post->user;
});

/* get the photo of the post */
Route::get('/photo/{id}',function($id){
	$post = Post::findOrFail($id);
	return $post->photo;
});

/* get the post associated with the photo */
Route::get('/photo_post/{id}',function($id){
	$photo = Photo::findOrFail($id);
	return $photo->post;
});


/* return the creator of the post */
Route::get('/post_owner/{id}','AdminPostsController@post_owner');