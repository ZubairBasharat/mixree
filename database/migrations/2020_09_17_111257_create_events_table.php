s<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('type', 100);
            $table->integer('days')->nullable();
            $table->tinyInteger('collect_info')->default(0);
            $table->tinyInteger('need_reservation');
            $table->tinyInteger('food_type')->default(0);
            $table->string('event_code', 100);
            $table->tinyInteger('fashion')->default(0);
            $table->tinyInteger('registry')->default(0);
            $table->tinyInteger('gift')->default(0);
            $table->integer('completion_bit');
            $table->date('start_date_event')->nullable();
            $table->date('end_date_event')->nullable();
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
        Schema::dropIfExists('events');
    }
}
