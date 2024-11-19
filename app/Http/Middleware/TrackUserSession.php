<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TrackUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check()) {
            // Check for an active session
            $userSession = DB::table('user_sessions')
                ->where('user_id', auth()->id())
                ->whereNull('end_time')
                ->first();

            // If no active session, start a new session
            if (!$userSession) {
                DB::table('user_sessions')->insert([
                    'user_id' => auth()->id(),
                    'start_time' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        return $response;
    }

    /**
     * Terminate the session when the response is completed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function terminate(Request $request, $response)
    {
        if (auth()->check()) {
            // Update the end_time of the session
            DB::table('user_sessions')
                ->where('user_id', auth()->id())
                ->whereNull('end_time')
                ->update([
                    'end_time' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }
    }
}
