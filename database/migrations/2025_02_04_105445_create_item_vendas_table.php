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
        Schema::create('item_vendas', function (Blueprint $table) {
            $table->id();
            $table->integer('venda_id')->nullable()->foreingn('venda')->references('id');
            $table->integer('produto_id')->nullable()->foreingn('produto')->references('id');
            $table->integer('quantidade')->nullable();
            $table->decimal('preco_unitario')->nullable();
            $table->decimal('subtotal_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_vendas');
    }
};
