<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

        $input = $request->all();
        // return $input;
        if($file = $request->file('file')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);

        return redirect('/admin/users');




        // /* move the uploaded file to the images directory */
        // // return $request->all();
        // $file = $request->file('file');
        // $filename = $file->getClientOriginalName();
        // $file->move('images',$filename);

        // User::create($request->all());

        // $user = User::findOrFail($request->id);
        // $user->photos()->create(['path'=>$filename]);
        // return redirect('admin.users.index');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    /**
    Check if the password is there in the request or not.
    If it is not there, then set the database password to be updated and if it is then encrypt it and then set it to be updated.

    Got it working!!!, :)

    **/
    // public function password_present_or_not($request,$user){
    //     return ($request->password == "") ? $user->password : bcrypt($request->password);
    // }


    public function update(UsersEditRequest $request, $id)
    {
        //
        /* constituent of my own method */
        // $input = $request->all();
        $user = User::findOrFail($id);

    /*
        Done with my own way
    */
        // $input['password'] = ($request->password == "") ? $user->password : bcrypt($request->password);
        // $input['password'] = $this->password_present_or_not($request,$user);



    /*
        Edwin's way
    */
        if(trim($request->password) == ""){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('file')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = new Photo();
            $photo->path = $name;
            $photo->save();
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect('/admin/users');
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
