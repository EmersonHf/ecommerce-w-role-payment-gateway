<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the role_id column as a foreign key
            $table->unsignedBigInteger('role_id');
            
            // Define the foreign key constraint
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove the foreign key constraint and the role_id column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
