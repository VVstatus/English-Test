<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('题目');
            $table->json('answer')->comment('答案');
            $table->integer('type')->comment('类型');
            $table->integer('sort')->comment('排序');
            $table->tinyInteger('status')->comment('-1禁用，1启用');
            $table->timestamps();
        });
        Schema::create('question_type', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('题目');
            $table->integer('sort')->comment('排序');
            $table->tinyInteger('status')->comment('-1禁用，1启用');
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
        Schema::dropIfExists('question');
    }
}
