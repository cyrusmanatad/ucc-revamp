<?php

namespace App\Services;

use App\Interfaces\SalesOrderRepositoryInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SalesOrderService {

    public function __construct(private SalesOrderRepositoryInterface $repository) { }

    public function getSalesOrders()
    {
        try {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'data'=> $this->repository->getAll()
            ];
        }catch (\Exception $e) {
            return [
                'status' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'Error retrieving submitted orders' . $e->getMessage(),
            ];
        }
    }

    public function getSalesOrder(string $order_slip_number)
    {
        try {
            $order = $this->repository->getByOrderSlipNumber($order_slip_number);

            if(!$order) {
                return [
                    'status'=> ResponseInterface::HTTP_NOT_FOUND,
                    'error'=> 'Order not found'
                ];
            }

            return [
                'status'=> ResponseInterface::HTTP_OK,
                'data'=> $order
            ];

        }catch (\Exception $e) {
            return [
                'status'=> ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                'error'=> 'Error retrieving submitted order'. $e->getMessage(),
            ];
        }
    }
}