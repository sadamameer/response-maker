<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rm_logs', function (Blueprint $table) {
            $table->id();
            $table->string("request_endpoint");
            $table->longtext("request_headers");
            $table->longtext("request_params");
            $table->string("request_method");
            $table->integer("response_code");
            $table->longtext("response");
            $table->longtext("appended_values");
            $table->longtext("notes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rm_logs');
    }
}
