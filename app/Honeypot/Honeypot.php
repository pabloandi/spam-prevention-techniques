<?php

namespace App\Honeypot;

use Illuminate\Http\Request;

class Honeypot
{
    protected $request;

    static public $response;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function enabled()
    {
        return config('honeypot.enabled');
    }

    public function detect()
    {
        if(! $this->enabled()){
            return false;
        }

        if(! $this->request->has(config('honeypot.field_name'))) {
            return true;
        }

        if(! empty($this->request->get(config('honeypot.field_name')))) {
            return true;
        }

        if($this->timeToSubmitForm() <= config('honeypot.minimum_time')) {
            return true;
        }
    }

    public function abort()
    {
        if (static::$response){
            return call_user_func(static::$response);
        }

        return abort(422, 'Spam detected.');
    }

    public static function abortUsing(callable $response)
    {
        static::$response = $response;
    }

    protected function timeToSubmitForm() : float
    {
        return (microtime(true) - $this->request->get(config('honeypot.field_time_name')));
    }
}
