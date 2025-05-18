<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	public function up()
	{
		Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('course_group_id')->constrained();
            $table->unsignedTinyInteger('level'); // السنة المستهدفة: 1، 2، 3، 4
            $table->integer('credit_hours');
            $table->boolean('is_elective')->default(false); // لو المقرر اختياري
$table->boolean('is_project')->default(false);  // لو مقرر مشروع
            $table->timestamps();
        });

	}

	public function down()
	{
		Schema::drop('courses');
	}
}
