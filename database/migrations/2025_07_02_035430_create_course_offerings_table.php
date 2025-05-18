<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('course_offerings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('course_id')->constrained();
    $table->foreignId('term_id')->constrained();
    $table->string('section')->nullable(); // لو عايز تقسم شعب
    $table->unsignedTinyInteger('level'); // السنة المستهدفة: 1، 2، 3، 4
    $table->boolean('is_elective')->default(false);

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
        Schema::dropIfExists('course_offerings');
    }
}
