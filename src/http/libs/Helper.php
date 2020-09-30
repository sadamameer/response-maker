<?php

namespace Laracodes\ResponseMaker\http\libs;

use Illuminate\Http\Request;

class Helper{

    protected $request;

    public function __construct() {
        $this->request  = request();
    }

    public function getStaticPrefixRoute()
    {
        return config("rm.rm_base_url");
    }
}