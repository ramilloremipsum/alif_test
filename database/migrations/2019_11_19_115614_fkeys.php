<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->foreign('workplace_id', 'fk-boxes-workplaces')->references('id')->on('workplaces')->onDelete('cascade');
        });
        Schema::table('cells', function (Blueprint $table) {
            $table->foreign('box_id', 'fk-cells-boxes')->references('id')->on('boxes')->onDelete('cascade');
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->foreign('cell_id', 'fk-folders-cells')->references('id')->on('cells')->onDelete('cascade');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('folder_id', 'fk-documents-folders')->references('id')->on('folders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->dropForeign('fk-boxes-workplaces');
        });
        Schema::table('cells', function (Blueprint $table) {
            $table->dropForeign('fk-cells-boxes');
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign('fk-folders-cells');
        });
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign('fk-documents-folders');
        });
    }
}
