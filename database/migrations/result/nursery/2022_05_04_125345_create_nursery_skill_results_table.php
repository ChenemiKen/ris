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
        Schema::create('nursery_skill_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('nursery_term_report_id')
                    ->constrained('nursery_term_reports')
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
            $table->foreignId('skill_category_id')
                    ->constrained('skill_categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('skill_id')
                    ->constrained('skills')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->set('grade', ['A+','A','B+','B','C+','C','S.A','N.A'])->nullable();
            $table->set('effort_grade', ['A+','A','B+','B','C+','C','S.A','N.A'])->nullable();
            $table->set('remark', ['Exceptional','Excellent', 'Very_good', 'Good', 'Satisfactory', 'Room_for_Improvement', 'Special_Attention','Not_Applicable'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nursery_skill_results');
    }
};
