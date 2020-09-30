<?php

namespace Laracodes\ResponseMaker\http\traits;

use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait RmTrait {

    protected $_data          = [];
    protected $_appends       = [];
    protected $_responseArray = [];
    protected $_HttpCode      = "200";
    protected $_code          = "200";
    protected $_message       = "Success";
    protected $_logging       = "";

    public function setHttpCode($code)
    {
        $this->_code     = $code;
        $this->_HttpCode = $code;
        return $this;
    }

    public function setCode($code)
    {
        $this->_code = $code;
        return $this;
    }

    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    public function setAppends($appends = false)
    {
        if (!$appends) { return $this; }

        if ($appends instanceof LengthAwarePaginator) {
            throw new InvalidArgumentException('Appends should only be string, array, object or a collection.');
        }
        elseif (is_array($appends)) {
            foreach ($appends as $key => $val) {
                if ($val instanceof LengthAwarePaginator) {
                    throw new InvalidArgumentException('LengthAwarePaginator is allowed in appends. Please send associated array.');
                }
            }
            $this->_appends['appends'] = $appends;
        } elseif ($appends instanceof Collection) {
            $this->_appends['appends'] = $appends->toArray();
        } elseif (is_object($appends)) {
            $this->_appends['appends'] = $appends->toArray();
        } elseif ($appends) {
            $this->_appends['appends'] = $appends;
        }

        return $this;
    }

    public function send($data = false)
    {
        if ($data instanceof LengthAwarePaginator) {
            $data                         = $data->toArray();
            $array['data']                = $data['data'];
            unset($data['data']);
            $this->_responseArray['meta'] = $data;
            $this->_data                  = $array;
        }
        elseif (is_array($data)) {
            $i = 0;
            foreach ($data as $key => $val) {
                if ($val instanceof LengthAwarePaginator) {
                    $i++;
                    $val                            = $val->toArray();
                    $array                          = $val['data'];
                    unset($val['data']);
                    $this->_responseArray['meta']   = $val;
                    $data[$key] = $array;
                }
            }

            if($i > 1) { throw new InvalidArgumentException('One LengthAwarePaginator is allowed only.');}

            $this->_data['data'] = $data;
        } elseif ($data instanceof Collection) {
            $this->_data['data'] = $data->toArray();
        } elseif (is_object($data)) {
            $this->_data['data'] = $data->toArray();
        } elseif ($data) {
            $this->_data['data'] = $data;
        }

        $this->_responseArray['code']    = (string) $this->_code;
        $this->_responseArray['message'] = (string) $this->_message;
        $this->_responseArray            = array_merge($this->_responseArray, $this->_data, $this->_appends);

        if($this->_logging){
            $this->log();
        }
        
        response()->json($this->_responseArray, $this->_HttpCode)->send();

        die();
    }
}