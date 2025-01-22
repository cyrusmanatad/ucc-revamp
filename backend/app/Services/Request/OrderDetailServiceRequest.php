<?php

namespace App\Services\Request;

use App\Enum\Status;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\RESTful\BaseResource;
use CodeIgniter\RESTful\ResourceController;

class OrderDetailServiceRequest
{
    public int $ship_to;
    public string $branch_code;
    public int $div_code;
    public int $item_tag;
    public int $status;

    public function __construct()
    {
        $this->ship_to = request()->getJSON()->cust_code;
        $this->branch_code = request()->getJSON()->branch_code;
        $this->div_code = request()->getJSON()->div_code;
        $this->item_tag = request()->getJSON()->item_tag ?? 1;
        $this->status = request()->getJSON()->status ?? 1;
    }

    public function rules(): array {
        return [
            'ship_to' => [
                'rules' => 'required',
                'errors' => [
                    'rule_name' => 'Customer is required!'
                ]
            ],
            'branch_code' => [
                'rules' => 'required',
                'errors' => [
                    'rule_name' => 'Branch plant is required!'
                ]
            ],
            'div_code' => [
                'rules' => 'required',
                'errors' => [
                    'rule_name' => 'Division is required!'
                ]
            ],
        ];
    }
}
