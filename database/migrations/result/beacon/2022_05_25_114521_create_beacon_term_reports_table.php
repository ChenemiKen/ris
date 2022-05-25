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
        Schema::create('beacon_term_reports', function (Blueprint $table) {
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
            $table->longText('personal_note')->nullable();
            $table->string('teacher_remark')->nullable();
            $table->string('head_remark')->nullable();
            $table->date('date')->nullable();
            // Attention skills
            $table->string('ability_to_concentrate')->nullable();
            $table->string('crk')->nullable();
            $table->string('games')->nullable();
            $table->string('lang_dev_vocab')->nullable();
            $table->string('number_work')->nullable();
            $table->string('other_activities')->nullable();
            $table->string('pencil_play_activities')->nullable();
            $table->string('phonics')->nullable();
            $table->string('project_work')->nullable();
            // Affective area skills
            $table->string('attitude_to_work')->nullable();
            $table->string('cleanliness')->nullable();
            $table->string('dress')->nullable();
            $table->string('hair')->nullable();
            $table->string('nails')->nullable();
            $table->string('neatness')->nullable();
            $table->string('punctuality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacon_term_reports');
    }
};
