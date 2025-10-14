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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_cliente', ['fisica', 'giuridica'])->default('fisica');
            $table->string('nome');
            $table->string('cognome')->nullable();
            $table->string('ragione_sociale')->nullable();
            $table->string('codice_fiscale')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->text('indirizzo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
