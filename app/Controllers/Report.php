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
        $builder->select('COUNT(DISTINCT customerID)total');
        $builder->WHERE('Date>=',$fromdate)->WHERE('Date<=',$todate);
        $builder->groupBy('customerID');
        $data = $builder->get();
        if($row = $data->getRow())
        {
            echo $row->total;
        }
    }

    public function generateLocation()
    {
        $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');

        $builder = $this->db->table('tblrecords');
        $builder->select('Location,COUNT(DISTINCT customerID)total');
        $builder->WHERE('Date>=',$fromdate)->WHERE('Date<=',$todate);
        $builder->groupBy('Location')->groupBy('customerID');
        $data = $builder->get();
        foreach($data->getResult() as $row)
        {
            ?>
            <tr>
                <td><?php echo $row->Location ?></td>
                <td><?php echo $row->total ?></td>
            </tr>
            <?php
        }
    }
}