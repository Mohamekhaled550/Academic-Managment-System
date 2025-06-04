<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('terms', function (Blueprint $table) {
        $table->unsignedSmallInteger('year');
$table->unsignedTinyInteger('semester'); // 1 = الأول، 2 = الثاني، 3 = الصيفي
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
