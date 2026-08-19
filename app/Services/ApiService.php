<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiService
{
    private Client $client;
    private string $baseUrl;
    private ?string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.api_base_url', 'http://127.0.0.1:8001/api'), '/');
        $this->apiKey = config('app.api_key');
        $this->client = new Client([
            'timeout' => 10,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
                'X-API-Key' => $this->apiKey ?? '',
            ]
        ]);
    }

    private function withUserId(array $params): array
    {
        if (isset($params['user_id'])) {
            return $params;
        }
        if (Auth::check()) {
            $params['user_id'] = Auth::id();
        }
        return $params;
    }

    public function get(string $endpoint, array $params = []): array
    {
        try {
            $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
            $response = $this->client->get($url, ['query' => $this->withUserId($params)]);
            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            Log::error('API GET Error: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    public function post(string $endpoint, array $data = []): array
    {
        try {
            $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
            $response = $this->client->post($url, ['form_params' => $this->withUserId($data)]);
            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            Log::error('API POST Error: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    public function postMultipart(string $endpoint, array $multipart): array
    {
        try {
            $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
            $response = $this->client->post($url, ['multipart' => $multipart]);
            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            Log::error('API POST Multipart Error: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    public function delete(string $endpoint, array $params = []): array
    {
        try {
            $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
            $response = $this->client->delete($url, ['query' => $this->withUserId($params)]);
            return $this->handleResponse($response);
        } catch (GuzzleException $e) {
            Log::error('API DELETE Error: ' . $e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    private function handleResponse($response): array
    {
        $body = json_decode($response->getBody(), true);
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode < 300) {
            return $body ?? ['success' => true];
        }

        Log::error('API Error Response: ' . json_encode($body));
        return $body ?? ['success' => false, 'message' => 'Unknown error'];
    }

    private function errorResponse(string $message): array
    {
        return [
            'success' => false,
            'message' => 'API Connection Error: ' . $message,
            'data' => null
        ];
    }
}
