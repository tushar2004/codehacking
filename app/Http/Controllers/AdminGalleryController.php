<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Gallery;
use App\Vocabulary;
use App\Category;
use App\Photo;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galleries = Gallery::all();
        $vocabulary_id = Vocabulary::whereName('gallery')->get()->first()->id;
        $categories = Category::whereVocabularyId($vocabulary_id)->pluck('name','id')->all();
        return view('admin.gallery.index',compact('galleries','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $vocabulary_id = Vocabulary::whereName('gallery')->get()->first()->id;
        $categories = Category::whereVocabularyId($vocabulary_id)->pluck('name','id')->all();
        return view('admin.gallery.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = Gallery::create($request->all());
        // if($file = $request->file('image')){
            // $name = time() . $file->getClientOriginalName();
            // $data_for_photo = [
            //     'path' => $name,
            //     'gallery_id' => $gallery->id
            // ];
            // $photo = Photo::create($data_for_photo);
            // // $file->move('images',$name);
        // }
        
        $request->session()->flash('gallery_created','The gallery has been created.');
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
        $photos = Gallery::findOrFail($id)->photos;
        return view('/admin/gallery/show',compact('photos'));
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
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        Session::flash('gallery_deleted','The gallery has been deleted.');
        return redirect()->back();
    }

    public function upload(Request $request){
        if($file = $request->file('file')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $data = [
                'path' => $name,
                'gallery_id' => $request->gallery_id
            ];
            $photo = Photo::create($data);
            $request->session()->flash('gallery_photos_uploaded','The photos have been uploaded to the gallery');
            return redirect('/admin/gallery');
        }
    }

    public function upload_photos($gallery_id){
        $gallery = Gallery::findOrFail($gallery_id);
        return view('admin.gallery.upload',compact('gallery'));
    }

    public function galleries(){
        $galleries = Gallery::all();
        return view('admin/gallery/galleries',compact('galleries'));
    }

    // public function create_gallery(Request $gallery){
    //     Gallery::create($gallery->all());
    //     $gallery->session()->flash('gallery_created','The gallery has been created.');
    //     return redirect()->back();
    // }

    // <!-- 
    // {{Form::open(['method'=>'POST','action'=>'AdminGalleryController@store','files'=>true,'class'=>'dropzone'])}}
    // {{Form::close()}} -->
}
