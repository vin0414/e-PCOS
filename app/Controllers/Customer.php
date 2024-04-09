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
        $reservationModel = new \App\Models\reservationModel();
        $customerID = session()->get('sess_id');
        $reservation = $reservationModel->WHERE('customerID',$customerID)->findAll();
        $data = ['reservation'=>$reservation];
        return view('customer/consult',$data);
    }

    public function Profile()
    {
        return view('customer/account-setting');
    }

    public function updateInformation()
    {
        $customerModel = new \App\Models\customerModel();
        //data
        $userID = $this->request->getPost('userID');
        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');

        $validation = $this->validate([
            'fullname'=>'required',
            'email'=>'valid_email|required',
        ]);

        if(!$validation)
        {
            echo "Invalid! Please try again";
        }
        else
        {
            $values = ['EmailAddress'=>$email,'Fullname'=>$fullname];
            $customerModel->update($userID,$values);
            echo "success";
        }
    }

    //functions
    public function Save()
    {
        $reservationModel = new \App\Models\reservationModel();
        $customerID = session()->get('sess_id');
        $date = $this->request->getPost('date');
        $time = $this->request->getPost('time');
        $type_appointment = $this->request->getPost('type_appointment');
        $surname = $this->request->getPost('surname');
        $firstname = $this->request->getPost('firstname');
        $mi = $this->request->getPost('mi');
        $suffix = $this->request->getPost('suffix');
        $bdate  = $this->request->getPost('bdate');
        $phone = $this->request->getPost('phone');
        $gender = $this->request->getPost('gender');
        $address = $this->request->getPost('address');

        $validation = $this->validate([
            'date'=>'required',
            'time'=>'required',
            'type_appointment'=>'required',
            'surname'=>'required',
            'firstname'=>'required',
            'mi'=>'required',
            'bdate'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required'
        ]);

        if(!$validation)
        {
            echo "Fill in the fields to continue";
        }
        else
        {
            $values = ['Date'=>$date, 'Time'=>$time,'Event_Name'=>$type_appointment,
            'Surname'=>$surname,'Firstname'=>$firstname,'MiddleName'=>$mi,'Suffix'=>$suffix,
            'Contact'=>$phone,'BirthDate'=>$bdate,'Gender'=>$gender,
            'Address'=>$address,'Status'=>0,'customerID'=>$customerID];
            $reservationModel->save($values);
            echo "Success";
        }
    }

    public function cancelReservation()
    {
        $reservationModel = new \App\Models\reservationModel();
        //data
        $val = $this->request->getPost('value');
        $values = ['Status'=>2];
        $reservationModel->update($val,$values);
        echo "success";
    }

    public function getTime()
    {
        $date = $this->request->getGet('date');
        $list = array("08:00 AM","10:00 AM","12:00 PM","02:00 PM","04:00 PM");$lists = array();
        $numbers = array();
        $builder = $this->db->table('tblreservation');
        $builder->select('Time');
        $builder->WHERE('Date',$date)->WHERE('Status<>',2);
        $datas = $builder->get();
        foreach($datas->getResult() as $row)
        {
            array_push($numbers,$row->Time);
        }
        $lists = array_diff($list,$numbers);
        $Obj = json_decode(json_encode($lists));
        foreach($Obj as $object)
        {
            echo "<option>".$object."</option>";
        }
    }
}