<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use DateTime;
use App\Models\MasterAccessLog;
use Ramsey\Uuid\Uuid;

class AccessLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $set = new MasterAccessLog;
        $set->id      = Uuid::uuid4();
        $set->url = $request->fullUrl();
        $set->method = $request->method();
        $set->path = $request->path();
        $set->ip = $request->getClientIp();
        $set->agent = $request->header('user-agent');
        $set->created_by = Auth::user()->username;
        $set->save();

        return $response;
    }
}
