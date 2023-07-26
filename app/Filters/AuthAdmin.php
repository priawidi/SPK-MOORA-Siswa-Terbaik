<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class AuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (session()->role != 1) {
            return redirect()->to('/block');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
