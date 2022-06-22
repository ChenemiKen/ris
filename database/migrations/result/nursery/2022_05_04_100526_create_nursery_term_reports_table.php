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
        Schema::create('nursery_term_reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pupil_id')
                    ->constrained('pupils')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('term_id')
                    ->constrained('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            // attendance
            $table->integer('times_school_opened')->nullable();
            $table->integer('times_present')->nullable();
            $table->integer('times_absent')->nullable();
            // physical development, health and cleanliness
            $table->integer('height_start')->nullable();
            $table->integer('height_end')->nullable();
            $table->integer('weight_start')->nullable();
            $table->integer('weight_end')->nullable();
            // remarks
            $table->text('personal_note', 65000)->nullable();
            $table->text('teacher_remark', 65000)->nullable();
            $table->text('head_remark', 65000)->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nursery_term_reports');
    }
};
