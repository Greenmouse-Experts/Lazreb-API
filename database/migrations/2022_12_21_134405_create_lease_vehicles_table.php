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
        Schema::create('lease_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('name')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('lease_duration')->nullable();
            $table->string('purpose_of_use')->nullable();
            $table->string('location_of_use')->nullable();
            $table->string('agreement')->nullable();
            $table->string('paid_status')->nullable();
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
        Schema::dropIfExists('lease_vehicles');
    }
};
