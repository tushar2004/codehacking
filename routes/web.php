<?php
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Photo;
use App\Post;
use App\Category;
use App\Vocabulary;


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

// Route::get('/', function () {
//     return view('welcome');

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
// });

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{slug}',['as'=>'home.post','uses'=>'HomeController@post']);


Route::middleware(['auth','admin'])->group(function(){
	Route::get('/admin','AdminController@index');

	Route::resource('/admin/users','AdminUsersController');
	Route::resource('/admin/posts','AdminPostsController');
	Route::resource('/admin/categories','AdminCategoriesController');
	Route::resource('/admin/media','AdminMediasController');
	Route::resource('/admin/comments','PostCommentsController');
	Route::resource('/admin/comment/replies','CommentRepliesController');
	Route::resource('admin/taxonomy','AdminVocabulariesController');
	Route::resource('/admin/gallery','AdminGalleryController');

	Route::get('/admin/gallery/{id}/upload',['as'=>'gallery.uploadpage','uses'=>'AdminGalleryController@upload_photos']);

	Route::get('/admin/galleries',['as'=>'gallery.galleries','uses'=>'AdminGalleryController@galleries']);

	Route::post('/admin/gallery/upload',['as'=>'gallery.upload','uses'=>'AdminGalleryController@upload']);

	// Route::post('/admin/create/gallery',['as'=>'create.gallery','uses'=>'AdminGalleryController@create_gallery']);

	/* custom route for deleting bulk media */
	Route::delete('/admin/delete/media','AdminMediasController@deleteMedia');


	/* custom route for displaying the comments related to a specific post */
	// Route::get('/admin/post/{id}/comments',['as'=>'post.comments','uses'=>'AdminPostsController@post_comments']);

});


Route::get('/image',function() {
	// $img = Image::make('images/certificate.jpg')->orientate();
// 	$img = Image::canvas(1920,800);
// 	$img->insert('images/certificate.jpg');
// 	// $img->text('This is just some random text to test that it\'s working',200,200);
// 	$img->text('Certificate of Completion', 825, 375, function($font) {
// 	    $font->file(public_path('fonts/CaviarDreams.ttf'));
// 	    $font->size(72);
// 	    $font->color('#000000');
// 	    $font->align('center');
// 	    $font->valign('top');
// 	    $font->angle(0);
// 	});

// $mpdf = new \Mpdf\Mpdf();


$html = '
<style style="text/css">
body {
  background-image: url("/images/certificate.jpg");
  background-image-resize: 6; // mpdf style class
}
.centrar{
	display:block;
    position: absolute;
    border: 0px solid red;
    width: 75%;
    left: 0 auto;
    right: 0px !important;
    padding-top: 50px;
    padding-right: 0px !important;
    padding-bottom: 50px;
    padding-left: 130px;
    top: 30%;
    text-align: center;
    font-size: 2em;
    font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;
    font-weight: bold;
}
.points{
    position: absolute;
    border: 0px solid green;
    width: 63.5%;
    left: 0 auto;
    top: 64.7%;
    text-align: center;
    font-size: 1.5em;
    font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;
    font-weight: bold;
}
</style>
<p class="centrar">'. ucwords('some name here some name here some name here some name here some name glyphicon-heart-empty some name here') .'</p>
<p class="centrar points">30</p>
';

    $mpdf = new \Mpdf\Mpdf(['c','A4','','',42,15,67,67,20,15]);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->AddPage('L','','','','',25,25,55,45,18,12);
    $mpdf->WriteHTML($html);
    $mpdf->Output('mpdf.pdf','I');
    exit;

    //==============================================================
    //==============================================================
    //==============================================================



// $img->text('This is to certify that Rico has successfully completed test course on March 15,2019',825,550, function($font) {
// 		$font->file(public_path('fonts/CaviarDreams.ttf'));
// 	    $font->size(52);
// 	    $font->color('#000000');
// 	    $font->align('center');
// 	    $font->valign('top');
// 	    $font->angle(0);
// 	});

// 	$another_image = Image::make('images/bjp-lotus.jpg')->resize(150,150);
// 	$img->insert($another_image,'bottom-center',0,950);
// 	return $img->response('jpg');

	// dd(public_path('fonts\CHOPS__.TTF'));
});

Route::middleware(['auth'])->group(function(){
	Route::post('/comment/reply','CommentRepliesController@createReply');
	Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});


/**
	because of my silly mistake in admin.blade.php I had to contact Edwin and he helped me by suggesting to create a controller for the admin page and calling the /admin route like this:-
**/
// Route::get('/admin','AdminController@index')->middleware(['auth','admin']);

/* Log out the currently authenticated user */
// Route::get('/logout',function(){
// 	Auth::logout();
// 	return redirect('/login');
// });
Route::get('/logout','Auth\LoginController@logout');


/* My way (Though I know it is an unsecure way) */
// Route::get('/admin/comments/approve/{id}',['as'=>'post.comment.approve','uses'=>'PostCommentsController@approve']);

// Route::get('/admin/comments/unapprove/{id}',['as'=>'post.comment.unapprove','uses'=>'PostCommentsController@unapprove']);

// Route::group(['middleware'=>'admin'],function(){
// 	Route::resource('/admin/users','AdminUsersController');
// });



/*****************************************  Admin Post Routes  *************************************/

/* get the post associated with the user */
// Route::get('/post/{id}',function($id){
// 	$user = User::findOrFail($id);
// 	foreach($user->posts as $post){
// 		echo $post . '<br>';
// 	}
// });

// /* get the user who created the post */
// Route::get('/user/{id}',function($id){
// 	$post = Post::findOrFail($id);
// 	return $post->user;
// });

// /* get the photo of the post */
// Route::get('/photo/{id}',function($id){
// 	$post = Post::findOrFail($id);
// 	return $post->photo;
// });

// /* get the post associated with the photo */
// Route::get('/photo_post/{id}',function($id){
// 	$photo = Photo::findOrFail($id);
// 	return $photo->post;
// });


// Route::get('/roles','AdminUsersController@user_roles');

/* get the photo associated with the user using an accessor */
// Route::get('photo',function(){
// 	$user = User::find(4);
// 	return $user->photo_id;
// });

// Route::get('/photos',function(){
// 	$users = User::all();
// 	foreach($users as $user){
// 		// echo $user . "<br>";
// 		echo $user->photo . "<br>";
// 	}
// });

// // Route::get('/user_t_photo',function(){
// // 	$photo = Photo::find(1);
// // 	return $photo->user;
// // });

// /* get the path of the user image (using the custom user profile image path method) */
// Route::get('/photo_path',function(){
// 	$user = User::findOrFail(7);
// 	return $user;
// });

// /* get the categories related to a vocabulary */
Route::get('/vocabulary/{id}/categories',function($id){
	$vocabulary = Vocabulary::findOrFail($id);
	$categories = $vocabulary->categories;
	foreach($categories as $category){
		// echo $category->name . "<br>";
		$posts = $category->posts;
		foreach($posts as $post){
			echo $post->id . ") " . $post->title . "<br>";
		}
	}
});

// /* return the creator of the post */
// Route::get('/post_owner/{id}','AdminPostsController@post_owner');