<?php

namespace App\Models;

use CodeIgniter\Model;

class Sku extends Model
{
    protected $table            = 'tbl_sku';
    protected $primaryKey       = 'sku_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['sku_code', 'sku_desc'] ;
}