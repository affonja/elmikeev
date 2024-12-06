<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Services\ApiService;

class StockController extends Controller
{
    const URL = '/api/stocks';
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getStocks(Request $request)
    {
        $validated = $request->validate([
            'dateFrom' => 'required|date'
        ]);

        $stocks = $this->apiService->getData(self::URL, $validated);

        foreach ($stocks as $stock) {
            $this->saveStock($stock);
        }

        return response()->json(['message' => 'Данные загружены'], 200);
    }

    protected function saveStock(array $stockData)
    {
        Stock::updateOrCreate($stockData);
    }
}
