<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid')->default();
            $table->string('name', 50)->default();
            $table->tinyInteger('modelid')->default(0)->comment('评论1， 反馈 0');
            $table->integer('articleid')->default(0)->comment('文章id,如果是反馈，则为 0');
            $table->integer('pid')->default(0)->comment('回复-父id');
            $table->string('item_pic', 191)->default()->comment('用户头像');
            $table->string('email',50)->default()->comment('用户邮箱');
            $table->text('contents')->comment('反馈/评论内容…');
            $table->string('ip', 16)->default()->comment('用户 IP');
            $table->tinyInteger('status')->default(0)->comment('消息状态，1已经读, 0 未读, -1 屏蔽');
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
        Schema::dropIfExists('comments');
    }
}
