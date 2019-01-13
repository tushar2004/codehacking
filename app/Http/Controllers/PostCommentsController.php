<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostCommentsController extends Controller
{
    
    private $uploads = "/images/";
    private $image_placeholder = "200.png";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::all();
        return view('admin.comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => ($user->photo) ? $user->photo->path : $this->uploads . $this->image_placeholder,
            'body' => $request->body
        ];
        // print_r($data);
        Comment::create($data);
        $request->session()->flash('comment_message','Your comment has been submitted and is waiting moderation.');
        return redirect()->back();
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
        $comments = Post::findOrFail($id)->comments;
        return view('admin.comments.show',compact('comments'));
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
        $comment_status = $request->is_active == 0 ? "unapproved" : "approved";
        $comment = Comment::findOrFail($id)->update($request->all());
        $request->session()->flash($comment_status,"The comment has been " . $comment_status . ".");
        return redirect()->back();
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
        $comment = Comment::findOrFail($id)->delete();
        Session::flash('deleted_comment','The comment has been deleted.');
        return redirect('/admin/comments');
    }

    /* My way of approving and unapproving comments (Though I know that it is an unsecure way) */

    // public function approve($id){
    //     $comment = Comment::findOrFail($id);
    //     $comment->is_active = 1;
    //     $comment->save();
    //     return redirect('/admin/comments');
    // }

    // public function unapprove($id){
    //     $comment = Comment::findOrFail($id);
    //     $comment->is_active = 0;
    //     $comment->save();
    //     return redirect('/admin/comments');
    // }
}
