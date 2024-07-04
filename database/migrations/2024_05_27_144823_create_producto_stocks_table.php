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
        Schema::create('producto_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->integer('S');
            $table->integer('M');
            $table->integer('L');
            $table->integer('XL');
            $table->integer('XXL');
            $table->string('imagen1');
            $table->string('imagen2')->nullable();
            $table->string('imagen3')->nullable();
            $table->unsignedBigInteger('producto_id');

            $table->foreign('producto_id')->
                    references('id')->on('productos')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_stocks');
    }
};
