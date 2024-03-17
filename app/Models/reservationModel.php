<?php

namespace App\Models;

use CodeIgniter\Model;

class reservationModel extends Model
{
    protected $table      = 'tblreservation';
    protected $primaryKey = 'reservationID';

    protected $useAutoIncrement  = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $userSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = ['Date', 'Time','Event_Name','Surname','Firstname','MiddleName','Contact','BirthDate','Gender','Address','Status','customerID'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    
    
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}