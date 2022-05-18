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
        Schema::create('primary_test_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('primary_test_id')
                    ->constrained('primary_tests')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('pupil_id')
                    ->constrained('pupils')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('term_id')
                    ->constrained('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('subject_id')
                    ->constrained('subjects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('score');
            $table->set('grade', ['A','B','C','D','E','F']);
            $table->set('remark', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('primary_test_results');
    }
};
