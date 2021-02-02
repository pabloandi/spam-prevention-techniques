<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSpam
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
        if(! $request->has('myname')){
            abort(422, 'Spam detected.');
        }

        if(! empty($request->get('myname'))) {
            abort(422, 'Spam detected.');
        }

        $now = microtime(true);

        $elapse = $now - $request->get('mytime');

        if($elapse <= 3){
            abort(422, 'Spam detected.');
        }

        return $next($request);
    }
}
