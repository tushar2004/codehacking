<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Photo;

class AdminMediasController extends Controller
{
    //
    public function index()
    {
    	$photos = Photo::all();
    	return view('admin.media.index',compact('photos'));
    }

    public function create(){
    	return view('admin.media.create');
    }

    public function store(Request $request){
    	$file = $request->file('file');
    	$name = time() . $file->getClientOriginalName();
    	$file->move('images',$name);
    	Session::flash('uploaded_media','The Photo(s) have been uploaded.');
    	$photo = Photo::create(['path'=>$name]);
    }

    public function destroy($id){
    	$photo = Photo::findOrFail($id);
    	unlink(public_path() . $photo->path);
    	$photo->delete();
    	Session::flash('deleted_media','The Photo has been deleted.');
    }

    public function deleteMedia(Request $request){
        if(isset($request->delete_bulk) && !empty($request->checkBoxArray)){
            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){
                $photo->delete();
                /* delete the photos from the images directory */
                unlink(public_path() . $photo->path);
            }
            Session::flash('deleted_media','The Photo(s) have been deleted.');
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }


}
