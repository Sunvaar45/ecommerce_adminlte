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
            $table->tinyInteger('role')->default(0)->after('remember_token')
                ->comment('0: superadmin, 1: admin, 2: customer');
            $table->string('admin_modules')->nullable()->after('role');
            $table->tinyInteger('status')->default(0)->after('admin_modules')
                ->comment('0: inactive, 1: active, 2: deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'admin_modules', 'status']);
        });
    }
};
