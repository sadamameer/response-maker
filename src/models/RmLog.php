<?php

namespace Laracodes\ResponseMaker\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracodes\ResponseMaker\http\libs\ResponseMaker;

class RmLog extends Model
{
    protected $connection = "";

    protected $fillable = [
        "request_endpoint",
        "request_headers",
        "request_params",
        "request_method",
        "response_code",
        "response",
        "appended_values",
        "notes"
    ];

    public function __construct() {
        $this->connection = config("rm.rm_db_connection");
    }

    public function create(ResponseMaker $rm)
    {
        $data = [
            "request_endpoint" => ($rm->get_request_endpoint()) ?? "",
            "request_headers"  => ($rm->get_request_headers())  ?? "",
            "request_params"   => ($rm->get_request_params())   ?? "",
            "request_method"   => ($rm->get_request_method())   ?? "",
            "response_code"    => ($rm->get_response_code())    ?? "",
            "response"         => ($rm->get_response())         ?? "",
            "appended_values"  => ($rm->get_appended_values())  ?? "",
            "notes"            => ($rm->get_notes())            ?? "",
            "created_at"       => Carbon::now(),
            "updated_at"       => Carbon::now()
        ];

        try {
            $this->insert($data);
        } catch (\Throwable $th) {
            // throw $th;
        }
        
        return true;
    }
}