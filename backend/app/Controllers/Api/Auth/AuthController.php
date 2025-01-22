<?php

namespace App\Controllers\Api\Auth;

use App\Services\Request\UserServiceRequest;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    protected $user;

    protected $helpers = ['form'];

    public function __construct()
    {
        $this->user = new User();
    }

    public function createUser(): ResponseInterface
    {
        $data = $this->request->getJSON(true);
        $validator = new UserServiceRequest(\Config\Services::validation());

        if (!$validator->validateCreateUser($data)) {
            return $this->failValidationErrors($validator->getErrors());
        }

        $user = $this->user->insert($this->request->getJSON());

        return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)->setJSON($user);
    }

    public function login()
    {
        $rules = [
            'email_add' => 'required|valid_email',
            'psr_pass' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON();
        $user = $this->user->where('email_add', $data->email_add)->first();

        if (!$user || !password_verify($data->psr_pass, $user['psr_pass'])) {
            return $this->failUnauthorized('Invalid credentials');
        }

        $token = $this->generateJWTToken($user);
        $refreshToken = $this->generateRefreshToken($user);

        return $this->respond([
            'token' => $token,
            'refresh_token' => $refreshToken,
            'user' => [
                'id' => $user['psr_id'],
                'email_add' => $user['email_add'],
                'psr_code' => $user['psr_code']
            ]
        ]);
    }

    private function generateJWTToken($user)
    {
        $config = config('JWT');
        $issuedAt = time();
        $expire = $issuedAt + $config->ttl;

        $payload = [
            'iss' => $config->issuer,
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => [
                'id' => $user['psr_id'],
                'email_add' => $user['email_add']
            ]
        ];

        return JWT::encode($payload, $config->key, $config->algorithm);
    }

    private function generateRefreshToken($user)
    {
        $config = config('JWT');
        $issuedAt = time();
        $expire = $issuedAt + $config->refreshTtl;

        $payload = [
            'iss' => $config->issuer,
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => [
                'id' => $user['psr_id'],
                'type' => 'refresh'
            ]
        ];

        return JWT::encode($payload, $config->key, $config->algorithm);
    }

    /**
     * TODO: Not yet working...
     * @return ResponseInterface
     */
    public function refresh()
    {
        try {
            $refreshToken = $this->request->getJSON()->refresh_token;
            $config = config('JWT');

            $decoded = JWT::decode($refreshToken, new Key($config->key, $config->algorithm));

            if ($decoded->data->type !== 'refresh') {
                return $this->failUnauthorized('Invalid refresh token');
            }

            $user = $this->user->find($decoded->data->psr_id);
            $token = $this->generateJWTToken($user);

            return $this->respond([
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid refresh token');
        }
    }
}
