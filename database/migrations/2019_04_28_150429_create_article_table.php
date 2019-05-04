<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191)->unique();
            $table->mediumInteger('pid');
            $table->string('pic', 100)->default('');
            $table->text('content');
            $table->text('editor-markdown-doc');
            $table->tinyInteger('flag')->default(0 );
            $table->tinyInteger('source')->default(0 );
            $table->string('keywords', 191)->unique();
            $table->string('author', 20)->unique();
            $table->integer('number')->default(500);
            $table->tinyInteger('sorts')->default(100);
            $table->tinyInteger('status')->default(0 );
            $table->integer('common')->default(0 );
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
        Schema::dropIfExists('article');
    }
}
