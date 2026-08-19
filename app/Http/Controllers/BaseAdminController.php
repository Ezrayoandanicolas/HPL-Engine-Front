<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

abstract class BaseAdminController extends Controller
{
    protected ApiService $api;

    public function __construct()
    {
        $this->api = app(ApiService::class);
    }

    protected function adminGet(string $endpoint, array $params = []): array
    {
        $params = array_merge($params, $this->getAuthParams());
        return $this->api->get("admin/{$endpoint}", $params);
    }

    protected function adminPost(string $endpoint, array $data = []): array
    {
        $data = array_merge($data, $this->getAuthParams());
        return $this->api->post("admin/{$endpoint}", $data);
    }

    protected function adminPut(string $endpoint, array $data = []): array
    {
        $data = array_merge($data, $this->getAuthParams());
        return $this->api->post("admin/{$endpoint}", $data);
    }

    protected function adminDelete(string $endpoint, array $params = []): array
    {
        return $this->api->delete("admin/{$endpoint}", $params);
    }

    protected function getAuthParams(): array
    {
        $params = [];
        if (session()->has('api_user')) {
            $params['user_id'] = session('api_user')['id'] ?? null;
        }
        return $params;
    }

    protected function uploadFileToApi(string $endpoint, array $multipart): array
    {
        return $this->api->postMultipart("admin/{$endpoint}", $multipart);
    }
}
