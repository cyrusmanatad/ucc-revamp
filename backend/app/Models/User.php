<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class User extends Model {
    protected $table = 'tbl_user';
    protected $allowedFields = ['psr_code', 'psr_fname', 'email_add', 'psr_pass'];
    protected $beforeInsert = ['hashPassword', 'registrationDate', 'userId'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data) : array
    {
        if (!isset($data['data']['psr_pass'])) {
            return $data;
        }
        
        $data['data']['psr_pass'] = password_hash($data['data']['psr_pass'], PASSWORD_BCRYPT);
        return $data;
    }

    protected function registrationDate(array $data) : array
    {
        
        $data['data']['registration_date'] = date('Y-m-d H:i:s', Time::now('Asia/Manila', 'en_US')->getTimestamp());

        return $data;
    }

    protected function userId(array $data) : array
    {
        
        $isUserIdExist = false;
        do {
            $new_user_id = rand(1000,9999);

            $user = $this->where('user_id', rand(1000,9999))->first();

            if($user === null) {
                $data['data']['user_id'] = $new_user_id;
            }else{
                $isUserIdExist = true;
            }

        } while ($isUserIdExist);

        return $data;
    }
}