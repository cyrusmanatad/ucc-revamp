<?php

namespace App\Controllers;

use App\Models\CustomModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class OrderEntry extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function get_order_type() : ResponseInterface
    {
        $orderType = (new CustomModel())->getOrderType();
        return $this->respond($orderType, 200, "Success");
    }

    public function get_customers_by_div_psr(int $div_code, string $psr_code) : ResponseInterface
    {
        $customers = (new CustomModel())->getCustomersByDivCodeAndPsrCode($div_code, $psr_code);
        return $this->respond($customers, 200, "Success");
    }

    public function get_branch_plant() : ResponseInterface
    {
        $branch = (new CustomModel())->getBranchPlant();
        return $this->respond($branch, 200, "Success");
    }

    public function get_skus() : ResponseInterface
    {
        $ship_to 		= request()->getVar('cust_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$div_code	    = request()->getVar('div_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$branch_code	= request()->getVar('branch_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$order_type	    = request()->getVar('order_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $methods = $order_type == 1 ? [
            'getUTSSKUByCustomerPlantDivision' => [2, $ship_to, $branch_code, $div_code, 1],
            'getUTSSKUByCustomerDivision' => [2, $ship_to, $div_code, 1],
            'getUTSSKUByPlantDivision' => [2, $branch_code, $div_code, 1],
            'getUTSSKUByDivision' => [2, $div_code, 1]
        ] : [
            'getPromoItemByCustomerPlantDivision' => [$ship_to, $branch_code, $div_code],
            'getPromoItemByCustomerDivision' => [$ship_to, $div_code],
            'getPromoItemByPlantDivision' => [$branch_code, $div_code],
            'getPromoItemByDivision' => [$div_code]
        ];

        foreach($methods as $method => $params) {
            $skus = (new CustomModel())->$method(...$params);
            
            if($skus) {
                return $this->respond($skus, 200, "Success");
            }
        }

        return $this->respond([], 200, "No data available");
    }
}