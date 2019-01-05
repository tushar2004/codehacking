<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    private $directory = "/images/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id'
    ];

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

    public function photo_with_custom_path(){
        $path = $this->photo->path;
        return $new_path = $this->directory . $path;
    }
}
