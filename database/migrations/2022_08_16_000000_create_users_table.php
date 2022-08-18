<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf', 11)->unique();
            $table->string('email')->unique();
            $table->bigInteger('role_id')->default(2)->unsigned();
            $table->date('birhdate')->nullable(false);
            $table->string('zip_code', 8)->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('address_number')->nullable(false);
            $table->string('district')->nullable(false);
            $table->string('complement')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('uf')->nullable(false);
            $table->string('password');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
