<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\App;

class Home extends BaseController
{
    private $db;
    public function __construct()
    {
        helper('text');
        $this->db = db_connect();
    } 

    public function sendInquiry()
    {
        $inquiryModel = new \App\Models\inquiryModel();
        //data
        $dateTime = date('Y-m-d h:i:s a');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        $validation = $this->validate([
            'name'=>'required',
            'email'=>'required|valid_email',
            'subject'=>'required',
            'message'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the fields and enter valid email address');
            return redirect()->to('/')->withInput();
        }
        else
        {
            $values = ['DateTime'=>$dateTime,'Name'=>$name, 'Email'=>$email,'Subject'=>$subject,'Message'=>$message,'Status'=>0];
            $inquiryModel->save($values);
            session()->setFlashdata('success','Great! Successfully sent your message');
            return redirect()->to('/')->withInput();
        }
    }

    public function readBlog($id)
    {
        $builder = $this->db->table('tblblogs a');
        $builder->select('a.*,b.Fullname');
        $builder->join('tblaccount b','b.accountID=a.accountID','LEFT');
        $builder->WHERE('a.Title',$id)->limit(1);
        $blog = $builder->get()->getResult();
        $data = ['blog'=>$blog,'id'=>$id];
        return view('read-blog',$data);
    }

    public function index()
    {
        //doctors
        $doctorsModel = new \App\Models\doctorsModel();
        $doctors = $doctorsModel->findAll();
        //blogs
        $builder = $this->db->table('tblblogs a');
        $builder->select('a.*,b.Fullname');
        $builder->join('tblaccount b','b.accountID=a.accountID','LEFT');
        $blog  = $builder->get()->getResult();

        $data = ['doctors'=>$doctors,'blog'=>$blog];
        return view('welcome_message',$data);
    }

    //admin
    public function Auth()
    {
        return view('auth');
    }

    public function check()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $validation = $this->validate([
            'email'=>'required|valid_email',
            'password'=>'min_length[8]|max_length[12]'
        ]);
        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid Username or Password!');
            return redirect()->to('/auth')->withInput();
        }
        else
        {
            $builder = $this->db->table('tblaccount');
            $builder->select('*');
            $builder->WHERE('EmailAddress',$email)->WHERE('Status',1);
            $data = $builder->get();
            if($row = $data->getRow())
            {
                $check_password = Hash::check($password, $row->Password);
                if(empty($check_password) || !$check_password)
                {
                    session()->setFlashdata('fail','Invalid username or password');
                    return redirect()->to('/auth')->withInput();
                }
                else
                {
                    session()->set('loggedUser', $row->accountID);
                    session()->set('sess_fullname', $row->Fullname);
                    session()->set('sess_role',$row->Role);
                    //save the logs
                    // $values = [
                    //     'Date'=>date('Y-m-d'),'Time'=>date('h:i:s a'),'accountID'=>$row->accountID,'Activity'=>'Logged In'
                    // ];
                    // $logsModel->save($values);
                    return redirect()->to('admin/dashboard');
                }
            }
            else
            {
                session()->setFlashdata('fail','Account is disabled. Please contact the Administrator');
                return redirect()->to('/auth')->withInput();
            }
        }
    }

    public function logout()
    {
        if(session()->has('loggedUser'))
        {
            session()->remove('loggedUser');
            session()->destroy();
            return redirect()->to('/auth?access=out')->with('fail', 'You are logged out!');
        }
    }

    public function Dashboard()
    {
        //customer
        $builder = $this->db->table('tblcustomer');
        $builder->select('COUNT(*)total');
        $builder->WHERE('Status',1);
        $customer = $builder->get()->getResult();
        //patient
        $builder = $this->db->table('tblreservation');
        $builder->select('COUNT(*)total');
        $patient = $builder->get()->getResult();
        //appointment
        $builder = $this->db->table('tblreservation');
        $builder->select('COUNT(*)total');
        $builder->WHERE('Status',0);
        $appointment = $builder->get()->getResult();
        //patient
        $builder = $this->db->table('tblreservation');
        $builder->select('Date,count(reservationID)total');
        $builder->WHERE('Status<>',2);
        $builder->groupBy('Date')->orderBy('Date','ASC');
        $query = $builder->get()->getResult();

        $data = ['customer'=>$customer,'patient'=>$patient,'appointment'=>$appointment,'query'=>$query];
        return view('admin/index',$data);
    }

    public function Settings()
    {
        $accountModel = new \App\Models\accountModel();
        $user = $accountModel->findAll();
        //survey
        $surveyModel = new \App\Models\surveyModel();
        $survey = $surveyModel->findAll();
        //doctors
        $doctorsModel = new \App\Models\doctorsModel();
        $doctors = $doctorsModel->findAll();
        $builder = $this->db->table('tblblogs a');
        $builder->select('a.*,b.Fullname');
        $builder->join('tblaccount b','b.accountID=a.accountID','LEFT');
        $blog  = $builder->get()->getResult();
        //question
        $builder = $this->db->table('tblquestion a');
        $builder->select('a.*,b.Title,b.Type_Survey');
        $builder->join('tblsurvey b','b.surveyID=a.surveyID','LEFT');
        $list = $builder->get()->getResult();
        //choices
        $builder = $this->db->table('tblchoice a');
        $builder->select('a.Details,a.choiceID,b.Question');
        $builder->join('tblquestion b','b.questionID=a.questionID','LEFT');
        $choices = $builder->get()->getResult();

        $data = ['user'=>$user,'survey'=>$survey,'blog'=>$blog,'doctors'=>$doctors,'list'=>$list,'choices'=>$choices];
        return view('admin/settings',$data);
    }

    public function newAccount()
    {
        return view('admin/new-account');
    }

    public function saveAccount()
    {
        $accountModel = new \App\Models\accountModel();
        //data
        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');
        $password = "Qwerty1234";

        $validation = $this->validate([
            'fullname'=>'required',
            'email'=>'required|valid_email',
            'role'=>'required',
            'status'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the fieled');
            return redirect()->to('admin/new')->withInput();
        }
        else
        {
            $values = ['EmailAddress'=>$email,'Password'=>Hash::make($password),'Fullname'=>$fullname,'Status'=>$status,'Role'=>$role];
            $accountModel->save($values);
            session()->setFlashdata('success','Great! Successfully updated');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function resetAccount()
    {
        $accountModel = new \App\Models\accountModel();
        $id = $this->request->getPost('value');
        $password = "Qwerty1234";
        $values = ['Password'=>Hash::make($password)];
        $accountModel->update($id,$values);
        echo "success";
    }

    public function addAnswer($id)
    {
        $data = ['question'=>$id];
        return view('admin/add-answer',$data);
    }

    public function editAnswer($id)
    {
        $choiceModel = new \App\Models\choiceModel();
        $answer = $choiceModel->WHERE('choiceID',$id)->first();
        $data = ['answer'=>$answer];
        return view('admin/edit-answer',$data);
    }

    public function editUser($id)
    {
        $accountModel = new \App\Models\accountModel();
        $account = $accountModel->WHERE('accountID',$id)->first();
        $data = ['account'=>$account];
        return view('admin/edit-user',$data);
    }

    public function updateAccount()
    {
        $accountModel = new \App\Models\accountModel();
        //data
        $id = $this->request->getPost('accountID');
        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $status = $this->request->getPost('status');

        $validation = $this->validate([
            'fullname'=>'required',
            'email'=>'required|valid_email',
            'role'=>'required',
            'status'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the fieled');
            return redirect()->to('admin/edit/'.$id)->withInput();
        }
        else
        {
            $values = ['EmailAddress'=>$email,'Fullname'=>$fullname,'Status'=>$status,'Role'=>$role];
            $accountModel->update($id,$values);
            session()->setFlashdata('success','Great! Successfully updated');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function Manage()
    {
        $inquiryModel = new \App\Models\inquiryModel();
        $inquiry = $inquiryModel->findAll();
        $data = ['inquire'=>$inquiry];
        return view('admin/manage',$data);
    }

    public function Members()
    {
        $customerModel = new \App\Models\customerModel();
        $customer = $customerModel->findAll();
        $data = ['customer'=>$customer];
        return view('admin/members',$data);
    }

    public function activateAccount()
    {
        $customerModel = new \App\Models\customerModel();
        $val = $this->request->getPost('value');
        $values = ['Status'=>1];
        $customerModel->update($val,$values);
        echo "success";
    }

    public function deactivateAccount()
    {
        $customerModel = new \App\Models\customerModel();
        $val = $this->request->getPost('value');
        $values = ['Status'=>0];
        $customerModel->update($val,$values);
        echo "success";
    }

    public function Report()
    {
        return view('admin/report');
    }

    public function createPoll()
    {
        return view('admin/create-poll');
    }

    public function editSurvey($id)
    {
        $surveyModel = new \App\Models\surveyModel();
        $survey = $surveyModel->WHERE('surveyID',$id)->first();
        $data = ['survey'=>$survey];
        return view('admin/edit-survey',$data);
    }

    public function createQuestion()
    {
        $surveyModel = new \App\Models\surveyModel();
        $survey = $surveyModel->findAll();
        $data = ['survey'=>$survey];
        return view('admin/create-question',$data);
    }

    public function newDoctor()
    {
        return view('admin/new-physician');
    }

    public function editInfo($id)
    {
        $doctorsModel = new \App\Models\doctorsModel();
        $info = $doctorsModel->WHERE('doctorID',$id)->first();
        $data = ['info'=>$info];
        return view('admin/edit-info',$data);
    }

    public function createBlog()
    {
        //get the recent blogs at least 5
        $builder = $this->db->table('tblblogs a');
        $builder->select('a.*,b.Fullname');
        $builder->join('tblaccount b','b.accountID=a.accountID','LEFT');
        $builder->orderBy('a.blogsID','DESC')->limit(5);
        $blog = $builder->get()->getResult();
        $data = ['blog'=>$blog];
        return view('admin/create-blog',$data);
    }

    public function editBlog($id)
    {
        $blogModel = new \App\Models\blogModel();
        $blog = $blogModel->WHERE('blogsID',$id)->first();
        $data = ['blog'=>$blog];
        return view('admin/edit-blog',$data);
    }

    public function newReservation()
    {
        return view('admin/new-reservation');
    }

    public function reschedule($id)
    {
        $reservationModel = new \App\Models\reservationModel();
        $reservation = $reservationModel->WHERE('reservationID',$id)->first();
        $data = ['reservation'=>$reservation];
        return view('admin/rebook',$data);
    }

    public function rebook()
    {
        $reservationModel = new \App\Models\reservationModel();
        $customerID = 0;
        $reservationID = $this->request->getPost('reservationID');
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
        //update
        $values = ['Date'=>$date, 'Time'=>$time,'Event_Name'=>$type_appointment,
            'Surname'=>$surname,'Firstname'=>$firstname,'MiddleName'=>$mi,'Suffix'=>$suffix,
            'Contact'=>$phone,'BirthDate'=>$bdate,'Gender'=>$gender,
            'Address'=>$address,'Status'=>1,'customerID'=>$customerID];
            $reservationModel->update($reservationID,$values);
        session()->setFlashdata('success','Great! Successfully updated');
        return redirect()->to('admin/manage')->withInput();
    }

    public function acceptReservation()
    {
        $reservationModel = new \App\Models\reservationModel();
        //data
        $val = $this->request->getPost('value');
        $values = ['Status'=>1];
        $reservationModel->update($val,$values);
        echo "success";
    }

    public function completeReservation()
    {
        $reservationModel = new \App\Models\reservationModel();
        //data
        $val = $this->request->getPost('value');
        $values = ['Status'=>3];
        $reservationModel->update($val,$values);
        echo "success";
    }

    public function viewMessage()
    {
        $inquiryModel = new \App\Models\inquiryModel();
        $val = $this->request->getGet('value');
        $inquire = $inquiryModel->WHERE('inquiryID',$val)->first();
        //update before view
        $values = ['Status'=>1];
        $inquiryModel->update($val,$values);
        //view
        ?>
        <div class="row g-3">
            <div class="col-12 form-group">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label><b>Complete Name</b></label>
                        <input type="text" class="form-control" value="<?php echo $inquire['Name'] ?>"/>
                    </div>
                    <div class="col-lg-6">
                        <label><b>Email Address</b></label>
                        <input type="text" class="form-control" value="<?php echo $inquire['Email'] ?>"/>
                    </div>
                </div>
            </div>
            <div class="col-12 form-group">
                <label><b>Subject</b></label>
                <input type="text" class="form-control" value="<?php echo $inquire['Subject'] ?>"/>
            </div>
            <div class="col-12 form-group">
                <label><b>Message</b></label>
                <div style="height:150px;overflow-y:auto;"><?php echo $inquire['Message'] ?></div>
            </div>
        </div>
        <button type="button" class="btn btn-danger close">
            Close
        </button>
        <?php
    }

    public function Reservation()
    {
        $builder = $this->db->table('tblreservation a');
        $builder->select('a.reservationID,a.Date,a.Time,a.Event_Name,a.Status,a.Firstname,a.Surname,a.MiddleName,a.Suffix');
        $builder->join('tblcustomer b','b.customerID=a.customerID','LEFT');
        $builder->groupBy('a.reservationID');
        $builder->orderBy('a.reservationID','DESC');
        $data = $builder->get();
        foreach($data->getResult() as $row)
        {
            ?>
            <tr>
                <td><?php echo $row->Date ?></td>
                <td><?php echo $row->Time ?></td>
                <td><?php echo $row->Surname ?> <?php echo $row->Suffix ?>, <?php echo $row->Firstname ?> <?php echo $row->MiddleName ?></td>
                <td><?php echo $row->Event_Name ?></td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <span class="btn btn-primary text-white btn-sm">Reserved</span>
                    <?php }else if($row->Status==2){?>
                        <span class="btn btn-danger text-white btn-sm">Cancelled</span>
                    <?php }else if($row->Status==3){ ?>
                        <span class="btn btn-success text-white btn-sm">Completed</span>
                    <?php }else{ ?>
                        <span class="btn btn-warning text-white btn-sm">Pending</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <button type="button" class="btn btn-primary btn-sm tag" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-check"></span>&nbsp;Done</button>
                        <button type="button" class="btn btn-danger btn-sm cancel" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-x"></span>&nbsp;Cancel</button>
                    <?php }else if($row->Status==2) { ?>
                        <a class="btn btn-primary btn-sm" href="reschedule/<?php echo $row->reservationID ?>"><span class="bi bi-arrow-repeat"></span>&nbsp;Re-Book</a>
                    <?php }else if($row->Status==0) { ?>
                        <button type="button" class="btn btn-primary btn-sm accept" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-plus"></span>&nbsp;Accept</button>
                        <button type="button" class="btn btn-danger btn-sm cancel" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-x"></span>&nbsp;Cancel</button>
                    <?php } ?>
                </td>
            </tr>
            <?php
        }
    }

    public function searchReservation()
    {
        $text = "%".$this->request->getGet('keyword')."%";
        $builder = $this->db->table('tblreservation a');
        $builder->select('a.reservationID,a.Date,a.Time,a.Event_Name,a.Status,a.Firstname,a.Surname,a.MiddleName,a.Suffix');
        $builder->join('tblcustomer b','b.customerID=a.customerID','LEFT');
        $builder->LIKE('b.Fullname',$text);
        $builder->groupBy('a.reservationID');
        $builder->orderBy('a.reservationID','DESC');
        $data = $builder->get();
        foreach($data->getResult() as $row)
        {
            ?>
            <tr>
                <td><?php echo $row->Date ?></td>
                <td><?php echo $row->Time ?></td>
                <td><?php echo $row->Surname ?> <?php echo $row->Suffix ?>, <?php echo $row->Firstname ?> <?php echo $row->MiddleName ?></td>
                <td><?php echo $row->Event_Name ?></td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <span class="btn btn-primary text-white btn-sm">Reserved</span>
                    <?php }else if($row->Status==2){?>
                        <span class="btn btn-danger text-white btn-sm">Cancelled</span>
                    <?php }else if($row->Status==3){ ?>
                        <span class="btn btn-success text-white btn-sm">Completed</span>
                    <?php }else{ ?>
                        <span class="btn btn-warning text-white btn-sm">Pending</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <button type="button" class="btn btn-primary btn-sm tag" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-check"></span>&nbsp;Done</button>
                        <button type="button" class="btn btn-danger btn-sm cancel" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-x"></span>&nbsp;Cancel</button>
                    <?php }else if($row->Status==2) { ?>
                        <a class="btn btn-primary btn-sm" href="reschedule/<?php echo $row->reservationID ?>"><span class="bi bi-arrow-repeat"></span>&nbsp;Re-Book</a>
                    <?php }else if($row->Status==0) { ?>
                        <button type="button" class="btn btn-primary btn-sm accept" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-plus"></span>&nbsp;Accept</button>
                        <button type="button" class="btn btn-danger btn-sm cancel" value="<?php echo $row->reservationID ?>"><span class="bi bi-clipboard-x"></span>&nbsp;Cancel</button>
                    <?php } ?>
                </td>
            </tr>
            <?php
        }
    }

    public function Profile()
    {
        $accountModel = new \App\Models\accountModel();
        $user = session()->get('loggedUser');
        $account = $accountModel->WHERE('accountID',$user)->first();
        $data = ['account'=>$account];
        return view('admin/account-setting',$data);
    }

    public function updatePassword()
    {
        $accountModel = new \App\Models\accountModel();
        $user = session()->get('loggedUser');
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
                return redirect()->to('admin/profile')->withInput();
            }
            else
            {
                $defaultPassword = Hash::make($new_pass);
                $values = ['Password'=>$defaultPassword,];
                $accountModel->update($user,$values);

                session()->setFlashdata('success','Great! Password has successfully updated');
                return redirect()->to('admin/profile')->withInput();
            }
        }
    }

    //customer

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('/register');
    }

    public function customerLogin()
    {
        $customerModel = new \App\Models\customerModel();
        //data
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $validation = $this->validate([
            'email'=>'required|valid_email',
            'password'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid email or password');
            return redirect()->to('/login')->withInput();
        }
        else
        {
            $builder = $this->db->table('tblcustomer');
            $builder->select('*');
            $builder->WHERE('EmailAddress',$email)->WHERE('Status',1);
            $data = $builder->get();
            if($row = $data->getRow())
            {
                $check_password = Hash::check($password, $row->Password);
                if(empty($check_password) || !$check_password)
                {
                    session()->setFlashdata('fail','Invalid email or password');
                    return redirect()->to('/login')->withInput();
                }
                else
                {
                    session()->set('sess_id', $row->customerID);
                    session()->set('sess_fullname', $row->Fullname);
                    session()->set('customer_email',$row->EmailAddress);
                    return $this->response->redirect(site_url('customer/dashboard'));
                }
            }
            else
            {
                session()->setFlashdata('fail','Account is disabled. Please contact the Administrator');
                return redirect()->to('/login')->withInput();
            }
        }
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function createAccount()
    {
        $customerModel = new \App\Models\customerModel();
        //data
        $emailadd = $this->request->getPost('email');
        $fullname = $this->request->getPost('fullname');
        $password = $this->request->getPost('password');
        $retype = $this->request->getPost('confirm_password');

        $validation = $this->validate([
            'email'=>'required|valid_email|is_unique[tblcustomer.EmailAddress]',
            'fullname'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Sorry! Email already exists');
            return redirect()->to('/register')->withInput();
        }
        else
        {
            if($password!=$retype)
            {
                session()->setFlashdata('fail','Invalid! Password mismatched');
                return redirect()->to('/register')->withInput();
            }
            else
            {
                $token_code = random_string('alnum',20);
                $hash_password = Hash::make($password);
                $values = [
                    'EmailAddress'=>$emailadd, 'Password'=>$hash_password ,'Fullname'=>$fullname,'Status'=>0,'Token'=>$token_code
                ];
                $customerModel->save($values);
                $email = \Config\Services::email();
                $email->setTo($emailadd,$fullname);
                $email->setFrom("pcos.system2024@gmail.com","e-PCOS");
                $imgURL = "assets/img/logo.png";
                $email->attach($imgURL);
                $cid = $email->setAttachmentCID($imgURL);
                $template = "<center>
                <img src='cid:". $cid ."' width='100'/>
                <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
                <tr><td><center><h1>Account Activation</h1></center></td></tr>
                <tr><td><center>Hi, ".$fullname."</center></td></tr>
                <tr><td><p><center>Please click the link below to activate your account.</center></p></td><tr>
                <tr><td><center><b>".anchor('activate/'.$token_code,'Activate Account')."</b></center></td></tr>
                <tr><td><p><center>If you did not sign-up in e-PCOS Website,<br/> please ignore this message or contact us @ pcos.system2024@gmail.com</center></p></td></tr>
                <tr><td>e-PCOS IT Support</td></tr></tbody></table></center>";
                $subject = "Account Activation | e-PCOS";
                $email->setSubject($subject);
                $email->setMessage($template);
                $email->send();
                session()->set('customer_email', $emailadd);
                return redirect()->to('/success');
            }
        }
    }

    public function successPage()
    {
        return view('success-form');
    }

    public function activate($id)
    {
        $customerModel = new \App\Models\customerModel();
        $customer = $customerModel->WHERE('Token',$id)->first();
        $values = ['Status'=>1];
        $customerModel->update($customer['customerID'],$values);
        session()->set('sess_id', $customer['customerID']);
        session()->set('sess_fullname', $customer['Fullname']);
        session()->set('customer_email',$customer['EmailAddress']);
        return $this->response->redirect(site_url('customer/dashboard'));
    }

    public function signOut()
    {
        if(session()->has('customer_email'))
        {
            session()->remove('customer_email');
            session()->remove('sess_id');
            session()->destroy();
            return redirect()->to('/login?access=out')->with('fail', 'You are logged out!');
        }
    }
}
