<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Post;
use App\Models\User;
use App\Models\Favorite;

class SearchController extends BaseController{
    
    public function show() {

        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        
        $user = User::find(Session::get('user_id'));

        return view('search')->with("username", $user->username);
       
    }

    public function search($title){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $api_key=env('API_KEY');
        $curl = curl_init();
        curl_setopt($curl , CURLOPT_URL,"https://imdb-api.com/en/API/SearchMovie/".$api_key."/".$title);
        curl_setopt($curl , CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($curl);
        curl_close($curl);
    
        
        $result_json=json_decode($result,true);
        if($result_json['results']===null){
            print_r("massimo numero di richieste api giornaliere raggiunte");
            exit;
        }
    
        $final_json=array();
        
        $film_id=$result_json['results'][0]['id'];
        $curl = curl_init();
        curl_setopt($curl , CURLOPT_URL,"https://imdb-api.com/en/API/Ratings/".$api_key."/".$film_id);
        curl_setopt($curl , CURLOPT_RETURNTRANSFER,1);
        $result1 = curl_exec($curl);
        curl_close($curl);
    
        $result_json1=json_decode($result1,true);
    
    
        $final_json[]=array('title'=>$result_json['results'][0]['title']."".$result_json['results'][0]['description'],
        'image'=>$result_json['results'][0]['image'],'rating'=>$result_json1['imDb']);
    
        return json_encode($final_json);

    }

    public function add_favorites(){
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $userid=Session::get('user_id');
        $title=request('title');
        $rating=request('rating');

        $favorite=new Favorite;
        $favorite->title=$title;
        $favorite->rating=$rating;
        $favorite->user=$userid;
        if($favorite->save()){
            return json_encode(array('ok' => true));
        }
        else
            return json_encode(array('ok' => false));

    } 

}