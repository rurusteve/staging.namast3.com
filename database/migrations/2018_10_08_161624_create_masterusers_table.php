<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('positionid');
            $table->string('name');
            $table->string('email');
            $table->string('password')->unique();
            $table->date('joindate');
            $table->string('institution');
            $table->string('city');
            $table->string('status');
            $table->integer('salary');
            $table->integer('positionallowance');
            $table->integer('healthallowance');
            $table->integer('additionalallowance');
            $table->integer('transportfee');
            $table->integer('overtimefee');
            $table->string('grade');
            $table->integer('bankaccount');
            $table->string('npwp');
            $table->string('ptkp');
            $table->string('remember_token');
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
    }
}
