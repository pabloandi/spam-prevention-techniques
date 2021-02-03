<?php

namespace App\Http\Middleware;

class BlockSpam extends \App\Honeypot\BlockSpam
{
    protected function abort()
    {
        return response('overwrite abort response');
    }
}
