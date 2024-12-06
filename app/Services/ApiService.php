<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    protected $client;
    const HTTP_OK = 200;
    const PROTOCOL = 'http://';
    const HOST = '89.108.115.241';
    const PORT = '6969';
    const API_KEY = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getData(string $url, array $params): array
    {
        $allData = [];
        $page = 1;

        do {
            $params['page'] = $page;
            $queryParams = $this->buildQueryParams($params);

            try {
                $response = $this->sendRequest($url, $queryParams);
                $data = $this->processResponse($response);

                if (isset($data['data'])) {
                    $allData = array_merge($allData, $data['data']);
                }

                $hasMorePages = isset($data['links']['next']);
                $page++;
            } catch (Exception $e) {
                throw new Exception("Ошибка на странице {$page}: " . $e->getMessage());
            }
        } while ($hasMorePages);

        return $allData;
    }

    public function buildQueryParams(array $params): array
    {
//        return [
//            'dateFrom' => $params['dateFrom'],
//            'dateTo' => '',
//            'page' => 1,
//            'key' => self::API_KEY,
//            'limit' => 1,
//        ];
        $params['key'] = self::API_KEY;
        $params['limit'] = $params['limit'] ?? 500;
        return $params;
    }

    public function sendRequest(string $url, array $params)
    {
        $response = $this->client->get(self::PROTOCOL . self::HOST . ':' . self::PORT . $url, [
            'query' => $params,
        ]);
        if ($response->getStatusCode() !== self::HTTP_OK) {
            throw new Exception('Ошибка запроса: ' . $response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }

    public function processResponse(string $response): array
    {
        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Ошибка обработки JSON: ' . json_last_error_msg());
        }

        return $data;
    }


}
