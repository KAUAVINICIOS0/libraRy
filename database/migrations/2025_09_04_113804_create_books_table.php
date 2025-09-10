<?php

use App\Enums\StatusBookEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('isbn');
            $table->string('year_published');
            $table->foreignUlid('author_id')->constrained('authors')->cascadeOnDelete();
            $table->string('status')->default(StatusBookEnum::AVAILABLE->value);
            $table->foreignUlid('publisher_id')->constrained('publishers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
