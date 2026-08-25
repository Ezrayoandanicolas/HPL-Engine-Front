<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Services\TrafficLogger;

class LogTraffic
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        try {
            // Skip jika sudah login
            if (Auth::check()) return $response;

            $path = $request->path();

            // Skip API, admin, assets, AJAX polling
            if (str_starts_with($path, 'api/') ||
                str_starts_with($path, 'admin') ||
                str_contains($path, '.css') ||
                str_contains($path, '.js') ||
                str_contains($path, '.png') ||
                str_contains($path, '.jpg') ||
                str_contains($path, '.ico') ||
                str_contains($path, 'favicon') ||
                $path === 'balance' ||
                $path === 'session/online') {
                return $response;
            }

            // Deduplicate: log max 1x per IP per 30 menit
            $ip = $request->ip();
            $cacheKey = "traffic_log_{$ip}";
            if (Cache::has($cacheKey)) return $response;
            Cache::put($cacheKey, true, 1800); // 30 menit

            $ua = $request->userAgent() ?? '';
            $logger = app(TrafficLogger::class);
            $type = $logger->detectType($ua);
            $logger->send($request, $type);
        } catch (\Exception $e) {
            // silent fail
        }

        return $response;
    }
}
