<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('cod')->nullable();
            $table->string('name');
            $table->string('registro_ans')->nullable();
            $table->integer('dias_retorno')->nullable();
            $table->integer('limite_diario')->nullable();
            $table->tinyInteger('status')->default(1); // 1 - ativo || 0 - inativo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convenios');
    }
};
