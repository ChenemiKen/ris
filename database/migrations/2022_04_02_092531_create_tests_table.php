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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->set('test_no',[1,2,3,4]);
            $table->foreignId('pupil_id')
                    ->constrained('pupils')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('term_id')
                    ->constrained('terms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->set('class', ['primary_1','primary_2','primary_3','primary_4','primary_5','primary_6'])->nullable();
            $table->foreignId('teacher_id')->nullable()
                    ->constrained('teachers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('tests');
    }
};
