<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id'
    ];

    /* The images directory attribute */
    protected $uploads = "/images/";

    /* The placeholder image attribute */
    protected $placeholder = "200.png";


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //get the roles of the user
    public function role(){
        return $this->belongsTo('App\Role');
    }

    //get the photo associated with the user
    public function photo(){
        return $this->belongsTo('App\Photo');
    }


    /* if the user has a photo then return it else set and return a placeholder image */
    public function image_placeholder(){
        return ($this->photo != "") ? $this->photo->path : $this->uploads . $this->placeholder;
        /* ternary statement for displaying the photo for the user */
        // {{$user->photo ? $user->photo->path : 'https://via.placeholder.com/150?text=Dummy+Photo'}}
    }


    /**
    Determine, the user is an administrator or not.
    **/
    public function isAdmin(){
        // return ($this->role->name == "administrator" && $this->is_active == 1) ? true : false;
        if($this->role->name == "administrator" && $this->is_active == 1){
            return true;
        }else{
            return false;
        }
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }


    // /**
    // Determine, the user is active or not.
    // **/
    // public function isActive(){
    //     return ($this->is_active == 1) ? true : false;
    // }


    /**
    custom function to retrieve the photo path manipulated with the directory path
    **/
    // public function photo_with_custom_path(){
    //     $path = $this->photo->path;
    //     return $new_path = $this->directory . $path;
    // }
}
