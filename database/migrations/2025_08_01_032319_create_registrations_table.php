<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistrationsTable extends Migration {

	public function up()
	{
Schema::create('registrations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('student_id')->constrained();
    $table->foreignId('course_id')->constrained();
    $table->foreignId('term_id')->constrained();
    $table->decimal('grade', 5, 2)->nullable(); // out of 100
    $table->boolean('is_retake')->default(false); // لو الطالب بياخده تاني بعد رسوب

    $table->timestamps();

});

	}

	public function down()
	{
		Schema::drop('registrations');
	}
}
