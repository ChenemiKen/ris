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
            $table->string('gender');
            $table->string('phone');
            $table->string('email');
            $table->string('photo')->unique();
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
