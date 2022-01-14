<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('payment_type');
            $table->string('payment_image',191)->nullable();
            $table->string('name_of_bank',255)->nullable();
            $table->string('name_of_account',255)->nullable();
            $table->string('account_number',255)->nullable();
            $table->string('payment_email')->nullable();
            $table->tinyInteger('gift');
            $table->tinyInteger('registry');
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
        Schema::dropIfExists('event_gifts');
    }
}
