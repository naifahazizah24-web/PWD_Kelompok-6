<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\JsonResponse;

class QueueController extends Controller
{

    public function joinQueue(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $timestamp = microtime(true);

        Redis::zadd('ticket_queue', $timestamp, $userId);

        return response()->json([
            'status' => 'success',
            'message' => 'Anda berhasil masuk dalam daftar antrean.',
            'joined_at' => $timestamp
        ]);
    }

    public function checkStatus(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $position = Redis::zrank('ticket_queue', $userId);

        if ($position === null) {
            return response()->json([
                'status' => 'ready',
                'message' => 'Giliran Anda tiba! Mengalihkan ke halaman pembelian.'
            ]);
        }

        $estimatedSeconds = ($position + 1) * 3;

        return response()->json([
            'status' => 'waiting',
            'queue_number' => $position + 1,
            'estimated_wait_time_minutes' => ceil($estimatedSeconds / 60)
        ]);
    }
}