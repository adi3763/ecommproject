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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('address_id')->constrained()->onDelete('cascade');

            $table->enum('payment_method', ['cod', 'razorpay', 'upi']);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            
             $table->enum('order_status', ['processing', 'shipped', 'delivered', 'cancelled'])->default('processing');

            // Total order amount
            $table->decimal('total', 10, 2);
            
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
