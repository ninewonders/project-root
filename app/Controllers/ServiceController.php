<?php

namespace App\Controllers;
use App\Models\ServiceModel;

class ServiceController extends BaseController
{

    public $service;
    public $devis;
    
    public function __construct(){
        $this->service = new ServiceModel();
    }

    public function index()
    {
        $service = new ServiceModel();
        $data['services'] = $service->findall();
        
        return view('service/service', $data);
    }

    public function select_all()
    {
        $service = new ServiceModel();
        $services = $service->withDeleted()->findall();
        
        return $this->response->setJSON([
             $services
        ]);
    }

    public function insert_service(){
        $data = $this->request->getJSON();
        $this->service->insert($data);
        return $this->response->setJSON([
            'message' => 'Service Created Successfully'
        ]);
    }

    public function delete($id){
        $this->service->delete($id);
        return $this->response->setJSON([
            'msg' => 'Service Deleted Successfully'
        ]);
    }

    public function store(){
        $data = $this->request->getJSON();
        $this->service->save($data);
        return $this->response->setJSON([
            'msg' => 'Service Updated Successfully'
        ]);
    }

    
}