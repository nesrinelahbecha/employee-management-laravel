<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('position');
            $table->string('cv_path')->nullable()->after('photo');
            $table->string('address')->nullable()->after('phone');
            $table->string('linkedin')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['photo', 'cv_path', 'address', 'linkedin']);
        });
    }
};