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
        Schema::create('hardware_assets', function (Blueprint $table) {
            $table->foreignId('asset');
            $table->id();
            $table->foreignId('companies');
            $table->string('model');
            $table->string('serial_number');
            $table->date('purchase_date');
            $table->date('warranty_date');
            $table->double('purchase_price');
            $table->foreignId('version');
            $table->enum('lifecycle_phase', ['active', 'retired', 'disposed']);
            $table->foreignId('location');
            $table->foreignId('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hardware_assets');
    }
};
