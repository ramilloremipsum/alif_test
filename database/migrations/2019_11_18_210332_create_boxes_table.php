<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workplace_id')->unsigned()->nullable(false);
            $table->string('title')->nullable(false)->unique();
            $table->string('description')->nullable(true);
            $table->timestamps();

            $table->unique(['title', 'workplace_id']); //У каждого рабочего места должны быть шкафы с уникальными именами в пределах рабочего места
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes');
    }
}
