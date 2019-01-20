<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Vocabulary;
use App\Category;

class AdminVocabulariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vocabularies = Vocabulary::all();
        return view('admin.vocabularies.index',compact('vocabularies'));
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
        //;
        Vocabulary::create($request->all());
        $request->session()->flash('vocabulary_created','The vocabulary has been created.');
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
        $categories = Vocabulary::findOrFail($id)->categories;
        return view('admin.vocabularies.show',compact('categories','id'));
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
        $vocabulary = Vocabulary::findOrFail($id);
        return view('admin.vocabularies.edit',compact('vocabulary'));
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
        $vocabulary = Vocabulary::findOrFail($id);
        $vocabulary->update($request->all());
        $request->session()->flash('vocabulary_updated','The vocabulary has been updated.');
        return redirect('/admin/taxonomy');
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
        $vocabulary = Vocabulary::findOrFail($id);
        $vocabulary->delete();
        Session::flash('vocabulary_deleted','The vocabulary has been deleted.');
        return redirect('/admin/taxonomy');
    }
}
