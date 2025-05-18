<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('department_id')->constrained();
            $table->string('national_id')->unique();
            $table->string('email')->nullable();
            $table->float('gpa')->default(0);
            $table->integer('total_credits')->default(0);
            $table->enum('status', ['active', 'graduated', 'suspended'])->default('active'); // حالة الطالب
            $table->unsignedTinyInteger('level')->default(1);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('students');
	}
}
