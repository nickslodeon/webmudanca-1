<?php

namespace App\Models;

use CodeIgniter\Model;

class proprietarioModel extends Model
{
    protected $table      = 'proprietario';
    protected $primaryKey = 'ID_proprietario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Nome',	'Email','Telefone'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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


    public function getIdProprietario ($nome,$email){

        
        $query = $this->db->table('proprietario')->select('ID_proprietario')->where('nome', $nome)->where('email', $email)->get();

        
        if($this->returnType == 'object'){
            return $query->getResult();
        }else{
            return $query->getResultArray();
        }

        return $query;

    }

    public function getProprietarios($nome,$email){

        $query = $this->db->table('proprietario')->where('nome', $nome)->where('email', $email)->get();

        if($this->returnType == 'object'){
            return $query->getResult();
        }else{
            return $query->getResultArray();
        }

        return $query->getResult();

    }
}