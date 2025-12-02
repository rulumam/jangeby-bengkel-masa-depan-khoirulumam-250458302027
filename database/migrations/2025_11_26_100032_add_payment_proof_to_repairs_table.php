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
    Schema::table('repairs', function (Blueprint $table) {
        if (!Schema::hasColumn('repairs', 'payment_proof')) {
            $table->string('payment_proof')->nullable()->after('cost');
        }
    });
}

public function down(): void
{
    Schema::table('repairs', function (Blueprint $table) {
        if (Schema::hasColumn('repairs', 'payment_proof')) {
            $table->dropColumn('payment_proof');
        }
    });
}

};
