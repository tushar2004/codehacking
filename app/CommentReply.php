<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //

	protected $fillable = ['comment_id','author','email','body','is_active','photo'];

    public function comment(){
    	return $this->belongsTo('App\Comment');
    }

    /* return the status of the reply in a human readable manner */
    public function status(){
    	return $this->is_active == 0 ? "Unapproved" : "Approved";
    }


}
