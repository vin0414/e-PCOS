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
        $builder = $this->db->table('tblsurvey');
        $builder->select('surveyID');
        $builder->WHERE('Status',1);;
        $survey = $builder->get()->getResult();

        $data = ['survey'=>$survey];

        return view('customer/take-a-test',$data);
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

    public function saveRecord()
    {
        $recordModel = new \App\Models\recordsModel();
        $customerInfoModel = new \App\Models\customerInfoModel();
        //data
        $customerID = $this->request->getPost('customer');
        $location = $this->request->getPost('location');
        $age = $this->request->getPost('age');
        $survey = $this->request->getPost('survey');
        $question1 = $this->request->getPost('question1');
        $answer1 = $this->request->getPost('answer1');

        $question2 = $this->request->getPost('question2');
        $answer2 = $this->request->getPost('answer2');

        $question3 = $this->request->getPost('question3');
        $answer3 = $this->request->getPost('answer3');

        $question4 = $this->request->getPost('question4');
        $answer4 = $this->request->getPost('answer4');

        $question5 = $this->request->getPost('question5');
        $answer5 = $this->request->getPost('answer5');

        $question6 = $this->request->getPost('question6');
        $answer6 = $this->request->getPost('answer6');

        $question7 = $this->request->getPost('question7');
        $answer7 = $this->request->getPost('answer7');

        $question8 = $this->request->getPost('question8');
        $answer8 = $this->request->getPost('answer8');

        $question9 = $this->request->getPost('question9');
        $answer9 = $this->request->getPost('answer9');

        $question10 = $this->request->getPost('question10');
        $answer10 = $this->request->getPost('answer10');
        $date = date('Y-m-d');

        $builder = $this->db->table('tblcustomerinfo');
        $builder->select('customerID');
        $builder->WHERE('customerID',$customerID)->WHERE('Date',$date);
        $data = $builder->get();
        if($row = $data->getRow())
        {
            echo "Invalid! You've already taken the survey. Please try again tomorrow";
        }
        else
        {
            if(empty($answer1)&&empty($answer2)&&empty($answer3)&&empty($answer4)&&empty($answer5)
            &&empty($answer6)&&empty($answer7)&&empty($answer8)&&empty($answer9)&&empty($answer10))
            {
                echo "Invalid! Please select your answer";
            }
            else
            {

                $values = ['customerID'=>$customerID, 'Age'=>$age,'Location'=>$location,'Date'=>date('Y-m-d')];
                $customerInfoModel->save($values);
                if(empty($answer1))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question1,'choiceID'=>$answer1,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer2))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question2,'choiceID'=>$answer2,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer3))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question3,'choiceID'=>$answer3,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer4))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question4,'choiceID'=>$answer4,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer5))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question5,'choiceID'=>$answer5,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer6))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question6,'choiceID'=>$answer6,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer7))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question7,'choiceID'=>$answer7,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer8))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question8,'choiceID'=>$answer8,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer9))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question9,'choiceID'=>$answer9,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                if(empty($answer10))
                {
                    //do nothing
                }
                else
                {
                    $values = ['customerID'=>$customerID, 'questionID'=>$question10,'choiceID'=>$answer10,'surveyID'=>$survey,'Date'=>date('Y-m-d')];
                    $recordModel->save($values);
                }
                echo "success";
            }
        }
    }
}