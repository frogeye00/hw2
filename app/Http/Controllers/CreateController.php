<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Post;
use App\Models\User;

class CreateController extends BaseController{
    
    public function show() {

        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        
        $user = User::find(Session::get('user_id'));

        return view('create')->with("username", $user->username);
       
        
    }

    public function insert_post(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $userid=Session::get('user_id');

        $post= new Post;

        $post->user=$userid;
        $post->title=request('title');
        $post->content=request('content');

        if($post->save()){
            return json_encode(array('ok' => true));
        }
        else
            return json_encode(array('ok' => false));
    }
}