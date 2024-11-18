<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->enum('role', ['user', 'admin', 'manager', 'rider', 'staff'])->default('user');
            $table->string('phone')->nullable();
            // $table->unsignedBigInteger('address_id')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_exp')->nullable();
            $table->string('social_id')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum(
                'status',
                ['active', 'suspended', 'banned']
            )->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
