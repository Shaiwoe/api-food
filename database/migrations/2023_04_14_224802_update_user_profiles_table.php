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
        Schema::table('user_profiles', function (Blueprint $table) {
        
            $table->string('shop_name');
            $table->string('shop_type');
            $table->string('shop_phone');
            $table->string('shop_address');

            $table->string('bank_sheba');
            $table->string('bank_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
        
            $table->dropColumn('shop_name');
            $table->dropColumn('shop_type');
            $table->dropColumn('shop_phone');
            $table->dropColumn('shop_address');

            $table->dropColumn('bank_sheba');
            $table->dropColumn('bank_name');
        });
    }
};
