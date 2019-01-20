<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name','vocabulary_id'];

    public function posts(){
    	return $this->hasMany('App\Post');
    }

    public function gallery(){
    	return $this->hasOne('App\Gallery');
    }

    public function vocabulary(){
    	return $this->belongsTo('App\Vocabulary');
    }
}
