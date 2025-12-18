<?php

use App\Models\Lista;
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
        Schema::create('shared_lista', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lista::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('code');
            $table->json('can_access')->default('[]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_lista');
    }
};
