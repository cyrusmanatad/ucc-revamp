<?php

namespace App\Repositories;

use App\Interfaces\CreateOrderRepositoryInterface;
use App\Models\CustomModel;
use App\Services\FinishGoodService;
use App\Services\Request\OrderDetailServiceRequest;

class CreateOrderRepository implements CreateOrderRepositoryInterface {

    public function __construct(private CustomModel $model, private FinishGoodService $finishGoodService)
    {

    }

    public function getOrderType()
    {
        return $this->model->getOrderType();
    }

    public function getDivisions(int $psr_code)
    {
        return $this->model->getDivisionsByPsrCode($psr_code);
    }

    public function getCustomers(int $div_code, string $psr_code)
    {
        return $this->model->getCustomersByDivCodeAndPsrCode($div_code, $psr_code);
    }

    public function getBranchPlant()
    {
        return $this->model->getBranchPlant();
    }

    public function getDeliverMode()
    {
        return [
            "PICKUP - MOBILE APP" => "For Pick-Up",
            "MOBILE APP" => "For Delivery",
        ];
    }

    public function getSkus(OrderDetailServiceRequest $request)
    {
        return $this->finishGoodService->getSkus($request);
    }

    // public function getSkuByCustomerPlantDivision(int $item_tag, int $ship_to, string $branch_code, int $div_code, int $status = 1) : array
    // {
    //     return [];
    // }

    // public function getSkuByCustomerDivision(int $item_tag, int $ship_to, int $div_code, int $status = 1) : array
    // {
    //     return [];
    // }

    // public function getSkuByPlantDivision(int $item_tag, string $branch_code, int $div_code, int $status = 1) : array
    // {
    //     return [];
    // }

    // public function getSkuByDivision(int $item_tag, int $div_code, int $status = 1) : array
    // {
    //     return [];
    // }

}