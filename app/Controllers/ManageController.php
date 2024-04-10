<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\App;

class ManageController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function savePoll()
    {
        $surveyModel = new \App\Models\surveyModel();
        //data
        $title_poll = $this->request->getPost('title_poll');
        $description = $this->request->getPost('description');
        $poll_type =  $this->request->getPost('poll_type');

        $validation = $this->validate([
            'title_poll'=>'required|is_unique[tblsurvey.Title]',
            'poll_type'=>'required'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/create-poll')->withInput();
        }
        else
        {
            $values = ['Title'=>$title_poll, 'Details'=>$description,'Type_Survey'=>$poll_type,'Status'=>1];
            $surveyModel->save($values);
            session()->setFlashdata('success','Great! Successfully created a poll survey');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function updatePoll()
    {
        $surveyModel = new \App\Models\surveyModel();
        //data
        $id = $this->request->getPost('id');
        $title_poll = $this->request->getPost('title_poll');
        $description = $this->request->getPost('description');
        $poll_type =  $this->request->getPost('poll_type');
        $values = ['Title'=>$title_poll, 'Details'=>$description,'Type_Survey'=>$poll_type,'Status'=>1];
        $surveyModel->update($id,$values);
        session()->setFlashdata('success','Great! Successfully updated');
        return redirect()->to('admin/settings')->withInput();
    }

    public function activateSurvey()
    {
        $surveyModel = new \App\Models\surveyModel();
        //data
        $id = $this->request->getPost('value');
        $values = ['Status'=>1];
        $surveyModel->update($id,$values);
        echo "success";
    }

    public function closeSurvey()
    {
        $surveyModel = new \App\Models\surveyModel();
        //data
        $id = $this->request->getPost('value');
        $values = ['Status'=>0];
        $surveyModel->update($id,$values);
        echo "success";
    }

    public function saveQuestion()
    {
        date_default_timezone_set('Asia/Manila');
        $questionModel = new \App\Models\questionModel();
        //data
        $category = $this->request->getPost('category');
        $question = $this->request->getPost('question');
        $validation = $this->validate([
            'category'=>'required',
            'question'=>'required|is_unique[tblquestion.Question]'
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/create-question')->withInput();
        }
        else
        {
            $values = ['surveyID'=>$category,'Question'=>$question,'Date'=>date('Y-m-d')];
            $questionModel->save($values);
            session()->setFlashdata('success','Great! Successfully added');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function deleteQuestion()
    {
        $val = $this->request->getPost('value');
        $builder = $this->db->table('tblquestion');
        $builder->WHERE('questionID',$val);
        $builder->delete();
        echo "success";
    }

    public function saveEntry()
    {
        $doctorsModel = new \App\Models\doctorsModel();
        //data
        $name = $this->request->getPost('name');
        $specialty = $this->request->getPost('specialty');
        $phone = $this->request->getPost('phone');
        $file = $this->request->getFile('file');
        $originalName = $file->getClientName();

        $validation = $this->validate([
            'name'=>'required',
            'specialty'=>'required',
            'phone'=>'required',
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/new-physician')->withInput();
        }
        else
        {
            $values = ['Name'=>$name,'Specialty'=>$specialty,'Contact'=>$phone,'Image'=>$originalName,'Status'=>1];
            $doctorsModel->save($values);
            $file->move('Doctors/',$originalName);
            session()->setFlashdata('success','Great! Successfully added');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function editEntry()
    {
        $doctorsModel = new \App\Models\doctorsModel();
        //data
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $specialty = $this->request->getPost('specialty');
        $phone = $this->request->getPost('phone');

        $validation = $this->validate([
            'name'=>'required',
            'specialty'=>'required',
            'phone'=>'required',
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/edit-info/'.$id)->withInput();
        }
        else
        {
            $values = ['Name'=>$name,'Specialty'=>$specialty,'Contact'=>$phone];
            $doctorsModel->update($id,$values);
            session()->setFlashdata('success','Great! Successfully updated');
            return redirect()->to('admin/settings')->withInput();
        }
    }
    

    public function saveBlog()
    {
        date_default_timezone_set('Asia/Manila');
        $blogModel = new \App\Models\blogModel();
        //data
        $title_blog = $this->request->getPost('title_blog');
        $description = $this->request->getPost('description');
        $file = $this->request->getFile('file');
        $originalName = $file->getClientName();
        
        $validation = $this->validate([
            'title_blog'=>'required',
            'description'=>'required',
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/create-poll')->withInput();
        }
        else
        {
            $values = ['Title'=>$title_blog, 'Details'=>$description,
            'accountID'=>session()->get('loggedUser'),'Date'=>date('Y-m-d'),'Image'=>$originalName];
            $blogModel->save($values);
            $file->move('Blogs/',$originalName);
            session()->setFlashdata('success','Great! Successfully posted');
            return redirect()->to('admin/settings')->withInput();
        }
    }

    public function updateBlog()
    {
        $blogModel = new \App\Models\blogModel();
        //data
        $id = $this->request->getPost('id');
        $title_blog = $this->request->getPost('title_blog');
        $description = $this->request->getPost('description');
        $file = $this->request->getFile('file');
        $originalName = $file->getClientName();
        
        $validation = $this->validate([
            'title_blog'=>'required',
            'description'=>'required',
        ]);

        if(!$validation)
        {
            session()->setFlashdata('fail','Invalid! Please fill in the form');
            return redirect()->to('admin/create-poll')->withInput();
        }
        else
        {
            if(empty($originalName))
            {
                $values = ['Title'=>$title_blog, 'Details'=>$description,'Date'=>date('Y-m-d')];
                $blogModel->update($id,$values);
            }
            else
            {
                $values = ['Title'=>$title_blog, 'Details'=>$description,'Date'=>date('Y-m-d'),'Image'=>$originalName];
                $blogModel->update($id,$values);
                $file->move('Blogs/',$originalName);
            }
            session()->setFlashdata('success','Great! Successfully updated');
            return redirect()->to('admin/settings')->withInput();
        }
    }
}