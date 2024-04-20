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

        $builder = $this->db->table('tblcustomerinfo');
        $builder->select('COUNT(customerID)total');
        $builder->WHERE('Date>=',$fromdate)->WHERE('Date<=',$todate);
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

        $builder = $this->db->table('tblcustomerinfo');
        $builder->select('Location,COUNT(customerID)total');
        $builder->WHERE('Date>=',$fromdate)->WHERE('Date<=',$todate);
        $builder->groupBy('Location');
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

    public function ageChart()
    {
        $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');
        $dataPoints = array();
        $builder = $this->db->table("tblcustomerinfo");
        $builder->select('Age as label,COUNT(infoID)Total');
        $builder->WHERE('Date >=',$fromdate);
        $builder->WHERE('Date <=',$todate);
        $builder->groupby('Age');
        $data = $builder->get();
        foreach($data->getResult() as $row)
        {
            array_push($dataPoints, array("label"=> $row->label, "y"=> $row->Total));
        }
        echo json_encode($dataPoints,JSON_NUMERIC_CHECK);
    }


    public function answers()
    {
        $fromdate = $this->request->getGet('fromdate');
        $todate = $this->request->getGet('todate');

        $builder = $this->db->table('tblquestion a');
        $builder->select('a.Question,b.Details,COUNT(c.customerID)total');
        $builder->join('tblchoice b','b.questionID=a.questionID','LEFT');
        $builder->join('tblrecords c','c.choiceID=b.choiceID','LEFT');
        $builder->WHERE('c.Date >=',$fromdate);
        $builder->WHERE('c.Date <=',$todate);
        $builder->groupBy('b.choiceID');
        $data = $builder->get();
        ?>
        <table class="table-responsive table-bordered table-striped">
            <thead>
                <th class="bg-primary text-white">Question</th>
                <th class="bg-primary text-white">Answers</th>
                <th class="bg-primary text-white">Total</th>
            </thead>
            <tbody>
        <?php
        foreach($data->getResult() as $row)
        {
            ?>
            <tr>
                <td><?php echo $row->Question ?></td>
                <td><?php echo $row->Details ?></td>
                <td><?php echo $row->total ?></td>
            </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    }
}