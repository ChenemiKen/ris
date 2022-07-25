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
        Schema::create('pupils', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->set('class', ['beacon','lower_primary','upper_primary','nursery','playgroup']);
            $table->set('subclass', ['upper_primary_6','upper_primary_5','upper_primary_4','lower_primary_3','lower_primary_2','lower_primary_1','nursery_2','nursery_1'])->nullable();
            $table->set('class_group', ['daniel','david','joseph','samuel'])->nullable();
            $table->date('dob');
            $table->set('gender', ['M','F']);
            $table->string('parent_phone');
            $table->string('parent_email');
            $table->string('admission_no')->unique();
            $table->date('entry_date');
            $table->string('photo')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pupils');
    }
};
