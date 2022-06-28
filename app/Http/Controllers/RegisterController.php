<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

class RegisterController extends BaseController
{
    public function show(){

        if(Session::get('user_id'))
        {
            return redirect('homepage');
        }
        
        return view('signup');
    }

    public function do_register(){
        
        if(Session::get('user_id'))
        {
            return redirect('homepage');
        }

        $request = request();

        if($this->countErrors($request) === 0) {
            $newUser =  User::create([
            'username' => $request['username'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email']
            ]);
            if ($newUser) {
                Session::put('user_id', $newUser->id);
                return redirect('homepage');
            } 
            else {
                return redirect('signup')->withInput();
            }
        }
        else 
            
            return redirect('signup')->withInput();
    }

    private function countErrors($data) {
        $error = array();
        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match("/^[a-zA-Z0-9_]{1,16}$/", $data['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (!preg_match("/^[A-Za-z0-9_!%&?]{8,20}$/",$_POST["password"])) {
            $error[] = "Caratteri password insufficienti";
        } 
        # CONFERMA PASSWORD
        if (strcmp($data["password"], $data["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = User::where('email', $data['email'])->first();
            if ($email !== null) {
                $error[] = "Email già utilizzata";
            }
        }

        return count($error);
    }

    public function checkUsername($query) {
        $exist = User::where('username', $query)->exists();
        return ['exists' => $exist];
    }

    public function checkEmail($query) {
        $exist = User::where('email', $query)->exists();
        return ['exists' => $exist];
    }


}
