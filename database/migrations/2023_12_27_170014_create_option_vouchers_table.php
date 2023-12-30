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
        Schema::create('option_vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('voucher_id');
            $table->string('item_name');
            $table->string('option_name');
            $table->integer('order_qty');
            $table->integer('selling_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_vouchers');
    }
};
