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
        Schema::create('primary_term_reports', function (Blueprint $table) {
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
            $table->integer('times_punctual')->nullable();
            $table->integer('sports_1')->nullable();
            $table->integer('sports_2')->nullable();
            $table->integer('sports_3')->nullable();
            $table->string('other_event_1')->nullable();
            $table->string('other_event_2')->nullable();
            $table->string('other_event_3')->nullable();
            // conduct
            $table->integer('conduct_good')->nullable();
            $table->integer('conduct_bad')->nullable();
            $table->integer('conduct_exemplary')->nullable();
            $table->string('conduct_comment')->nullable();
            // physical development, health and cleanliness
            $table->integer('height_start')->nullable();
            $table->integer('height_end')->nullable();
            $table->integer('weight_start')->nullable();
            $table->integer('weight_end')->nullable();
            $table->integer('illness_days')->nullable();
            $table->string('nature_of_illness')->nullable();
            $table->set('cleanliness_rating',['A','B','C','D','E','F'])->nullable();
            $table->set('cleanliness_remark', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail'])->nullable();
            // sports
            $table->set('ball_games', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            $table->set('tracks', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            $table->set('jumps', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            $table->set('throws', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            $table->set('swimming', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            $table->set('others', ['excellent', 'very_good', 'good', 'fair', 'poor', 'fail','nil'])->nullable();
            // clubs
            $table->string('organisation')->nullable();
            $table->string('organisation_office')->nullable();
            $table->string('organisation_contribution')->nullable();
            // 
            $table->string('teacher_remark')->nullable();
            $table->string('head_remark')->nullable();
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
        Schema::dropIfExists('primary_term_reports');
    }
};
