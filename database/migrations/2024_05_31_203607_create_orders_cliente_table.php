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
        Schema::create('orders_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido', 30); 
            $table->string('email', 30); 
            $table->string('DNI', 30);
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_clientes');
    }
};
