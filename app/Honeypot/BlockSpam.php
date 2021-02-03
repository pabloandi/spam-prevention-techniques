<?php

namespace App\Honeypot;

use Closure;
use Illuminate\Http\Request;

class BlockSpam
{
    protected $honeypot;

    public function __construct(Honeypot $honeypot) {
        $this->honeypot = $honeypot;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->honeypot->detect()){
            return $this->honeypot->abort();
        }

        return $next($request);
    }

}
