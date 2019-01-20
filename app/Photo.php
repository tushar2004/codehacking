<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

	private $uploads = "/images/";
	private $placeholder = "200.png";

	protected $fillable = ['path','gallery_id'];


	/* get the photo associated with the user using an accessor */
	public function getPathAttribute($photo){
		return $this->uploads . $photo;
	}


	/* get the post associated with the photo */
	public function post(){
		return $this->hasOne('App\Post');
	}

	public function image_placeholder(){
		/**
		was useful for debugging purposes
		**/
		// return ($this->path == "") ? "This path is empty" : "There is a path defined in the database.";
		// return (!file_exists(public_path() . $this->uploads . $this->path) ? "File not exists" : "File exists");
		
		if($this->path == "" || !file_exists(public_path() . $this->path)){
			return $this->uploads . $this->placeholder;					
		}else{
			return $this->path;
		}
	}

	public function gallery(){
		return $this->belongsTo('App\Gallery');
	}

    // //get the user associated with the photo
    // public function user(){
    // 	return $this->belongsTo('App/User');
    // }
}
