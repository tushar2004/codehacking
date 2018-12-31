<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    //get the user associated with the user
    public function user(){
    	return $this->belongsTo('App/User');
    }
}
