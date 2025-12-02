<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->string('status', 20)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
