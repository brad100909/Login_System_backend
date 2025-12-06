<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('order_no')->unique();
        $table->integer('amount');
        $table->string('status')->default('unpaid'); // unpaid / paid
        $table->timestamps();
    });
}

};
