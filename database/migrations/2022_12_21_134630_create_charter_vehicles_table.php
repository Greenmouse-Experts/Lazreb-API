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
        Schema::create('charter_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('pick_up_address')->nullable();
            $table->string('drop_off_address')->nullable();
            $table->string('start_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('return_time')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('charter_type')->nullable();
            $table->string('purpose_of_use')->nullable();
            $table->string('agreement')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('charter_vehicles');
    }
};
