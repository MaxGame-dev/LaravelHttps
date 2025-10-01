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
        Schema::table('sale_item_lists', function (Blueprint $table) {
            // 画像のパスを保存するカラムを追加
            $table->string('item_image')->nullable()->after('item_description'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_item_lists', function (Blueprint $table) {
            // ロールバック時にカラムを削除
            $table->dropColumn('item_image'); 
        });
    }
};
