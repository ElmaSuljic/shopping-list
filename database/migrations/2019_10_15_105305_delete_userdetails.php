<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUserdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('userdetails');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::create('userdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('userId');
			$table->string('usertype');
            $table->timestamps();
        });
    }
}
