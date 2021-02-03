<?php

namespace App\Honeypot;

use Closure;
use Illuminate\Http\Request;

class Honeypot
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
        if(! config('honeypot.enabled')){
            return $next($request);
        }

        if(! $request->has(config('honeypot.field_name'))){
            return $this->abort();
        }

        if(! empty($request->get(config('honeypot.field_name')))) {
            return $this->abort();
        }

        if($this->timeToSubmitForm($request) <= config('honeypot.minimum_time')){
            return $this->abort();
        }

        return $next($request);
    }

    protected function timeToSubmitForm(Request $request) : float
    {
        return (microtime(true) - $request->get(config('honeypot.field_time_name')));
    }

    protected function abort()
    {
        return abort(422, 'Spam detected.');
    }
}
