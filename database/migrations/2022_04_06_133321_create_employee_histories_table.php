<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama')->nullable();
            $table->string('institusi')->nullable();
            $table->string('kota')->nullable();
            $table->date('tanggalbergabung')->nullable();
            $table->date('tanggalresign')->nullable();
            $table->string('status')->nullable();
            $table->integer('positionid')->nullable();
            $table->string('lembur')->nullable();
            $table->string('grade')->nullable();
            $table->string('grup')->nullable();
            $table->unsignedInteger('divisi')->nullable();
            $table->string('inchargestatus')->nullable();
            $table->string('norek')->nullable();
            $table->text('npwp')->nullable();
            $table->string('statusptkp')->nullable();
            $table->integer('gajipokok')->nullable();
            $table->integer('tunjanganjabatan')->nullable();
            $table->integer('tunjangankesehatan')->nullable();
            $table->integer('tunjanganlain')->nullable();
            $table->integer('tarifthhari')->nullable();
            $table->integer('tariftransportasi')->nullable();
            $table->integer('tarifmakanlembur')->nullable();
            $table->integer('persenbpjskesehatan')->nullable();
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
        Schema::dropIfExists('employee_histories');
    }
}
