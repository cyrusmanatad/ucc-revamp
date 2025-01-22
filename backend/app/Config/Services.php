<?php

namespace Config;

use App\Models\CustomModel;
use App\Models\SalesOrder;
use App\Repositories\CreateOrderRepository;
use App\Repositories\SalesOrderRepository;
use App\Services\CreateOrderService;
use App\Services\FinishGoodService;
use App\Services\SalesOrderService;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /*
     * public static function example($getShared = true)
     * {
     *     if ($getShared) {
     *         return static::getSharedInstance('example');
     *     }
     *
     *     return new \CodeIgniter\Example();
     * }
     */

    public static function salesOrderService($getShared = true) {
        
        if ($getShared) {
            return static::getSharedInstance('salesOrderService');
        }
        
        $model = new SalesOrder();
        $repository = new SalesOrderRepository($model);
        return new SalesOrderService($repository);
    }

    public static function createOrderService($getShared = true) {
        
        if ($getShared) {
            return static::getSharedInstance('createOrderService');
        }
        
        $model = new CustomModel();
        $skuService = new FinishGoodService($model);
        $repository = new CreateOrderRepository($model, $skuService);
        return new CreateOrderService($repository);
    }
}
