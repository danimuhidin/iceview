<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable()->after('name');
            $table->text('address')->nullable()->after('city');
            $table->string('link_maps')->nullable()->after('address');
            $table->string('phone')->nullable()->after('link_maps');
            $table->boolean('is_active')->default(true)->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'address', 'link_maps', 'phone', 'is_active']);
        });
    }
};
