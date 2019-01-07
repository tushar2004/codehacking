<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

	private $uploads = "/images/"; 
	private $placeholder_image = "200.png";

	protected $fillable = ['user_id','category_id','photo_id','title','body'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function photo(){
    	return $this->belongsTo('App\Photo');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function image_placeholder(){
    	return ($this->photo) ? $this->photo->path : $this->uploads . $this->placeholder_image;
    }
}
