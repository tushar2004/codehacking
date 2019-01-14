<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(5);

        /* if want to display categories as we increment the posts page */
        // $categories = Category::paginate(8);

        $categories = Category::all();
        return view('front.home',compact('posts','categories'));
    }


    public function post($slug){
        $post = Post::findBySlugOrFail($slug);
        $categories = Category::all();
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post',compact('post','categories','comments'));
    }

    /**
    custom method for displaying the comments for specific post
    **/
    // public function post_comments($id){
    //     // return "it's working";
    //     $comments = Post::findOrFail($id)->comments;
    //     return view('admin.posts.comments',compact('comments'));
    // }

}
