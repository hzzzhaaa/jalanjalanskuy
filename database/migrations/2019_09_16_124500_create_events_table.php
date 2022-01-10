<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->text('name');
            $table->longText('description');
            $table->text('location');
            $table->string('image');
            $table->date('date');
            $table->time('timeStart');
            $table->time('timeEnd')->nullable();
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers')->onDelete('cascade');
            // $table->unsignedBigInteger('feature_id');
            // $table->foreign('feature_id')->references('id')->on('feature_groups');  //features_group
            $table->boolean('finished')->nullable();
            $table->boolean('approved')->nullable();
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
