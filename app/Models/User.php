<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'username',
        'nposts'
    ];

    protected $hidden = [
        'password'
    ];


    public function posts() {
        return $this->hasMany("App\Models\Post");
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function favorites() {
        return $this->hasMany("App\Models\Favorite");
    }

    public function likedPosts() {
        return $this->belongsToMany('App\Models\Post', 'likes','user','post');
    }

}
