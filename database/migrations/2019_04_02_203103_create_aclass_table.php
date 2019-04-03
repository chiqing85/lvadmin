<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // name dirs pid status sort
        Schema::create('aclass', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 30);
            $table->char('dirs', 80);
            $table->mediumInteger('mid')->default(0);
            $table->mediumInteger('pid')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->smallInteger('sort')->default(100);
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
        Schema::dropIfExists('aclass');
    }
}
