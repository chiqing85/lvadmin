<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('k', 50);
            $table->text('v');
            $table->string('type', 50);
            $table->text('desc');
            $table->string('prompt');
            $table->integer('sorts');
            $table->tinyInteger('status');
            $table->string('texttype', 100)->nullable( );
            $table->string('textvalue', 100)->nullable( );
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
        Schema::dropIfExists('config');
    }
}
