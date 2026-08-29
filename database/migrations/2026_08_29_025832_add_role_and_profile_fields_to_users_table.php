<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'petugas', 'customer'])->default('customer')->after('password');
            }

            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('role');
            }

            if (!Schema::hasColumn('users', 'alamat')) {
                $table->string('alamat')->nullable()->after('foto');
            }

            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('users', 'role')) {
                $columns[] = 'role';
            }

            if (Schema::hasColumn('users', 'foto')) {
                $columns[] = 'foto';
            }

            if (Schema::hasColumn('users', 'alamat')) {
                $columns[] = 'alamat';
            }

            if (Schema::hasColumn('users', 'no_hp')) {
                $columns[] = 'no_hp';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
