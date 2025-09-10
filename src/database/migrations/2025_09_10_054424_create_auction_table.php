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
        Schema::create('auction_users', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('user_name');
        });

        Schema::create('sale_item_lists', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sale_user_id');
            $table->string('item_title');
            $table->string('item_description');
            $table->integer('start_price');
            $table->timestamp('expired_date')->nullable();
        });

        Schema::create('item_bid_histories', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('bid_user_id');
            $table->integer('sale_item_list_id');
            $table->integer('bid_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_users');
        Schema::dropIfExists('sale_item_lists');
        Schema::dropIfExists('item_bid_histories');
    }
};
