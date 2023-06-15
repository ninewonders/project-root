<?php

namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Models\TokenModel;


class UtilisateurController extends BaseController
{

    public $utilisateur;
    public $token;
    
    public function __construct()
    {
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
            'name' => $user['nom'],
            'email' => $user['email'],
            'password' => $user['motdepass']
        ]);
        
        return $this->response->setJSON([
            'message' => 'Authentication successful',
        ]);
    }

    public function profile()
    {
        $data['utilisateurs'] = $this->utilisateur->findall();

        
        // Remove element with a specific id
        $data['utilisateurs'] = array_filter($data['utilisateurs'], function($utilisateur) {
            return $utilisateur['id'] != 1;
        });
        
        return view('user/profile',$data);
    }

    public function insert_util()
    {
        $data = $this->request->getJSON();


        $this->utilisateur->insert([
            'nom' => $data->name,
            'email' => $data->email,
            'motdepass' => password_hash($data->password, PASSWORD_DEFAULT)
        ]);

        return $this->response->setJSON([
            'message' => 'Utilisateur Created Successfully'
        ]);
    }

    public function store()
    {
        $data = $this->request->getJSON();
        $user = $this->utilisateur->where('id',$data->user_id)->first();
        
        if(!password_verify($data->opass,$user['motdepass'])){
              return $this->response->setJSON([
                'error' => "Invalid password",
            ]);  
        }
        $this->utilisateur->save([
            'id' => $data->user_id,
            'nom' => $data->nom,
            'email' => $data->mail,
            'motdepass' => password_hash($data->npass, PASSWORD_DEFAULT)
        ]);
        
        return $this->response->setJSON([
            'msg' => 'Utilisateur Updated Successfully'
        ]);
    }

    public function update()
    {
        $data = $this->request->getJSON();

        $this->utilisateur->save([
            'id' => $data->id,
            'nom' => $data->name,
            'email' => $data->email,
            'motdepass' => password_hash($data->password, PASSWORD_DEFAULT)
        ]);
        
        return $this->response->setJSON([
            'msg' => 'Utilisateur Updated Successfully'
        ]);
    }

    public function delete($id)
    {
        $this->utilisateur->delete($id);
        return $this->response->setJSON([
            'msg' => 'User Deleted Successfully'
        ]);
    }
}