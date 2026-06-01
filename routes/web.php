<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\BuyerController;
use App\Controllers\DatabaseController;
use App\Controllers\OfferController;
use App\Controllers\OrderController;
use App\Controllers\PageController;
use App\Controllers\ProviderController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;

$router->get('/', [PageController::class, 'landing']);
$router->get('/mongodb/status', [DatabaseController::class, 'status']);

$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

$router->get('/buyer/dashboard', [BuyerController::class, 'dashboard'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'buyer'],
]);
$router->get('/buyer/offers', [OfferController::class, 'buyerIndex'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'buyer'],
]);
$router->get('/buyer/orders/create', [OrderController::class, 'create'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'buyer'],
]);
$router->post('/buyer/orders/store', [OrderController::class, 'store'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'buyer'],
]);
$router->get('/buyer/orders/history', [BuyerController::class, 'orderHistory'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'buyer'],
]);

$router->get('/provider/dashboard', [ProviderController::class, 'dashboard'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->get('/provider/offers', [OfferController::class, 'providerIndex'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->get('/provider/offers/create', [OfferController::class, 'create'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->post('/provider/offers/store', [OfferController::class, 'store'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->get('/provider/orders/history', [ProviderController::class, 'deliveryHistory'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->post('/provider/orders/accept', [ProviderController::class, 'acceptOrder'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);
$router->post('/provider/orders/complete', [ProviderController::class, 'completeOrder'], [
    AuthMiddleware::class,
    [RoleMiddleware::class, 'provider'],
]);

$router->get('/orders', [OrderController::class, 'index'], [AuthMiddleware::class]);
$router->get('/orders/summary/avg-service-fee', [OrderController::class, 'averageServiceFee'], [AuthMiddleware::class]);
