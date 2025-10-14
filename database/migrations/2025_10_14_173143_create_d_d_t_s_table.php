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
        Schema::create('d_d_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ddt')->unique();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('set null');
            $table->string('codice_cliente')->nullable();
            $table->string('codice_fiscale_piva')->nullable();
            $table->string('causale_trasporto')->nullable();
            $table->enum('trasporto_a_cura', ['mittente', 'vettore', 'destinatario'])->nullable();
            $table->dateTime('data_ora_trasporto')->nullable();
            $table->string('trasporto_ditta')->nullable();
            $table->enum('aspetto_beni', ['taniche', 'cartone', 'a_vista'])->nullable();
            $table->integer('num_colli')->nullable();
            $table->decimal('peso', 10, 2)->nullable();
            $table->string('porto')->nullable();
            $table->text('annotazioni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_d_t_s');
    }
};
