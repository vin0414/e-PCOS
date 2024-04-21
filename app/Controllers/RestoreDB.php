<?php

namespace App\Controllers;
use Config\App;

class RestoreDB extends BaseController
{    
    public function RestoreData()
    {
        $server = $this->request->getPost('server');
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$dbname = $this->request->getPost('database');
        $conn = mysqli_connect($server, $username, $password, $dbname);
        $conn->set_charset("utf8");
 
		//moving the uploaded sql file
		$filename = $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'],'Upload/' . $filename);
		$file_location = 'Upload/' . $filename;
 
		//restore database using our function
		$sql = '';
     
        //get our sql file
        $lines = file($file_location);
     
        $output = array('error'=>false);
        //loop each line of our sql file
        foreach ($lines as $line){
     
            //skip comments
            if(substr($line, 0, 2) == '--' || $line == ''){
                continue;
            }
     
            //add each line to our query
            $sql .= $line;
     
            //check if its the end of the line due to semicolon
            if (substr(trim($line), -1, 1) == ';'){
                //perform our query
                $query = $conn->query($sql);
                if(!$query){
                    $output['error'] = true;
                    $output['message'] = $conn->error;
                    session()->setFlashdata('fail',$output);
                    return redirect()->to('admin/maintenance')->withInput();
                }
                else{
                    session()->setFlashdata('success','Great! Database successfully restored.');
                    return redirect()->to('admin/maintenance')->withInput();   
                }
     
                //reset our query variable
                $sql = '';
     
            }
        }
    }
}