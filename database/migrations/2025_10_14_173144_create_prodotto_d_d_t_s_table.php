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
        Schema::create('prodotto_d_d_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ddt_id')->constrained('d_d_t_s')->onDelete('cascade');
            $table->string('codice')->nullable();
            $table->string('nome_prodotto');
            $table->string('unita_misura')->nullable();
            $table->decimal('quantita', 10, 2)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodotto_d_d_t_s');
    }
};
