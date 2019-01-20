<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //

	protected $fillable = ['name','category_id'];

    public function photos(){
    	return $this->hasMany('App\Photo');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
