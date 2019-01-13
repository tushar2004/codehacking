<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentReply;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
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
        $replies = CommentReply::all();
        $posts = Post::all();
        return view('admin.comments.replies.index',compact('replies'));
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
    }

    public function createReply(Request $request)
    {
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'body' => $request->body,
            'photo' => ($user->photo) ? $user->photo->path : $this->uploads . $this->placeholder,
        ];
        CommentReply::create($data);
        $request->session()->flash('comment_reply_created','Your comment reply has been submitted and is waiting moderation.');
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
        $replies = Comment::findOrFail($id)->replies;
        return view('admin.comments.replies.show',compact('replies'));

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
        $comment_reply = CommentReply::findOrFail($id);
        $comment_reply->update($request->all());
        $status = $comment_reply->status();
        $request->session()->flash($status,'The comment reply has been ' . $status . '.');
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
        CommentReply::findOrFail($id)->delete();
        Session::flash('deleted_reply','The comment reply has been deleted.');
        return redirect()->back();
    }
}
