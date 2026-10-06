<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'certifications',
            function (Blueprint $table): void {
                $table->id();

                $table
                    ->uuid('uuid')
                    ->unique();

                $table
                    ->string('curp', 18)
                    ->nullable()
                    ->index();

                $table
                    ->string('folio', 50)
                    ->unique();

                $table->string('tipo', 30);

                $table->string('codigo', 80);

                $table->string('titulo');

                $table->string('entidad', 500);

                $table
                    ->string('siglas', 80)
                    ->nullable();

                $table
                    ->string('evaluador', 500)
                    ->nullable();

                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};