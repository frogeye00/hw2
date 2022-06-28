<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\User;
use App\Models\Favorite;

class FavoritesController extends BaseController{
    
    public function show() {

        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        
        $user = User::find(Session::get('user_id'));

        return view('favorites')->with("username", $user->username);
       
    }

    public function remove_favorites(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $userid=Session::get('user_id');
        $title=request('title');

        if(DB::table('favorites')->where('title',$title)->where('user',$userid)->delete()){
            return json_encode(array('ok' => true));
        }
        else
            return json_encode(array('ok' => false));

    } 

    public function fetch_favorites() {
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $userid=Session::get('user_id');
        $res=Favorite::select('favorites.title as title','favorites.rating as rating')->where('user',$userid)->get();
        return $res;
    }

}