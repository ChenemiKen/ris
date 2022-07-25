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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->set('class', ['beacon','lower_primary','upper_primary','nursery','playgroup']);
            $table->set('subclass', ['upper_primary_6','upper_primary_5','upper_primary_4','lower_primary_3','lower_primary_2','lower_primary_1','nursery_2','nursery_1'])->nullable();
            $table->set('class_group', ['daniel','david','joseph','samuel'])->nullable();
            $table->set('gender',['M','F']);
            $table->string('phone');
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
