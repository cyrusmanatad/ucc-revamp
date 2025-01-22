<?php

namespace App\Interfaces;

use App\Services\Request\OrderDetailServiceRequest;

interface SkuRepositoryInterface {
    public function getSkus(OrderDetailServiceRequest $details) : array|null;
}