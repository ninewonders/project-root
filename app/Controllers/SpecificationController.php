<?php

namespace App\Controllers;
use App\Models\SpecificationModel;

class SpecificationController extends BaseController
{
    
    public function insert_spec()
    {
        try {
            $data = $this->request->getJSON();
            $Specification = new SpecificationModel();
            $Specification->insert($data);
            return $this->response->setJSON([
                'message' => 'Specification created successfully',
            ]);
        } catch (\Exception $e) {
            // handle the exception here
            return $this->response->setJSON([
                'error' => $e->getMessage(),
            ])->setStatusCode(201);
        }
    }
}