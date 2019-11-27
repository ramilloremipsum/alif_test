<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->increments('id');;
            $table->integer('box_id')->unsigned()->nullable(false);
            $table->string('title')->nullable(false);
            $table->string('description')->nullable(true);
            $table->timestamps();
            $table->unique(['title', 'box_id']); //У каждого шкафа должны быть ячейки с уникальными именами в пределах шкафа
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
