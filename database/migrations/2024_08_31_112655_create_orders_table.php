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
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->float('total_amount', 10, 2);
            $table->float('discount_amount', 10, 2)->default(0);
            $table->float('gross_amount', 10, 2);
            $table->float('shipping_amount', 10, 2);
            $table->float('net_amount', 10, 2);
            $table->enum('status', ['placed', 'processing', 'shipping', 'delivered']);
            $table->enum('payment_status', ['paid', 'not paid']);
            $table->enum('payment_type', ['netbanking', 'upi', 'cod']);
            $table->string('payment_transaction_id')->nullable();
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
