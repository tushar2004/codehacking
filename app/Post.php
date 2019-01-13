<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


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

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function image_placeholder(){
    	return ($this->photo == "" || !file_exists(public_path() . $this->photo->path)) ? $this->uploads . $this->placeholder_image : $this->photo->path ;
    }
}
