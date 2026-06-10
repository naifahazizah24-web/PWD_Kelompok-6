<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class QueueTrafficMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $maxActiveUsers = 200; 

        $activeSessions = count(Redis::keys('active_session:*'));

        if ($activeSessions >= $maxActiveUsers) {
            return response()->json([
                'status' => 'waiting_room',
                'message' => 'Traffic sangat padat. Anda dialihkan ke ruang tunggu antrean.',
                'redirect_url' => '/queue/waiting-room'
            ], 429);
        }

        return $next($request);
    }
}