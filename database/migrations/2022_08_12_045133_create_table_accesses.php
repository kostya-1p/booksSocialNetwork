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
        Schema::create('user_access', function (Blueprint $table) {
            $table->unsignedBigInteger('library_id');
            $table->unsignedBigInteger('user_id_with_access');

            $table->primary(['library_id', 'user_id_with_access']);
            $table->foreign('library_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            $table->foreign('user_id_with_access')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_accesses');
    }
};
