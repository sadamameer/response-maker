<?php

namespace Laracodes\ResponseMaker\http\middlewares;

use Closure;

class RmWare{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

}