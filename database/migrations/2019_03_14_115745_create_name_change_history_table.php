<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNameChangeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('name_change_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('player_id');
            $table->string('old_name');
            $table->string('new_name');
            $table->unsignedInteger('approved_by');
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
        Schema::dropIfExists('name_change_history');
    }
}
