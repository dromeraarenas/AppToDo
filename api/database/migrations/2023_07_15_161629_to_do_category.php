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
        Schema::create('to_dos_categories', function (Blueprint $table) {
            $table->foreignId('to_do_id')->constrained(
                table: 'to_dos', indexName: 'to_dos_category_id'
            );
            $table->foreignId('category_id')->constrained(
                table: 'categories', indexName: 'category_to_do_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_categories');
    }
};
