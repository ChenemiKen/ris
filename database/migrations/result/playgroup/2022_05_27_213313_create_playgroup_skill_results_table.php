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
        Schema::create('playgroup_skill_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('playgroup_term_report_id')
                    ->constrained('playgroup_term_reports')
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
            $table->set('score', [1,2,3,4,5,6,7,8,9,10])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playgroup_skill_results');
    }
};
