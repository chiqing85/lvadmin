<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         *　角色表
         */
        Schema::create('auth_group', function (Blueprint $table) {
            $table->mediumInteger('id', 8);
            $table->char('title', 100);
            $table->tinyInteger('status')->default(1);
            $table->char('rules', 80);
            $table->timestamps();
        });

        /**
         * 规则表
         */
        Schema::create('auth_rule', function (Blueprint $table) {
            $table->mediumInteger('id', 8);
            $table->char('name', 80);
            $table->char('title', 20);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->char('condition', 100);
            $table->index('name', 'name');
            $table->timestamps();
        });

        /**
         * 用户组明细表
         */
        Schema::create('auth_group_access', function (Blueprint $table) {
            $table->mediumInteger('uid');
            $table->mediumInteger('group_id');
            $table->index('uid', 'uid');
            $table->index('group_id', 'group_id');
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
        Schema::dropIfExists('auth_group', 'auth_rule', 'auth_group_access');
    }
}
