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
        Schema::table('paciente_historicos', function (Blueprint $table) {
            $table->unsignedBigInteger('cid10_id')->nullable();
            $table->foreign('cid10_id')->references('id')->on('cid10s')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paciente_historicos', function (Blueprint $table) {
            //
        });
    }
};
