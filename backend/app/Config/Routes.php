<?php

use App\Controllers\Api\Auth\AuthController;
use App\Controllers\API\CreateOrderController;
use App\Controllers\API\SalesOrderController;
use App\Controllers\Home;
use App\Controllers\OrderEntry;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

$routes->group('api', static function (RouteCollection $routes): void {

    $routes->options('new-order-details/type', [CreateOrderController::class, 'getOrderType']);
    $routes->get('new-order-details/type', [CreateOrderController::class, 'getOrderType']);

    $routes->options('new-order-details/branch_plant', [CreateOrderController::class, 'getDivisions']);
    $routes->get('new-order-details/branch_plant', [CreateOrderController::class, 'getDivisions']);
    
    $routes->options('new-order-details/divisions/(:num)', [CreateOrderController::class, 'getCustomers']);
    $routes->get('new-order-details/divisions/(:num)', [CreateOrderController::class, 'getCustomers']);
    
    $routes->options('new-order-details/customers/(:num)/(:num)', [CreateOrderController::class, 'getBranchPlant']);
    $routes->get('new-order-details/customers/(:num)/(:num)', [CreateOrderController::class, 'getBranchPlant']);
    
    $routes->options('new-order-details/delivery_mode', [CreateOrderController::class, 'getDeliveryMode']);
    $routes->get('new-order-details/delivery_mode', [CreateOrderController::class, 'getDeliveryMode']);
    
    $routes->options('new-order-details/skus', [CreateOrderController::class, 'getSkus']);
    $routes->post('new-order-details/skus', [CreateOrderController::class, 'getSkus']);

    $routes->get('orders', [SalesOrderController::class, 'index']);
    $routes->get('orders/(:any)', [SalesOrderController::class, 'show']);    
});

$routes->group('api', ['namespace'=> 'App\Controllers\Api\Auth'], static function ($routes) {

    // Public routes
    $routes->post('auth/login', [AuthController::class, 'login']);
    $routes->post('auth/refresh', [AuthController::class, 'refresh']);
    
    $routes->post('user', [AuthController::class, 'createUser']);

});