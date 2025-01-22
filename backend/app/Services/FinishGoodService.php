<?php

namespace App\Services;

use App\Services\Request\OrderDetailServiceRequest;
use App\Interfaces\SkuRepositoryInterface;
use App\Models\CustomModel;

class FinishGoodService implements SkuRepositoryInterface {

    public function __construct(private CustomModel $model) { }

    public function getSkus(OrderDetailServiceRequest $details) : array|null 
    {
        // Explicit method calls for better readability and maintainability
        $skus = $this->getSkuByCustomerPlantDivision($details);
        if ($skus) return $skus;

        $skus = $this->getSkuByCustomerDivision($details);
        if ($skus) return $skus;

        $skus = $this->getSkuByPlantDivision($details);
        if ($skus) return $skus;

        $skus = $this->getSkuByDivision($details);
        if ($skus) return $skus;

        return null;
    }

    private function getSkuByCustomerPlantDivision(OrderDetailServiceRequest $details): ?array
    {
        return $this->model->getSkuByCustomerPlantDivision($details);
    }

    private function getSkuByCustomerDivision(OrderDetailServiceRequest $details): ?array
    {
        return $this->model->getSkuByCustomerDivision($details);
    }

    private function getSkuByPlantDivision(OrderDetailServiceRequest $details): ?array
    {
        return $this->model->getSkuByPlantDivision($details);
    }

    private function getSkuByDivision(OrderDetailServiceRequest $details): ?array
    {
        return $this->model->getSkuByDivision($details);
    }
}
