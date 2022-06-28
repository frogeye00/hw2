<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LoginController extends BaseController{
    public function show(){

        if(Session::get('user_id'))
        {
            return redirect('homepage');
        }
        $error=Session::get('error');
        Session::forget('error');

        return view('login')->with('error',$error);
    }

    public function do_login(){
        
        if(Session::get('user_id'))
        {
            return redirect('homepage');
        }

        $searchField = filter_var(request('username'), FILTER_VALIDATE_EMAIL) ? "email" : "username";

        $user = User::where($searchField, request('username'))->first();


        if(!$user || !password_verify(request('password'), $user->password))
        {   
            Session::put('error', 'wrong');
            return redirect('login')->withInput();
        }

        Session::put('user_id', $user->id);
        // Redirect alla home
        return redirect('homepage');
    }

    public function logout() {
        Session::flush();
        return redirect('login');
    }

}


?>