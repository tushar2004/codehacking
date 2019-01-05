<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

	protected $fillable = ['path'];

    // //get the user associated with the photo
    // public function user(){
    // 	return $this->belongsTo('App/User');
    // }
}
