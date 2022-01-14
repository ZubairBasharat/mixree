<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('eve_name')->nullable();
            $table->string('icon')->nullable();
            $table->string('groom_img')->nullable();
            $table->string('groom_first_name');
            $table->string('groom_last_name')->nullable();
            $table->string('bride_img')->nullable();
            $table->string('bride_first_name');
            $table->string('bride_last_name')->nullable();
            $table->text('guest_note')->nullable();
            $table->text('story')->nullable();
            $table->string('bg_img')->nullable();
            $table->string('no_of_days');
            $table->int('no_of_witness');
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
        Schema::dropIfExists('event_details');
    }
}
