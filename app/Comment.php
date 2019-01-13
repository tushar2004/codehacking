<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //


	protected $fillable = ['post_id','is_active','author','email','body','photo'];

    public function post(){
    	return $this->belongsTo('App\Post');
    }

    public function replies(){
    	return $this->hasMany('App\CommentReply');
    }

    public function status(){
    	return $this->is_active == 0 ? "Unapproved" : "Approved"; 
    }

}