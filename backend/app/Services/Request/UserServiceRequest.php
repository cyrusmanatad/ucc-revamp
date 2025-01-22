<?php

namespace App\Services\Request;

use CodeIgniter\Validation\ValidationInterface;

class UserServiceRequest
{
    public function __construct(protected ValidationInterface $validator) {}

    public function validateCreateUser(array $data) : bool
    {
        $rules = [
            'psr_fname' => 'required|min_length[10]',
            'email_add' => 'required|valid_email|is_unique[tbl_user.email_add]',
            'psr_pass' => 'required|min_length[8]',
            'psr_pass_confirm' => 'required|min_length[8]|matches[psr_pass]',
            'psr_code' => 'required|is_unique[tbl_user.psr_code]',
        ];

        $error_messages = [
            'psr_fname' => [
                'required' => 'Personnel name is required!',
            ],
            'email_add' => [
                'required' => 'Email is required!',
                'is_unique' => 'Email already exist!'
            ],
            'psr_pass' => [
                'required' => 'Password is required!',
                'min_length' => 'Password must be at least 8 characters',
            ],
            'psr_pass_confirm' => [
                'required' => 'Confirm password is required!',
                'min_length' => 'Confirm password must be at least 8 characters',
                'matches' => 'Password and confirm password must be the same',
            ],
            'psr_code' => [
                'required' => 'PSR Code is required!',
                'is_unique' => 'PSR Code already exist!'
            ]
        ];

        return $this->validator->setRules($rules, $error_messages)->run($data);
    }

    public function validateLogin(array $data): bool
    {
        $rules = [
            'email_add' => 'required|valid_email',
            'psr_pass' => 'required|min_length[8]'
        ];

        $error_messages = [
            'psr_pass' => [
                'required' => 'Password is required!',
                'min_length' => 'Password must be atleast 8 characters long!'
            ],
            'email_add' => [
                'required' => 'Email is required!',
                'valid_email' => 'Email already exist!'
            ]
        ];

        return $this->validator->setRules($rules, $error_messages)->run($data);
    }

    public function getErrors() : array
    {
        return $this->validator->getErrors();
    }
}