<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->logRequest($request, $response);
    }

    private function logRequest($request, $response)
    {
        $ip = $request->ip();
        $method = $request->method();
        $uri = $request->getRequestUri();
        $status = $response->getStatusCode();
        $size = strlen($response->getContent());
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $date = now()->format('d/m/Y:H:i:s O');
        $logMessage = sprintf('%s - - [%s] "%s %s %s" %d %d', $ip, $date, $method, $uri, 'HTTP/1.1', $status, $size);

        Log::channel('api')->info($logMessage);
    }
}
