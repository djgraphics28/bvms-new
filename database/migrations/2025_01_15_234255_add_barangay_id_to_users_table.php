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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('barangay_id')->nullable()->after('remember_token');
            $table->boolean('superadmin')->default(false)->after('barangay_id');
            $table->enum('user_type', ['admin','barangay_admin','driver'])->after('superadmin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('barangay_id');
            $table->dropColumn('superadmin');
            $table->dropColumn('user_type');
        });
    }
};
