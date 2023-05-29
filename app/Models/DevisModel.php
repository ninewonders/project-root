<?php

namespace App\Models;

use CodeIgniter\Model;

class DevisModel extends Model
{
   
    protected $table      = 'devis';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nom', 'desc','prix'];

    // Dates
    protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
    'nom' => 'required|alpha_numeric_space',
    'desc' => 'required',
    'prix' => 'required|decimal'
    ];
    protected $validationMessages   = [
      'nom' => [
        'required' => 'The name field is required',
        'alpha_numeric_space' => 'Invalid characters',
        'min_length' => 'At least 3 characters are required'
      ],
      'desc' => [
        'required' => 'The description field is required',
        'min_length' => 'At least 6 characters are required'
      ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}