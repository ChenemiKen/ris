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
        Schema::create('primary_term_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('primary_term_report_id')
                    ->constrained('primary_term_reports')
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
            $table->integer('test_1');
            $table->integer('test_2');
            $table->integer('test_3');
            $table->integer('test_4');
            $table->integer('exam');
            $table->integer('percentage');
            $table->set('grade', ['A','B','C','D','E','F']);
            $table->set('effort_grade', ['A','B','C','D','E','F']);
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
        Schema::dropIfExists('primary_term_results');
    }
};
