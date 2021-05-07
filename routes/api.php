<?php

use App\Http\Controllers\ProductController;
use Illuminate\Routing\Router;

/** @var Router $router */

$router->get('v1/products', [ProductController::class, 'index']);
