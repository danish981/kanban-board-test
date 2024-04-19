<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        if (!Schema::hasColumn('phases', 'is_completion_phase')) {
            Schema::table('phases', function (Blueprint $table) {
                $table->boolean('is_completion_phase')->after('name')->default(false);
            });
        }

    }

    public function down(): void {

        if (Schema::hasColumn('phases', 'is_completion_phase')) {
            Schema::table('phases', function (Blueprint $table) {
                $table->dropColumn('is_completion_phase');
            });
        }


    }
};
