<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastertimereportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mastertimereports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timereportheadid');
            $table->string('nip');
            $table->date('date');
            $table->string('day');
            $table->integer('week')->nullable();
            $table->string('task');
            $table->string('activities');
            $table->string('clientid');
            $table->timestamp('normalhours');
            $table->timestamp('starttime');
            $table->decimal('finishtime');
            $table->decimal('overtimes')->nullable();
            $table->decimal('lateovertime')->nullable();
            $table->decimal('ineffectivehours')->nullable();
            $table->string('ineffectiverules')->nullable();
            $table->decimal('editineffective')->nullable();
            $table->string('editedby')->nullable();
            $table->integer('period');
            $table->text('description')->nullable();
            $table->decimal('overtimemeal')->nullable();
            $table->decimal('overtimetransportation')->nullable();
            $table->boolean('is_business_trip')->nullable();
            $table->boolean('approved_by_incharge')->nullable();
            $table->boolean('approved_by_hr')->nullable();
            $table->boolean('approved_by_partner')->nullable();
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

//             'date' => 'required',
//            'day' => 'required',
//            'client' => 'required',
//            'task' => 'required',
//            'description' => 'required|max:255',
//            'starttask' => 'required',
//            'endtask' => 'required',
