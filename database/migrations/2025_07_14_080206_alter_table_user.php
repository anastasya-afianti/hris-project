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
        // Add employee_id column to users table
        Schema::table('users', function (Blueprint $table){
            $table->string('employee_id')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove employee_id column from users table
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('employee_id');
        });
    }
};
