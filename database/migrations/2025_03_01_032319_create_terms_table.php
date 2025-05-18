<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermsTable extends Migration {

	public function up()
	{
		Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year');
            $table->enum('semester', ['first', 'second', 'summer']); // ← Enum هنا
            $table->unsignedTinyInteger('level'); // السنة المستهدفة: 1، 2، 3، 4
            $table->boolean('is_active')->default(false);
          $table->dateTime('registration_start_date')->nullable();
$table->dateTime('registration_end_date')->nullable();
            $table->timestamps();
        });

	}

	public function down()
	{
		Schema::drop('terms');
	}
}
