<?php

namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Models\TokenModel;


class UtilisateurController extends BaseController
{

    public $utilisateur;
    public $token;
    
    public function __construct(){
        $this->utilisateur = new UtilisateurModel();
        $this->token = new TokenModel();
    }

    
    public function index()
    {
        session()->destroy();
        session()->start();
        return view('user/login');
    }

    public function login()
    {
        $data = $this->request->getJSON();
       
        // Authenticate the user
        $user = $this->utilisateur->where('email', $data->email)->first();
    
        if (!$user ) {
            return $this->response->setJSON([
                'error' => "Email doesn't exist",
            ]);
        }
        
        if(!password_verify($data->password,$user['motdepass'])){
              return $this->response->setJSON([
                'error' => "Invalid password",
            ]);  
        }


        session()->start();
        
        session()->set('user', [
            'user_id' => $user['id'],
            'email' => $user['email'],
            'password' => $user['motdepass']
        ]);
        
        return $this->response->setJSON([
            'message' => 'Authentication successful',
        ]);
    }
}