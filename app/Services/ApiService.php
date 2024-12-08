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

    public function getData(string $url, array $params): ?array
    {
        $queryParams = $this->buildQueryParams($params);

        try {
            $response = $this->sendRequest($url, $queryParams);
            $data = $this->processResponse($response);
        } catch (Exception $e) {
            throw new Exception("Ошибка: " . $e->getMessage());
        }

        if (isset($data['data'])) {
            return $data;
        }
        return null;
    }

    public function buildQueryParams(array $params): array
    {
        $params['key'] = self::API_KEY;
        $params['limit'] = $params['limit'] ?? 500;
        $params['page'] = $params['page'] ?? 1;
        return $params;
    }

    public function sendRequest(string $url, array $params)
    {
        $response = $this->client->request($params['method'], self::PROTOCOL . self::HOST . ':' . self::PORT . $url, [
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
