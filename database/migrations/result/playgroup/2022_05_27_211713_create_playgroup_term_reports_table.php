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
        Schema::create('playgroup_term_reports', function (Blueprint $table) {
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
            // Attention skills
            $table->text('ability_to_concentrate', 1000)->nullable();
            $table->text('crk', 1000)->nullable();
            $table->text('colouring_art', 1000)->nullable();
            $table->text('games', 1000)->nullable();
            $table->text('lang_dev_vocab', 1000)->nullable();
            $table->text('number_work', 1000)->nullable();
            $table->text('other_activities', 1000)->nullable();
            $table->text('pencil_play_activities', 1000)->nullable();
            $table->text('phonics', 1000)->nullable();
            $table->text('project_work', 1000)->nullable();
            // Affective area skills
            $table->text('attitude_to_work', 1000)->nullable();
            $table->text('cleanliness', 1000)->nullable();
            $table->text('dress', 1000)->nullable();
            $table->text('hair', 1000)->nullable();
            $table->text('nails', 1000)->nullable();
            $table->text('neatness', 1000)->nullable();
            $table->text('punctuality', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playgroup_term_reports');
    }
};
