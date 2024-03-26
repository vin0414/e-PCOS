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

    public function index()
    {
        return view('welcome_message');
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
        return view('admin/index');
    }

    public function Settings()
    {
        $accountModel = new \App\Models\accountModel();
        $user = $accountModel->findAll();
        $surveyModel = new \App\Models\surveyModel();
        $survey = $surveyModel->findAll();
        $builder = $this->db->table('tblblogs a');
        $builder->select('a.*,b.Fullname');
        $builder->join('tblaccount b','b.accountID=a.accountID','LEFT');
        $blog  = $builder->get()->getResult();
        $data = ['user'=>$user,'survey'=>$survey,'blog'=>$blog];
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
        return view('admin/manage');
    }

    public function Members()
    {
        $customerModel = new \App\Models\customerModel();
        $customer = $customerModel->findAll();
        $data = ['customer'=>$customer];
        return view('admin/members',$data);
    }

    public function Report()
    {
        return view('admin/report');
    }

    public function createPoll()
    {
        return view('admin/create-poll');
    }

    public function createQuestion()
    {
        return view('admin/create-question');
    }

    public function newDoctor()
    {
        return view('admin/new-physician');
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

    public function Reservation()
    {
        $builder = $this->db->table('tblreservation a');
        $builder->select('a.reservationID,a.Date,a.Time,a.Event_Name,a.Status,b.Fullname');
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
                <td><?php echo $row->Fullname ?></td>
                <td><?php echo $row->Event_Name ?></td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <span class="btn btn-primary text-white btn-sm">Reserved</span>
                    <?php }else if($row->Status==2){?>
                        <span class="btn btn-danger text-white btn-sm">Cancelled</span>
                    <?php }else { ?>
                        <span class="btn btn-success text-white btn-sm">Completed</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <button type="button" class="btn btn-primary btn-sm tag" value="<?php echo $row->reservationID ?>"><span class="bi bi-check"></span> Tag as Done</button>
                    <?php }else if($row->Status==2) { ?>
                        <button type="button" class="btn btn-primary btn-sm book" value="<?php echo $row->reservationID ?>"><span class="bi bi-arrow-repeat"></span> Book Again</button>
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
        $builder->select('a.reservationID,a.Date,a.Time,a.Event_Name,a.Status,b.Fullname');
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
                <td><?php echo $row->Fullname ?></td>
                <td><?php echo $row->Event_Name ?></td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <span class="btn btn-primary text-white btn-sm">Reserved</span>
                    <?php }else if($row->Status==2){?>
                        <span class="btn btn-danger text-white btn-sm">Cancelled</span>
                    <?php }else { ?>
                        <span class="btn btn-success text-white btn-sm">Completed</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if($row->Status==1){ ?>
                        <button type="button" class="btn btn-primary btn-sm tag" value="<?php echo $row->reservationID ?>"><span class="bi bi-check"></span> Tag as Done</button>
                    <?php }else if($row->Status==2) { ?>
                        <button type="button" class="btn btn-primary btn-sm book" value="<?php echo $row->reservationID ?>"><span class="bi bi-arrow-repeat"></span> Book Again</button>
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
