<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesOrder extends Model {
    protected $table = 'tbl_order_data_trade';
    protected $primaryKey = 'odt_id';
    protected $allowedFields = ['psr_code', 'order_slip_number', 'cust_code', 'ship_to', 'div_code', 'branch_code', 'sku_code', 'sku_type', 'ref_item', 'quantity', 'delivery_mode_code', 'remarks', 'user_type', 'email', 'delivery_date', 'is_submitted', 'status', 'oracle_status', 'invoice_no', 'attempt', 'order_date', 'date_updated', 'time_updated', 'created_date', 'updated_date'];
    protected $returnType = 'array';

    protected $validationRules = [
        'psr_code' => 'required|numeric|min_length[15]|max_length[15]',
        'order_slip_number' => 'required',
        'cust_code' => 'required|min_length[15]|max_length[15]',
        'branch_code' => 'required',
        'sku_code' => 'required',
        'quantity' => 'required|integer|greater_than_equal_to[1]',
        'order_date' => 'required|date',
    ];
}