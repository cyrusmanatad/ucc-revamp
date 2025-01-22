<?php

namespace App\Interfaces;

use App\Services\Request\OrderDetailServiceRequest;

interface CreateOrderRepositoryInterface {
    public function getOrderType();
    
    public function getDivisions(int $psr_code);
    
    public function getCustomers(int $div_code, string $psr_code);

    public function getBranchPlant();

    public function getDeliverMode();
    
    public function getSkus(OrderDetailServiceRequest $request);
}