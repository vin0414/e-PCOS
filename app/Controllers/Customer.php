<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\App;

class Customer extends BaseController
{
    private $db;
    public function __construct()
    {
        helper('text');
        $this->db = db_connect();
    }

    public function Index()
    {
        return view('customer/index');
    }
}