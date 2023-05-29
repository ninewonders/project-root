<?php

namespace App\Middlewares;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Views\errors\cli;
use CodeIgniter\Security\Exceptions\SecurityException;
use Config\Services;

class AuthMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the Authorization header
        $session = session();
        $user = $session->get('user');
    
        //Check if the User has been set
        if (!isset($user)) {
            // No User, return 401 Unauthorized
            return redirect()->to('/')->with('error', 'Unauthorized');
        }
        
        return $request;
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }

}