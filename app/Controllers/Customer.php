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
        $user =  session()->get('sess_id');
        $builder = $this->db->table('tblreservation');
        $builder->select('COUNT(reservationID)total');
        $builder->WHERE('customerID',$user);
        $total = $builder->get()->getResult();
        //pending
        $builder = $this->db->table('tblreservation');
        $builder->select('COUNT(reservationID)total');
        $builder->WHERE('customerID',$user)->WHERE('Status',0);
        $pending = $builder->get()->getResult();
        //reserved
        $builder = $this->db->table('tblreservation');
        $builder->select('COUNT(reservationID)total');
        $builder->WHERE('customerID',$user)->WHERE('Status',1);
        $reserved = $builder->get()->getResult();
        //survey
        $builder = $this->db->table('tblcustomerinfo');
        $builder->select('COUNT(infoID)total');
        $builder->WHERE('customerID',$user);
        $survey = $builder->get()->getResult();
        $data = ['total'=>$total,'pending'=>$pending,'reserved'=>$reserved,'survey'=>$survey];
        return view('customer/index',$data);
    }

    public function History()
    {
        return view('customer/history');
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

    public function changePassword()
    {
        $customerModel = new \App\Models\customerModel();
        $userID = $this->request->getPost('userID');
        $new_pass = $this->request->getPost('new_password');
        $retype = $this->request->getPost('retype_password');

        $validation = $this->validate([
            'new_password'=>'required',
            'retype_password'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form to continue');
            return redirect()->to('admin/profile')->withInput();
        }
        else
        {
            if($new_pass!=$retype)
            {
                session()->setFlashdata('fail','Error! Password mismatched. Try again');
                return redirect()->to('customer/profile')->withInput();
            }
            else
            {
                $defaultPassword = Hash::make($new_pass);
                $values = ['Password'=>$defaultPassword,];
                $customerModel->update($userID,$values);
                session()->setFlashdata('success','Great! Password has successfully updated');
                return redirect()->to('customer/profile')->withInput();
            }
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

    public function resetPassword(){
        $emailAddress = $this->request->getPost('email');
        $table = $this->db->table('tblcustomer');
        $table->select('customerID, Fullname');
        $table->WHERE('EmailAddress', $emailAddress);
        $rows = $table->get();
        $data = $rows->getResult();
        
        if(empty($emailAddress)){
            session()->setFlashdata('fail','Invalid! Please enter your email address');
            return redirect()->to('/forgot-password')->withInput();
        }
        else{
            if(count($data) != 0)
            {
                //generate password
                // String of all alphanumeric character
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
             
                // Shuffle the $str_result and returns substring
                // of specified length
                $password = substr(str_shuffle($str_result),0,8);
                
                //send email
                if($row = $rows->getRow())
                {                   
                    $customerModel = new \App\Models\customerModel();
                    $values = ['Password'=>Hash::make($password),];
                    $customerModel->update($row->customerID,$values);
                
                    $email = \Config\Services::email();
                    $email->setTo($emailAddress,$row->Fullname);
                    $email->setFrom("pcos.system2024@gmail.com","PCOSPhil");
                    $template = "
                    <p>Dear " . $row->Fullname . ",</p>
                    <p>We hope this email finds you well. This message is to inform you that your password has been successfully reset. Your new password is: " . $password  . ".</p>
                    <p>For security purposes, we strongly advise you to change this password once you log in to our website. To do so, please follow these steps:</p>
                    <ol>
                    <li>Visit our website at <a href='https://pcos-system.online/'>https://pcos-system.online/</a>.</li>
                    <li>Log in to your account.</li>
                    <li>Navigate to the \"Account Settings\" section.</li>
                    <li>Enter your new password and confirm it.</li>
                    <li>Save the changes.</li>
                    </ol>
                    <p>If you did not request this password reset, or if you encounter any issues, please contact our team at pcos.system2024@gmail.com immediately.</p>
                    <p>Thank you for choosing our services. If you have any questions or need further assistance, feel free to reach out to us.</p>
                    <p>Best regards,</p>
                    <p>PCOSPhil Team</p>
                    ";
                    $subject = "Password Successfully Reset";
                    $email->setSubject($subject);
                    $email->setMessage($template);
                    $email->send();
                    session()->setFlashdata('success','Password Successfully reset. Please login');
                    return redirect()->to('/forgot-password')->withInput();
                }
            }
            else
            {
                session()->setFlashdata('fail','No Record(s) found');
                return redirect()->to('/forgot-password')->withInput();
            }
        
        }
    }
}