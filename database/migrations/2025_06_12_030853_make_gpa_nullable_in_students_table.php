<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeGpaNullableInStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('students', function (Blueprint $table) {
        $table->dropColumn('gpa');
    });

    Schema::table('students', function (Blueprint $table) {
        $table->float('gpa')->nullable(); // أنشئه من جديد وخلّيه nullable
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('gpa');
        });
    }
}
