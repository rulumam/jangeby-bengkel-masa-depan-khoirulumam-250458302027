<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()
                ->comment('Nama peran: Admin atau User');
            $table->timestamps();
        });

        
        DB::table('roles')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
