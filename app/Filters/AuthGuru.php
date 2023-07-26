<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuru implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->role != 1 && session()->role != 2) {

            return redirect()->to('/block');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
