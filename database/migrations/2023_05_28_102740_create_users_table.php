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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100);
            $table->string('name', 100);
            $table->unsignedBigInteger('role');
            $table->string('avatar', 100)->nullable();
            $table->string('phone', 15);
            $table->text('address');
            $table->string('password', 100);
            $table->timestamps();

            $table->foreign('role')
                ->references('id')
                ->on('user_groups')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
    }
};
