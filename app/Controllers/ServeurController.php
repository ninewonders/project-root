<?php

namespace App\Controllers;
use App\Models\ServeurModel;

class ServeurController extends BaseController
{
    public function insert_serveur()
    {
        try {
            $data = $this->request->getJSON();
            
            $Serveur = new ServeurModel();
            $Serveur->insert($data);
            return $this->response->setJSON([
                'id' => $Serveur->getInsertID(),
            ]);
        } catch (\Exception $e) {
            // handle the exception here
            return $this->response->setJSON([
                'error' => $e->getMessage(),
            ])->setStatusCode(201);
        }
    }
}