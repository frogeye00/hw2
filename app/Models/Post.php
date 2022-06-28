<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = 'posts';

    protected $fillable = [
        'user', 'title', 'content'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }

    public function likes() {
        return $this->belongsToMany('App\Models\User', 'likes','post','user');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}


?>