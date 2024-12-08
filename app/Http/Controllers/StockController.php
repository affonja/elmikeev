<?php

namespace App\Http\Controllers;

use App\Models\Stock;


class StockController extends BaseConroller
{
    protected $model = Stock::class;
    protected $url = '/api/stocks';
}
