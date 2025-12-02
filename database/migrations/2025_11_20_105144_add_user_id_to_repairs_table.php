<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('repairs', function (Blueprint $table) {
         
            if (!Schema::hasColumn('repairs', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()                    
                    ->after('vehicle_id')
                    ->constrained('users')
                    ->nullOnDelete();             
            }
        });
    }

    public function down(): void
    {
        Schema::table('repairs', function (Blueprint $table) {
            if (Schema::hasColumn('repairs', 'user_id')) {
              
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
