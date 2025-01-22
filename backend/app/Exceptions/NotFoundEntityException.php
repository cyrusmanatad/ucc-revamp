<?php

namespace App\Exceptions;

use Exception;

Class NotFoundEntityException extends Exception {
    public function __construct($message = "", $code = 404) 
    {
        parent::__construct($message, $code);
    }
}