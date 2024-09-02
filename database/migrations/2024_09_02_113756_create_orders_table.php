<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

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
            $table->string('order_number')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', [Order::STATUS_PENDING, Order::STATUS_PROCESSING, Order::STATUS_COMPLETED, Order::STATUS_CANCELED])->default(Order::STATUS_PENDING);
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('delivery_fee', 10, 2)->nullable();
            $table->decimal('packing_fee', 10, 2)->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->enum('payment_method', [Order::PAYMENT_METHOD_CASH, Order::PAYMENT_METHOD_POINTS,Order::PAYMENT_METHOD_CHEQUE])->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('order_number');
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
