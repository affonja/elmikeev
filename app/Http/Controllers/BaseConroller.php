<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseConroller extends Controller
{
    protected $endpoint;
    protected $apiService;
    protected $model;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getData(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'dateFrom' => 'required|date',
            'dateTo' => 'date'
        ]);

        $params = array_merge($validated, [
            'method' => 'GET',
            'limit' => 500,
            'page' => 1,
        ]);

        do {
            $data = $this->apiService->getData($this->endpoint, $params);
            if ($data === null) {
                return response()->json(['message' => 'upload error'], 500);
            }

            $partData = [];
            foreach ($data['data'] as $item) {
                $partData[] = $item;
            }
            $this->model::insert($partData);

            $params['page']++;
        } while ($data['links']['next'] !== null);


        return response()->json(['message' => 'upload ok'], 200);
    }

}
