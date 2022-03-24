<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_rooms', function (Blueprint $table) {
            $table->id();
            $table->text("operator_name")->nullable();
            $table->text("app_id");
            $table->text("token")->nullable();
            $table->text("channel_name")->unique();
            $table->tinyInteger("current_attendees")->default(0);
            $table->tinyInteger("num_of_attendees");
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
        Schema::dropIfExists('admin_rooms');
    }
}
