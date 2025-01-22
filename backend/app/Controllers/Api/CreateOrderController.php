<?php

namespace App\Controllers\Api;

use App\Models\CustomModel;
use App\Services\CreateOrderService;
use App\Services\Request\OrderDetailServiceRequest;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CreateOrderController extends ResourceController
{
    protected $modelName = 'App\Model\CustomModel';
    private CreateOrderService $createOrderService;

    public function __construct()
    {
        $this->createOrderService = service("createOrderService");
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function getOrderType(): ResponseInterface
    {
        $orderType = $this->createOrderService->getOrderType();

        return $this->response->setStatusCode($orderType['status'])->setJSON($orderType['data'] ?? $orderType['error']);
    }

    public function getDivisions(int $psr_code): ResponseInterface
    {
        $divisions = $this->createOrderService->getDivisions($psr_code);

        return $this->response->setStatusCode($divisions['status'])->setJSON($divisions['data'] ?? $divisions['error']);
    }

    public function getCustomers(int $div_code, int $psr_code): ResponseInterface
    {
        $cusomers = $this->createOrderService->getCustomers($div_code, $psr_code);

        return $this->response->setStatusCode($cusomers['status'])->setJSON($cusomers['data'] ?? $cusomers['error']);
    }

    public function getBranchPlant(): ResponseInterface
    {
        $branch = $this->createOrderService->getBranchPlant();

        return $this->response->setStatusCode($branch['status'])->setJSON($branch['data'] ?? $branch['error']);
    }

    public function getDeliveryMode(): ResponseInterface
    {
        $branch = $this->createOrderService->getDeliveryMode();

        return $this->response->setStatusCode($branch['status'])->setJSON($branch['data'] ?? $branch['error']);
    }

    public function getSkus(): ResponseInterface
    {
        $skus = $this->createOrderService->getSkus(new OrderDetailServiceRequest());

        return $this->response->setStatusCode($skus['status'])->setJSON($skus['data'] ?? $skus['error']);
    }
}
