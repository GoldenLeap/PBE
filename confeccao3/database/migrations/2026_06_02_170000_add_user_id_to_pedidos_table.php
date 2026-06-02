<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('cliente_id')->constrained('users')->cascadeOnDelete();
        });

        // Preencher pedidos existentes com o primeiro user (admin)
        $firstUserId = DB::table('users')->orderBy('id', 'asc')->first()?->id ?? 1;
        DB::table('pedidos')->whereNull('user_id')->update(['user_id' => $firstUserId]);

        // Agora remover nullable
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('user_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

