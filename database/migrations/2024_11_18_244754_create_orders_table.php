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
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->enum('order_type', ['delivery', 'pickup', 'dine-in']);
            $table->enum('status', ['pending', 'processing', 'ready', 'delivered', 'cancelled'])->default('pending');
            $table->text('instructions')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->foreignId('address_id')->nullable()->constrained('addresses')->cascadeOnDelete();
            $table->string('transaction_id')->nullable();
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->cascadeOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->cascadeOnDelete();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
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
