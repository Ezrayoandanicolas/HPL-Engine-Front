<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\TrafficLogger;

class LogTraffic
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        try {
            $ua = $request->userAgent() ?? '';
            $logger = app(TrafficLogger::class);
            $type = $logger->detectType($ua);

            // Nonaktifkan logging untuk request API/auth/assets
            $path = $request->path();
            if (!str_starts_with($path, 'api/') &&
                !str_starts_with($path, 'admin') &&
                !str_contains($path, '.css') &&
                !str_contains($path, '.js') &&
                !str_contains($path, '.png') &&
                !str_contains($path, '.jpg') &&
                !str_contains($path, '.ico') &&
                !str_contains($path, 'favicon')) {

                $logger->send($request, $type);
            }
        } catch (\Exception $e) {
            // silent fail
        }

        return $response;
    }
}
