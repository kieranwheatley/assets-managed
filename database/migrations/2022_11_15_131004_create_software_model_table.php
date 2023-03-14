<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('companies');
            $table->string('licence_metric');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('licence_cost');
            $table->smallInteger('purchased_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('software_model');
    }
};
