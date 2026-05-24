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
    Schema::create('boarding_houses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('city_id')->constrained()->onDelete('cascade');
        
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('location');           // e.g. full address or landmark
        $table->string('room_type');          // 'single' or 'shared'
        $table->integer('total_beds');
        $table->integer('available_beds');
        $table->decimal('size_sqm', 8, 2)->nullable();
        $table->decimal('price_per_month', 10, 2);
        $table->boolean('is_available')->default(true);
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};
