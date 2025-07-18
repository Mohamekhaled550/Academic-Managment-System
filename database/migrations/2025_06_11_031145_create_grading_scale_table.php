<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingScaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('grading_scale', function (Blueprint $table) {
    $table->id();
    $table->unsignedTinyInteger('min_score'); // الحد الأدنى
    $table->unsignedTinyInteger('max_score'); // الحد الأقصى
    $table->string('letter'); // A, B+, C, ...
    $table->decimal('points', 3, 2); // 4.0, 3.5, ...
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
        Schema::dropIfExists('grading_scale');
    }
}
