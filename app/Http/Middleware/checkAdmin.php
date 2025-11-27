<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // যদি লগইন না করা থাকে
        if (!Auth::check()) {
            // JSON request হলে JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'আপনাকে আগে লগইন করতে হবে।',
                ], 401);
            }

            return redirect()->route('login')
                ->with('error', 'আপনাকে আগে লগইন করতে হবে।');
        }

        $user = Auth::user();

        // যদি admin না হয়
        if (!$user->is_admin) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'আপনার এই পেইজে প্রবেশের অনুমতি নেই।',
                ], 403);
            }

            // আগের পেইজে error message নিয়ে ফেরত পাঠাবো
            return redirect()->back()
                ->with('error', 'আপনার এই পেইজে প্রবেশের অনুমতি নেই।');
        }

        // ✅ admin হলে request proceed করবে
        return $next($request);
    }
}

