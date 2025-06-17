<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGradeToRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('registrations', function (Blueprint $table) {
        $table->float('grade')->nullable()->after('course_id');
    });
}

public function down()
{
    Schema::table('registrations', function (Blueprint $table) {
        $table->dropColumn('grade');
    });
}

}
