<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;
use App\Role;
use App\User;
use App\Photo;
use PDF;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $hello = "hello";

    public function index()
    {
        //
        /**
         Post::count()
            or
         **/
        $posts_count = Post::all()->count();
        $categories_count = Category::all()->count();
        $comments_count = Comment::all()->count();
        $roles_count = Role::all()->count();
        $users = User::all();
        $users_count = User::all()->count();
        $photos_count = Photo::all()->count();
        $approved_comments = Comment::where('is_active', 1)->count();
        $unapproved_comments = Comment::where('is_active', 0)->count();
       
        $user = User::whereId(1)->get()->first();

        /* to display the chart using a loop */
        // $counts = [
        //     'users_count' => $users_count,
        //     'posts_count' => $posts_count,
        //     'categories_count' => $categories_count,
        //     'comments_count' => $comments_count,
        //     'photos_count' => $photos_count,
        //     'roles_count' => $roles_count,
        //     'approved_comments' => $approved_comments,
        //     'unapproved_comments' => $unapproved_comments,
        // ];
        // return view('admin.index',compact('counts'));

        /**
            pdf generator
        **/
        // $view = \View::make('admin.index',compact('posts_count','categories_count','comments_count','roles_count','users_count','photos_count','approved_comments','unapproved_comments'));
        // $view = \View::make('admin.users.index',compact('users'));
        // $html = $view->render();



        // PDF::SetTitle('Hello World');
        // PDF::AddPage();

        // // set cell padding
        // PDF::setCellPaddings(1, 1, 1, 1);

        // // set cell margins
        // PDF::setCellMargins(1, 1, 1, 1);

        // // Multicell test
        // foreach($users as $user){
        //     PDF::MultiCell(55, 5,$user->name, 1, 'L', 0, 0, '', '', true, 0, false, true,0,'T');
        //     PDF::MultiCell(55, 5,$user->email, 1, 'L', 0, 1, '', '', true, 0, false, true,0, 'M');
        // }
        
        // // PDF::writeHtml($html,true,false,true,false,'');
        // // PDF::writeHTMLCell(100,4,'','',$html,'1',0,false,true,'',true);
        // PDF::Output('hello_world.pdf');



        return view('admin.index', compact('posts_count', 'categories_count', 'comments_count', 'roles_count', 'users_count', 'photos_count', 'approved_comments', 'unapproved_comments'));
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
    }
}
