<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];

   	//get the users through the specified role
   	public function user(){
   		return $this->hasMany('App\User');
   	}
}
