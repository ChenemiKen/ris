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
        Schema::create('nursery_subject_results', function (Blueprint $table) {
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
            $table->foreignId('subject_id')
                    ->constrained('subjects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('score')->nullable();
            $table->Text('remark', 65000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nursery_subject_results');
    }
};
