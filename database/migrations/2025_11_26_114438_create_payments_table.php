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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();

        // Relasi ke repairs (hapus payment kalau repair dihapus)
        $table->foreignId('repair_id')
            ->constrained('repairs')
            ->onDelete('cascade');

        $table->string('proof');

        // Status pembayaran
        $table->enum('status', ['paid', 'pending', 'confirmed', 'cancelled'])
            ->default('paid');

        $table->timestamps();
    });
}

};
