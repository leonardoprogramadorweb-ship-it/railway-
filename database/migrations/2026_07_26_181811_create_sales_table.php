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
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->decimal('total', 10, 2);
        $table->decimal('pago_con', 10, 2);
        $table->decimal('cambio', 10, 2);
        $table->string('metodo_pago')->default('efectivo');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
