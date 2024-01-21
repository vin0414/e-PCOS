<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class customerAuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (!session()->has('sess_id')) {
            return redirect()->to('/login')->with('fail','You must logged In!');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}