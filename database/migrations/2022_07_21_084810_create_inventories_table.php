<?php

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
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('bill_no')->unique();
            $table->foreignId('customer_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->double('total_discount')->nullable();
            $table->double('total_bill_amount');
            $table->double('due_amount');
            $table->double('paid_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
