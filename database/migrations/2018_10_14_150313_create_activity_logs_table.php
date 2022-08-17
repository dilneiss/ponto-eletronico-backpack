<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('newTypeLog');
            $table->char('oldTypeLog');
            $table->timestamp('dateLog');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->bigInteger('edited_by')->references('id')->on('users');
            $table->bigInteger('owner')->references('id')->on('users');
            $table->bigInteger('record_id')->references('record_id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
}
