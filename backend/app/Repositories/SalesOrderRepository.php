<?php

namespace App\Repositories;

use App\Interfaces\SalesOrderRepositoryInterface;
use App\Models\SalesOrder;

class SalesOrderRepository implements SalesOrderRepositoryInterface {

    private $model;

    public function __construct(SalesOrder $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->findAll();
    }

    public function getByOrderSlipNumber(string $order_slip_number) : array|null
    {
        return $this->model->where('order_slip_number', $order_slip_number)->find();
    }

    public function create(array $data)
    {

    }

    public function update(string $order_slip_number, array $data)
    {

    }

    public function delete(string $order_slip_number)
    {

    }
}