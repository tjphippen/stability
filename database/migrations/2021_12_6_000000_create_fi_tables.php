<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->index('user_id')->unsigned();
            $table->string('name');
            $table->enum('type', ['checking', 'savings', 'credit']);
            $table->timestamps();

            $table->foreignId('user_id')->constrained();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->index('input')->unsigned();
            $table->index('output')->unsigned();
            $table->decimal('amount');
            $table->timestamp('created')->useCurrent();

            $table->foreignId('input')->constrained('transactions');
            $table->foreignId('output')->constrained('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('transactions');
    }
}

