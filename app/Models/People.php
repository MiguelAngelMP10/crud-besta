<?php

namespace App\Models;

use CodeIgniter\Model;

class People extends Model
{
    protected $table = 'people';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'last_name', 'middle_name', 'age', 'gender_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Relación con la tabla "gender"
    protected $belongsTo = [
        'gender' => [
            'model' => 'Gender',
            'foreign_key' => 'gender_id',
        ],
    ];

    public function callProcedureSaveOrUpdatePerson($id, $name, $last_name, $middle_name, $age, $gender_id)
    {
        // Llamada al procedimiento almacenado
        $procedureCall = "CALL sp_SaveOrUpdatePerson(?, ?, ?, ?, ?, ?)";
        $params = [$id, $name, $last_name, $middle_name, $age, $gender_id];
        $this->db->query($procedureCall, $params);
    }
}
