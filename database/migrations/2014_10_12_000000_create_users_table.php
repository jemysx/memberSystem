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
         Schema::create('user_auth', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_code', 20)->unique();
            $table->string('user_name', 30);
            $table->char('user_role', 1);
            $table->integer('is_youkou');
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
        Schema::dropIfExists('user_auth');
    }
}
