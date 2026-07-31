<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Support\Facades\Auth;

abstract class FrontendController extends Controller
{
    protected ApiService $api;

    public function __construct()
    {
        $this->api = app(ApiService::class);
    }

    protected function fetchPage(string $page, array $extra = []): array
    {
        $params = $extra;
        if (Auth::check()) {
            $params['user_id'] = Auth::id();
        }
        $response = $this->api->get("page/{$page}", $params);
        $data = $response['data'] ?? [];

        // Deep convert all arrays to objects to match Eloquent model access ($obj->prop)
        $data = json_decode(json_encode($data));

        // Normalize banner fields: API uses Judul, views use title
        if (isset($data->banner) && is_array($data->banner)) {
            $data->banner = array_map(function ($b) {
                return (object) [
                    'id' => $b->id ?? null,
                    'title' => $b->Judul ?? '',
                    'img' => $b->img ?? '',
                    'link' => $b->link ?? '',
                ];
            }, $data->banner);
        }

        return (array) $data;
    }

    protected function apiGet(string $endpoint, array $params = []): array
    {
        if (Auth::check()) {
            $params['user_id'] = Auth::id();
        }
        return $this->api->get(ltrim($endpoint, '/'), $params);
    }

    protected function apiPost(string $endpoint, array $data = []): array
    {
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }
        return $this->api->post(ltrim($endpoint, '/'), $data);
    }

    protected function formatBalance($balance): string
    {
        if ($balance == 0) return '0,00';
        $formattedBalance = number_format($balance, 2, ',', '.');
        if ($balance < 1000 && $balance > 0) {
            return '0' . '.' . substr_replace($formattedBalance, '', -4);
        }
        return substr_replace($formattedBalance, '', -4);
    }
}
