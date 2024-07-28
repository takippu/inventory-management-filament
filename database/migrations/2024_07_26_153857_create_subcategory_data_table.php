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
        Schema::create('subcategory_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->string('data_field'); // Adjust as needed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcategory_data');
    }
};
