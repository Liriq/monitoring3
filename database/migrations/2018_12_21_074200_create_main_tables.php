<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('template_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates')            
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
            $table->string('question');
            $table->string('hint')->nullable();
            $table->boolean('is_required')->default(true);
            $table->string('answer_type')->default('text');
            $table->json('answer_variants')->nullable();
            $table->timestamps();
        });
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')            
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
            $table->unsignedInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates')            
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
            $table->string('name');
            $table->timestamp('published_at')->useCurrent = true;
            $table->timestamps();
        });
        Schema::create('report_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('report_id');
            $table->foreign('report_id')->references('id')->on('reports')            
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
            $table->string('question');
            $table->string('hint')->nullable();
            $table->boolean('is_required')->default(true);
            $table->string('answer_type')->default('text');
            $table->json('answer_variants')->nullable();
            $table->string('answer');
            $table->timestamps();
        });
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
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
        Schema::dropIfExists('template_questions');
        Schema::dropIfExists('report_answers');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('settings');
    }
}
