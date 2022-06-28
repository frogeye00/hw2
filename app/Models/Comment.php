<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $table = 'comments';

    protected $fillable = [
        'user', 'post', 'text'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }

    public function post() {
        return $this->belongsTo("App\Models\Post");
    }

}

?>