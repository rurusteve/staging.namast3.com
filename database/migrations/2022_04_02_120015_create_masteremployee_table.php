<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasteremployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masteremployee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama');
            $table->string('institusi');
            $table->string('kota');
            $table->date('tanggalbergabung');
            $table->date('tanggalresign');
            $table->string('status');
            $table->integer('positionid');
            $table->string('lembur');
            $table->string('grade');
            $table->string('grup');
            $table->unsignedInteger('divisi');
            $table->string('inchargestatus');
            $table->string('norek');
            $table->text('npwp');
            $table->string('statusptkp');
            $table->integer('gajipokok');
            $table->integer('tunjanganjabatan');
            $table->integer('tunjangankesehatan');
            $table->integer('tunjanganlain');
            $table->integer('tarifthhari');
            $table->integer('tariftransportasi');
            $table->integer('tarifmakanlembur');
            $table->integer('persenbpjskesehatan');
            $table->timestamps();
            $table->foreign('divisi')->references('id')->on('groups');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masteremployees');
    }
}
