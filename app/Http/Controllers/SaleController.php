<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class SaleController extends BaseConroller
{
    protected $model = Sale::class;
    protected $url = '/api/sales';
}
