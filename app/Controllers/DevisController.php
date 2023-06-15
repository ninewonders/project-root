<?php

namespace App\Controllers;

use App\Models\DevisModel;
use App\Models\ServeurModel;
use App\Models\ServiceModel;
use config\services;
use App\Models\SpecificationModel;
use CodeIgniter\RESTful\ResourceController;

/**
* @filter auth
* */


    
class DevisController extends BaseController
{
    
    public $service;
    public $devis;
    public $serveur;
    public $spec;
    public $session;
     
    public function __construct(){
        $this->service = new ServiceModel();
        $this->devis = new DevisModel();
        $this->serveur = new ServeurModel();
        $this->spec = new SpecificationModel();
        $this->session = \Config\Services::session();
    }

    /**
* @filter auth
* */

    public function index(){
        $data['devis'] = $this->devis->findall();
        return view('devis/devis',$data);
    }

    public function add(){
        $data['services'] = $this->service->findall();

        if (count($data['services']) == 0) {
            $this->session->setFlashdata('warning', 'Pas de services dans la base des donnees!'); 
            $data['devis'] = $this->devis->findall();
            return view('devis/devis', $data);
        }
        return view('devis/additem', $data);
    }

    public function update($id){
        $devis = $this->devis->find($id);
        $servers = $this->serveur->where('id_devis',$devis['id'])->findAll();
        $serveur =[];
        foreach($servers as $server){
            $obj = [
                'serveur' => $server,
                'specifications' => $this->spec->where('id_serveur',$server['id'])->findAll()
            ];
            array_push($serveur,$obj);
        }
        $data['devis'] = $devis;
        $data['serveurs']= $serveur;
        $data['services'] = $this->service->findAll();
        $data['services_deleted'] = $this->service->withDeleted()->findAll();
        return view('devis/update',$data);
    }

    public function insert(){
        $data = $this->request->getJSON();
    
        // Get the data from the JSON object
        $devisData = $data->devisData;
        $serverData = $data->serverData;
        
        // Create a new Devis model instance and insert the data
        $this->devis->insert($devisData);

        // Loop through the server data and insert it for each server
        foreach ($serverData as $server) {
            // Create a new Server model instance and insert the data

            $data = [
                'id_devis' => $this->devis->getInsertID(), 
                'prix' => $server->prix
            ];
            $this->serveur->insert($data);

            // Loop through the specs data and insert it for each spec
            foreach ($server->specs as $spec) {
                // Create a new Spec model instance and insert the data
                $data = [
                    'id_serveur' => $this->serveur->getInsertID(),
                    'id_service' => $spec->id_service, 
                    'quantite' => $spec->quantite, 
                    'prix_unitaire' => $spec->prix_unitaire,
                    'prix' => $spec->prix, 
                
                ];
                $this->spec->insert($data);
            }
        }
        return $this->response->setJSON([
            'msg' => 'Devis Created Successfully'
        ]);
    }

    public function select($id){
        $devis = $this->devis->find($id);
        $servers = $this->serveur->where('id_devis',$devis['id'])->findAll();
        $serveur =[];
        foreach($servers as $server){
            $obj = [
                'serveur' => $server,
                'specifications' => $this->spec->where('id_serveur',$server['id'])->findAll()
            ];
            array_push($serveur,$obj);
        }

        return $this->response->setJSON([
            'devis' => $devis,
            'serveurs' => $serveur
        ],);
    }

    public function delete($id){
        $servers = $this->serveur->where('id_devis', $id)->findAll();
        foreach ($servers as $server) {
            $specs = $this->spec->where('id_serveur', $server['id'])->findAll();
            foreach ($specs as $spec) {
                $this->spec->delete($spec['id']);
            }
            $this->serveur->delete($server['id']);
        }

        $this->devis->delete($id,true);
        return $this->response->setJSON([
            'msg' => 'Devis deleted Successfully'
        ]);
    }

    public function modify($id){
        // $this->devis->where('id', $id)->forceDelete();
         $data = $this->request->getJSON();
    
        // Get the data from the JSON object
        $devisData = $data->devisData;
        $serverData = $data->serverData;
        // Create a new Devis model instance and insert the data

        if($this->devis->where('id', $id)->first()){
            $this->devis->update($id,$devisData);

            $servers = $this->serveur->where('id_devis', $id)->findAll();

            foreach ($servers as $server) {
                $this->serveur->delete($server['id'],true);
            }

            foreach ($serverData as $server) {
                // Create a new Server model instance and insert the data
                $data = [
                    'id_devis' => $id,
                    'prix' => $server->prix
                ];
                $this->serveur->insert($data);

                // Loop through the specs data and insert it for each spec
                foreach ($server->specs as $spec) {
                    // Create a new Spec model instance and insert the data
                    $specModel = new SpecificationModel();
                    $data = [
                        'id_serveur' => $this->serveur->getInsertID(),
                        'id_service' => $spec->id_service, 
                        'quantite' => $spec->quantite, 
                        'prix_unitaire' => $spec->prix_unitaire,
                        'prix' => $spec->prix, 
                    
                    ];
                    $specModel->insert($data);
                }
            }
        
            return $this->response->setJson([
                'msg' => 'Devis Updated'
            ]);
        }else{
            return $this->response->setJson([
                'msg' => 'nom deja existe!'
            ]);
        }
    }

}

    