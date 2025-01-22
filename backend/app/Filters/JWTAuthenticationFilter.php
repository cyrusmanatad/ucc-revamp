<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthenticationFilter implements FilterInterface {
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null) {

        $header = $request->getHeader("Authorization");
        
        if (!$header) {
            return Services::response()
                ->setJSON(['error' => 'No token provided'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        try {
            $token = explode(' ', $header->getValue())[1];
            $config = config('JWT');
            
            $decoded = JWT::decode($token, new Key($config->key, $config->algorithm));
            
            // Add user info to request for controllers to use
            $request->user = $decoded->data;
            
            return $request;
        } catch (Exception $e) {
            return Services::response()
                ->setJSON(['error' => 'Invalid token'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // No after-filter action needed
    }
}
