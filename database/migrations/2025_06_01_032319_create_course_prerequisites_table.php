<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursePrerequisitesTable extends Migration {

	public function up()
	{

Schema::create('prerequisites', function (Blueprint $table) {
    $table->id();
    $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
    $table->foreignId('prerequisite_id')->constrained('courses')->onDelete('cascade');
    $table->timestamps();
});

	}

	public function down()
	{
		Schema::drop('prerequisites');
	}
}
