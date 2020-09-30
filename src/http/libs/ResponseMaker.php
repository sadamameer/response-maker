<?php

namespace Laracodes\ResponseMaker\http\libs;

use Laracodes\ResponseMaker\models\RmLog;
use Laracodes\ResponseMaker\http\traits\RmTrait;
use Laracodes\ResponseMaker\http\interfaces\RmInterface;

class ResponseMaker implements RmInterface
{
    use RmTrait;

    protected $_request          = "";
    protected $_request_endpoint = "";
    protected $_request_headers  = "";
    protected $_request_params   = "";
    protected $_request_method   = "";
    protected $_response_code    = "";
    protected $_response         = "";
    protected $_appended_values  = "";
    protected $_notes            = "";
    protected $_log              = "";

    public function __construct() {
        $this->_logging  = config("rm.rm_logging");
        $this->_request  = request();
        $this->_log      = new RmLog();
    }

    public function log(){

        $this->_request_endpoint = $this->_request->path();
        $this->_request_headers  = $this->_request->headers->all();
        $this->_request_params   = $this->_request->all();
        $this->_request_method   = $this->_request->method();
        $this->_response_code    = $this->_code;
        $this->_response         = $this->_responseArray;
        $this->_appended_values  = $this->_appends;
        $this->_notes            = $this->_message;
        
        return $this->_log->create($this);
    }

    public function get_request_endpoint()
    {
        return $this->_request_endpoint;
    }

    public function get_request_headers()
    {
        return json_encode($this->_request_headers);
    }

    public function get_request_params()
    {
        return json_encode($this->_request_params);
    }

    public function get_request_method()
    {
        return $this->_request_method;
    }

    public function get_response_code()
    {
        return $this->_response_code;
    }

    public function get_response()
    {
        return json_encode($this->_response);
    }

    public function get_appended_values()
    {
        return json_encode($this->_appended_values);
    }

    public function get_notes()
    {
        return $this->_notes;
    }

}