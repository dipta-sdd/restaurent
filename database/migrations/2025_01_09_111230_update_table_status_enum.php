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
        // First, modify any existing 'occupied' values to 'available' to prevent errors
        DB::table('tables')->where('status', 'occupied')->update(['status' => 'available']);
        
        // Now modify the enum
        DB::statement("ALTER TABLE tables MODIFY COLUMN status ENUM('available', 'maintenance', 'closed') NOT NULL DEFAULT 'available'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, modify any maintenance or closed values to available
        DB::table('tables')->whereIn('status', ['maintenance', 'closed'])->update(['status' => 'available']);
        
        // Restore the original enum
        DB::statement("ALTER TABLE tables MODIFY COLUMN status ENUM('available', 'occupied') NOT NULL DEFAULT 'available'");
    }
};
