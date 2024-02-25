<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\App;

class Customer extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function Index()
    {
        return view('customer/index');
    }

    public function takeATest()
    {
        return view('customer/take-a-test');
    }

    public function Consultation()
    {
        return view('customer/consult');
    }

    public function Profile()
    {
        return view('customer/account-setting');
    }

    //functions
    public function Save()
    {
        
    }
}