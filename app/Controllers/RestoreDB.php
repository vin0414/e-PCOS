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
 
		$filename = $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'],'Upload/' . $filename);
		$file_location = 'Upload/' . $filename;

        function restore($server, $username, $password, $dbname, $location){
            //connection
            $conn = mysqli_connect($server, $username, $password, $dbname); 
         
            //variable use to store queries from our sql file
            $sql = '';
         
            //get our sql file
            $lines = file($location);
         
            //return message
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
                    }
                    else{
                        $output['message'] = 'Database restored successfully';
                    }
         
                    //reset our query variable
                    $sql = '';
         
                }
            }
         
            return $output;
        }
 
		//restore database using our function
		$restore = restore($server, $username, $password, $dbname, $file_location);
        if($restore['error'])
        {
            session()->setFlashdata('fail','Error! Something went wrong.'.$restore['message']);
            return redirect()->to('admin/maintenance')->withInput();
        }
        else
        {
            session()->setFlashdata('success',$restore['message']);
            return redirect()->to('admin/maintenance')->withInput();
        }
    }
}