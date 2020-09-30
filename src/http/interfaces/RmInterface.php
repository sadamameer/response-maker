<?php

namespace Laracodes\ResponseMaker\http\interfaces;

interface RmInterface
{
    public function setHttpCode($content);
    public function setCode($content);
    public function setMessage($content);
    public function setAppends($content);
    public function send($content);
    public function log();
}