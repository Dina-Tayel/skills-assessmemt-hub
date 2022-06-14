<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('skill_id')->constrained()->nullOnDelete();
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
            ->references('id')
            ->on('skills')
            ->onDelete('cascade');
            $table->text('name');
            $table->text('desc');
            $table->string('img',100);
            $table->tinyInteger('questions_no');
            $table->smallInteger('duration_mins');
            $table->tinyInteger('difficulty');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('exams');
    }
};
