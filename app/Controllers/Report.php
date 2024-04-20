<?php

namespace App\Controllers;
use Config\App;

class Report extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function generateReport()
    {
        $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');

        $builder = $this->db->table('tblrecords');
        $builder->select('COUNT(recordID)total');
        $builder->WHERE('Date>=',$fromdate)->WHERE('Date<=',$todate);
        $data = $builder->get();
        if($row = $data->getRow())
        {
            echo $row->total;
        }
    }

    public function generateLocation()
    {
        
    }
}