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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clients_id');
            $table->unsignedBigInteger('items_id');

            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');;

            $table->integer('quantity');
            $table->integer('total_price');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->dropForeign(['clients_id', 'items_id']);
        //     $table->dropIndex(['clients_id', 'items_id']);
        // });
    }
};
