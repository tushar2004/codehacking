<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    //
	protected $fillable = ['name'];

	public function categories(){
		return $this->hasMany('App\Category');
	}
}
