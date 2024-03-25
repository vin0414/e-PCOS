<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\App;

class ManageController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function savePoll()
    {
        
    }
}