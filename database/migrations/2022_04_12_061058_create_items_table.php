<?php

use App\Models\Requisition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('items', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisition_id')
                ->references('id')
                ->on('requisitions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->uuid('reference');
            $table->string('name', 255)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
