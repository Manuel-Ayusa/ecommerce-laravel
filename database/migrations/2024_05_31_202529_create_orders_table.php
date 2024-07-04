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
            $table->float('total');
            $table->float('subtotal');
            $table->string('entrega', 30);
            $table->string('payment_id', 45);
            $table->string('estado_pago', 30);
            $table->string('estado_entrega', 30);
            $table->unsignedBigInteger('cart_id');

            $table->foreign('cart_id')
                    ->references('id')
                    ->on('carts')
                    ->onDelete('cascade');

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
