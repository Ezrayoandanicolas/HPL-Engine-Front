<?php

if (!function_exists('storageUrl')) {
    function storageUrl(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        $base = rtrim((string) config('app.api_base_url', ''), '/');
        $base = preg_replace('#/api$#i', '', $base);

        return rtrim($base, '/') . '/storage/' . ltrim($path, '/');
    }
}

if (!function_exists('storageBaseUrl')) {
    function storageBaseUrl(): string
    {
        $base = rtrim((string) config('app.api_base_url', ''), '/');
        $base = preg_replace('#/api$#i', '', $base);

        return rtrim($base, '/') . '/storage/';
    }
}
