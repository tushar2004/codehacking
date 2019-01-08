<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;

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
        $posts = Post::all();
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
        $categories = Category::pluck('name','id')->all();
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
    public function edit($id)
    {
        // 
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
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
        Auth::user()->posts()->whereId($id)->first()->update($input);
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
        unlink(public_path() . $post->photo->path);
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
