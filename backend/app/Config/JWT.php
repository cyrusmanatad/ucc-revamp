<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig {
    public $key = 'r1UrWkVoIwTQS2yfnlfuSKsAdfk3zRHrMTkfDCv7Vzg='; // Store this in .env
    public $algorithm = 'HS256';
    public $issuer = 'AnyRandomName';
    public $ttl = 3600; // Token validity in seconds
    public $refreshTtl = 7200; // Refresh token validity
}