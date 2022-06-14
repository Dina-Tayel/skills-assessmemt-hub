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
        Schema::create('exam_user', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->nullOnDelete();
            // $table->foreignId('exam_id')->constrained()->nullOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('exam_id')
            ->references('id')
            ->on('exams')
            ->onDelete('cascade');
            $table->float('score',5,2)->nullable() ; // max score 100.00
            $table->tinyInteger('max_time')->nullable(); // max time is equal to duration_mins
            $table->enum('status',['opened','closed'])->default('closed');
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
        Schema::dropIfExists('exam_user');
    }
};
