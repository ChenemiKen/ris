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
            $table->string('class');
            $table->date('dob');
            $table->integer('age');
            $table->string('gender');
            $table->string('parent')->nullable();
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
