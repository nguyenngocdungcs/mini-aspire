<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogMiddleware
{
    const LOG_DATA_NONE = 'none';
    const LOG_DATA_REQUEST = 'request';
    const LOG_DATA_RESPONSE = 'response';
    const LOG_DATA_ALL = 'all';

    protected $logData;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $logData
     * @return mixed
     */
    public function handle($request, Closure $next, $logData = self::LOG_DATA_NONE)
    {
        $this->logData = $logData;
        if ($logData == self::LOG_DATA_REQUEST || $logData == self::LOG_DATA_ALL) {
            Log::info('API|REQUEST|' . $request->ip() . '|' . $request->path() . '|', array_except($request->all(), ['password', 'token']));
        } else {
            Log::info('API|REQUEST|' . $request->ip() . '|' . $request->path());
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $content = json_decode($response->getContent(), true);
        if ($content && ($this->logData == self::LOG_DATA_ALL || $this->logData == self::LOG_DATA_RESPONSE)) {
            Log::info('API|RESPONSE|' . $request->ip() . '|' . $request->path() . '|', $content);
        } else {
            Log::info('API|RESPONSE|' . $request->ip() . '|' . $request->path());
        }
    }

}
