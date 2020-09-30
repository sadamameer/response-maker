<?php

return [
    "rm_base_url"      => env("RM_BASE_URL"),
    "rm_db_connection" => env("RM_DB_CONNECTION") ?? env("DB_DATABASE"),
    "rm_logging"       => env("RM_LOGGING"),
];