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
        Schema::table('lavori', function (Blueprint $table) {
            $table->unsignedTinyInteger('numero_trattamento')->nullable()->after('data_lavoro');
            $table->boolean('lavoro_extra')->default(false)->after('numero_trattamento');
            $table->enum('tipo_ordine', ['Contratto', 'Email', 'Telefonico'])->nullable()->after('lavoro_extra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lavori', function (Blueprint $table) {
            $table->dropColumn(['numero_trattamento', 'lavoro_extra', 'tipo_ordine']);
        });
    }
};
