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
}