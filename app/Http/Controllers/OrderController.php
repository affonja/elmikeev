<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends BaseConroller
{
    protected $model = Order::class;
    protected $endpoint = '/api/orders';
}
