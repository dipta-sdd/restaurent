<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing status column
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            // Recreate the status column with 'active' as default
            $table->enum(
                'status',
                ['inactive', 'active', 'suspended', 'banned']
            )->default('active');
        });

        // Update existing users to active status
        DB::table('users')->whereNull('status')->update(['status' => 'active']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum(
                'status',
                ['inactive', 'active', 'suspended', 'banned']
            )->default('inactive');
        });
    }
}; 