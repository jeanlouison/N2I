<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 512)->unique();
            $table->string('pseudo', 30)->unique();
            $table->string('password', 256);
            $table->integer('age')->nullable();
            $table->enum('formation', ['BAC', 'BAC+1', 'BAC+2', 'BAC+3', 'BAC+4', 'BAC+5', 'BAC+6', 'BAC+7', 'BAC+8'])->nullable();
            $table->string('city', 128)->nullable();
            $table->string('description', 512);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
