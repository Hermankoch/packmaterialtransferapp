<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('date');
            $table->string('reference');
            $table->string('delivery_note')->nullable();
            $table->foreignId('from_warehouse')->references('id')->on('warehouses');
            $table->foreignId('to_warehouse')->references('id')->on('warehouses');
            $table->string('collected_by');
            $table->boolean('actioned')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
