<?php

namespace App\Controllers;
use Config\App;

class Download extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function downloadFile()
    {
        
    }
}