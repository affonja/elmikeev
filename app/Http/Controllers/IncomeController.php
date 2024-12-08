<?php

namespace App\Http\Controllers;


use App\Models\Income;

class IncomeController extends BaseConroller
{
    protected $model = Income::class;
    protected $url = '/api/incomes';
}
