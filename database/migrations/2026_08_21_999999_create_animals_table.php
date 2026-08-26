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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira ligada à tabela de tutores
            $table->foreignId('tutor_id')
                ->constrained('tutors')
                ->cascadeOnDelete();

            $table->foreignId('specie_id')->constrained('species')->cascadeOnDelete();
            $table->foreignId('race_id')->nullable()->constrained('races');
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date')->nullable();
            $table->decimal('weight', 5,2)->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
