<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

	protected $uploads = "/images/";

	protected $fillable = ['path'];


	/* get the photo associated with the user using an accessor */
	public function getPathAttribute($photo){
		return $this->uploads . $photo;
	}


    // //get the user associated with the photo
    // public function user(){
    // 	return $this->belongsTo('App/User');
    // }
}
