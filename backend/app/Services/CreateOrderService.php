<?php

namespace App\Services;

use App\Interfaces\CreateOrderRepositoryInterface;
use App\Services\Request\OrderDetailServiceRequest;
use CodeIgniter\HTTP\ResponseInterface;

class CreateOrderService {

    public function __construct(private CreateOrderRepositoryInterface $repository) { }

    public function getOrderType()
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getOrderType()
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving order type' . $e->getMessage(),
            ];
        }
    }

    public function getDivisions(int $psr_code)
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getDivisions($psr_code)
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving order type' . $e->getMessage(),
            ];
        }
    }

    public function getCustomers(int $div_code, int $psr_code)
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getCustomers($div_code, $psr_code)
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving order type' . $e->getMessage(),
            ];
        }
    }

    public function getBranchPlant()
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getBranchPlant()
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving branch plant' . $e->getMessage(),
            ];
        }
    }

    public function getDeliveryMode()
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getDeliverMode()
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving delivery mode' . $e->getMessage(),
            ];
        }
    }

    public function getSkus(OrderDetailServiceRequest $orderDetails)
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getSkus($orderDetails)
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving delivery mode' . $e->getMessage(),
            ];
        }
    }
}