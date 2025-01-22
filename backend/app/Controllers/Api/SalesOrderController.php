<?php

namespace App\Controllers\Api;

use App\Models\CustomModel;
use App\Services\SalesOrderService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SalesOrderController extends ResourceController
{
    private SalesOrderService $salesOrderService;

    public function __construct()
    {
        $this->salesOrderService = service("SalesOrderService");
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        $salesOrder = $this->salesOrderService->getSalesOrders();

        return $this->response->setStatusCode($salesOrder['status'])->setJSON($salesOrder['data']);
    }

    public function show($order_slip_number = null): ResponseInterface
    {
        $salesOrder = $this->salesOrderService->getSalesOrder($order_slip_number);

        return $this->response->setStatusCode($salesOrder['status'])
        ->setJSON($salesOrder['data'] ?? $salesOrder['error']);
    }
}
