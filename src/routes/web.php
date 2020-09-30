<?php

use Illuminate\Support\Facades\Route;
use Laracodes\ResponseMaker\http\libs\Helper;
use Laracodes\ResponseMaker\http\middlewares\RmWare;

$helper     =   new Helper;
$namespace  =   "Laracodes\ResponseMaker\http\controllers";
$baseUrl    =   $helper->getStaticPrefixRoute();
$config     =   [
                    "namespace"  => $namespace,
                    'middleware' => RmWare::class,
                    'prefix'     => $baseUrl,
                    'as'         => $baseUrl.'.'
                ];

Route::group($config, function(){
    Route::get("/" , function(){
        return "ok";
    })->name("index");
});