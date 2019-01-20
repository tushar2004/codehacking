<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;
use App\Comment;
use App\Vocabulary;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function is_image_there($request,$input){
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        return $input;
    }



    public function index()
    {
        //
        /* return the results keeping in mind the pagination */
        $posts = Post::paginate(5);
        /* return all the posts */
        // $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vocabulary_id = Vocabulary::whereName('posts')->get()->first()->id;
        $categories = Category::whereVocabularyId($vocabulary_id)->pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(PostsCreateRequest $request)
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();


        /**
        before the image checker was created
        **/
        // if($file = $request->file('photo_id')){
        //     $name = time() . $file->getClientOriginalName();
        //     $photo = Photo::create(['path'=>$name]);
        //     $file->move('images',$name);
        //     $input['photo_id'] = $photo->id;
        // }


        $input = $this->is_image_there($request,$input);
        $user->posts()->create($input);
        $request->session()->flash('created_post','The post has been created.');
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // 
        $post = Post::findBySlug($slug);
        $vocabulary_id = Vocabulary::whereName('posts')->get()->first()->id;
        $categories = Category::whereVocabularyId($vocabulary_id)->pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $slug)
    {
        //
        // if($request->photo_id == ""){
        //     $input = $request->except('photo_id');
        // }else{
        //     $input = $request->all();
        // }
        $input = $request->all();

        /**
        before the image checker was created
        **/
        // if($file = $request->file('photo_id')){
        //     $name = time() . $file->getClientOriginalName();
        //     $file->move('images',$name);
        //     $photo = Photo::create(['path'=>$name]);
        //     $input['photo_id'] = $photo->id;
        // }

        $input = $this->is_image_there($request,$input);
        Auth::user()->posts()->whereId($slug)->first()->update($input);
        $request->session()->flash('updated_post','The post has been updated.');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        /* commented out just for development purposes */
        // if(file_exists(public_path() . $post->photo->path)){
        //     unlink(public_path() . $post->photo->path);
        // }
        $post->photo()->delete();
        $post->delete();
        Session::flash('deleted_post','The Post has been deleted');
        return redirect('/admin/posts');
    }

    /**
     return the owner of the post 
    **/
    // public function post_owner($id){
    //     $post = Post::findOrFail($id);
    //     return $post->user->name;
    // }

}