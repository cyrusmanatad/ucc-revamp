<?php

namespace App\Interfaces;

interface SalesOrderRepositoryInterface {
    public function getAll();
    public function getByOrderSlipNumber(string $order_slip_number);
    public function create(array $data);
    public function update(string $order_slip_number, array $data);
    public function delete(string $order_slip_number);
}