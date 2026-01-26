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
        Schema::table('d_d_t_s', function (Blueprint $table) {
            $table->string('numero_progressivo', 10)->nullable()->after('id');
        });
        
        // Aggiorna i record esistenti con numero progressivo (se presenti)
        if (DB::table('d_d_t_s')->count() > 0) {
            DB::statement('UPDATE d_d_t_s SET numero_progressivo = printf("%06d", id + 99) WHERE numero_progressivo IS NULL');
        }
        
        // Rendi il campo unique
        Schema::table('d_d_t_s', function (Blueprint $table) {
            $table->unique('numero_progressivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('d_d_t_s', function (Blueprint $table) {
            $table->dropColumn('numero_progressivo');
        });
    }
};
